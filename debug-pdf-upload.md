# Debug Session: pdf-upload
- **Status**: [OPEN]
- **Issue**: O upload múltiplo de PDFs no Filament não funciona; erro reportado anteriormente: `Unable to retrieve the file_size for file at location: livewire-tmp/...pdf`.
- **Debug Server**: pending
- **Log File**: `.dbg/trae-debug-log-pdf-upload.ndjson`

## Reproduction Steps
1. Abrir `/admin/pdfs/create`.
2. Preencher o título e selecionar um ou mais PDFs no único campo de upload.
3. Salvar e registrar o erro exibido, se ocorrer.

## Hypotheses & Verification
| ID | Hypothesis | Likelihood | Effort | Evidence |
|----|------------|------------|--------|----------|
| A | O disco configurado para temporários do Livewire diverge do disco usado pelo FileUpload. | High | Low | Rejected for this reproduction: event 1 shows default disk `public` and temporary file present. |
| B | A Page de criação não persiste os arquivos recebidos em `pdf_files`. | High | Low | Confirmed: events 3-4 show one upload passed validation and the parent PDF was created with zero `pdf_file` rows. |
| C | Arquivos temporários não podem ser lidos por diretório/permissão/configuração de storage. | Medium | Low | Rejected for this reproduction: event 1 reports `temp_exists: true`; form validation and create completed. |
| D | A validação de MIME ou tamanho rejeita os arquivos antes do salvamento. | Medium | Low | Rejected for this reproduction: events 3-4 show validation and record creation completed. |

## Log Evidence
1. Event 1: `PdfResource.php:FileUpload.afterStateUpdated`, `state_type=array`, `item_count=1`, `TemporaryUploadedFile`, `temp_exists=true`, `default_disk=public`.
2. Event 2: `CreatePdf.php`, before validation, one file in the `arquivos` array.
3. Event 3: `CreatePdf.php`, after validation, one file remains in the array.
4. Event 4: `CreatePdf.php`, PDF record `id=8` created, `files_count=1`, `pdf_file_rows=0`.

## Verification Conclusion
The selected PDF reached the create lifecycle and the parent record was saved, but `CreatePdf` did not create any related `PdfFile` row. The upload failure in this reproduction is missing child-record persistence, not a temporary disk/read failure.

## Fix Applied
- `CreatePdf` now captures the dehydrated `arquivos` paths in `mutateFormDataBeforeCreate()`, removes the virtual fields from parent model data, and creates one ordered `PdfFile` per path in `afterCreate()`.
- `EditPdf` captures paths in `mutateFormDataBeforeSave()` and persists newly uploaded paths in `afterSave()`.
- The first saved path also populates the legacy `pdfs.file` field.
- Instrumentation remains active for post-fix comparison; session status remains `[OPEN]`.

## Post-Fix Verification
- PHP syntax checks: passed for `PdfResource.php`, `CreatePdf.php`, and `EditPdf.php`.
- `php artisan test`: the unit example passed; the existing generic feature test failed because `/` returned 302 instead of its expected 200. No upload-specific automated test exists.
- Runtime upload verification: events 1-4 in the post-fix run show one temporary file received, validation passed, and PDF record `id=9` created with `pdf_file_rows=1`.

## Existing-File List Issue
- Database inspection confirms PDF `id=9` has one related row in `pdf_files`.
- The read-only Repeater supplied saved items via `default(...)`, then called `defaultItems(0)`. Filament's `defaultItems()` sets a new empty default, overriding the loaded list.
- Removed `defaultItems(0)` from that Repeater. Syntax checks pass.
- Visual verification is pending because the browser opened for inspection redirected to `/admin/login`; user confirmation is required in an authenticated session.

## Null Record Error
- Runtime exception reported by the user identifies the `default()` closure at `PdfResource.php:116` receiving `null` while its parameter required `Pdf`.
- The section is hidden on create, but its field defaults can still be evaluated while the form is initialized.
- Changed the closure to accept `?Pdf` and return an empty list unless the record exists. PHP syntax check passes.
- Authenticated create/edit form verification is still pending; session remains `[OPEN]`.

## Existing-File List Follow-up
- User reports that previously saved files still do not appear in the edit form.
- Added temporary instrumentation in the existing `default()` closure to log whether a record was injected, its ID, and the related `PdfFile` count.
- Database inspection confirms PDFs `id=9` and `id=11` have 1 and 5 related rows, respectively; the `Pdf::files()` relationship returns rows from `pdf_files`.
- The saved paths for those rows are present in `storage/app/public/pdfs/files`.
- Runtime event F from the edit form showed `state_type=null`; there was no event from the `default()` closure, confirming that the edit form was not receiving a value for its virtual repeater field.
- Root cause: `EditRecord::fillForm()` hydrates from PDF model attributes, and `arquivos_existentes_placeholder` is not a model attribute, so the repeater defaults to null.
- Fix: `EditPdf::mutateFormDataBeforeFill()` now explicitly supplies related rows from `pdf_files` before the form hydrates. The read-only FileUpload children therefore receive their normal hydration lifecycle.
- Post-fix verification: pending reload of the authenticated edit form; the existing hydration event should now report an array with the saved items.
