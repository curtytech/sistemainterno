<?php

namespace App\Filament\Resources\PdfResource\Pages;

use App\Filament\Resources\PdfResource;
use App\Models\PdfFile;
use Filament\Resources\Pages\CreateRecord;

class CreatePdf extends CreateRecord
{
    protected static string $resource = PdfResource::class;

    /**
     * @var array<int, string>
     */
    protected array $uploadedFilePaths = [];

    // #region debug-point B: create-form-state
    protected function beforeValidate(): void
    {
        $files = $this->data['arquivos'] ?? null;
        $this->reportUploadDebug('B', 'Create form before validation', [
            'data_keys' => array_keys($this->data),
            'files_type' => get_debug_type($files),
            'files_count' => is_array($files) ? count($files) : null,
        ]);
    }

    protected function afterValidate(): void
    {
        $files = $this->data['arquivos'] ?? null;
        $this->reportUploadDebug('B', 'Create form after validation', [
            'files_type' => get_debug_type($files),
            'files_count' => is_array($files) ? count($files) : null,
        ]);
    }
    // #endregion

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->uploadedFilePaths = array_values(array_filter(
            $data['arquivos'] ?? [],
            static fn (mixed $path): bool => is_string($path) && trim($path) !== '',
        ));

        unset($data['arquivos'], $data['arquivos_existentes_placeholder']);

        return $data;
    }

    // #region debug-point C: create-persistence
    protected function afterCreate(): void
    {
        foreach ($this->uploadedFilePaths as $index => $path) {
            $this->record->files()->create([
                'file' => $path,
                'sort_order' => $index + 1,
            ]);
        }

        if ($this->uploadedFilePaths !== []) {
            $this->record->file = $this->uploadedFilePaths[0];
            $this->record->save();
        }

        $this->reportUploadDebug('C', 'PDF record created', [
            'pdf_id' => $this->record->getKey(),
            'files_count' => count($this->uploadedFilePaths),
            'pdf_file_rows' => PdfFile::query()->where('pdf_id', $this->record->getKey())->count(),
        ]);
    }
    // #endregion

    // #region debug-point C: report
    private function reportUploadDebug(string $hypothesisId, string $message, array $data): void
    {
        $config = @parse_ini_file(base_path('.dbg/pdf-upload.env')) ?: [];

        try {
            \Illuminate\Support\Facades\Http::timeout(2)->post($config['DEBUG_SERVER_URL'] ?? 'http://127.0.0.1:7777/event', [
                'sessionId' => $config['DEBUG_SESSION_ID'] ?? 'pdf-upload',
                'runId' => 'post-fix',
                'hypothesisId' => $hypothesisId,
                'location' => 'CreatePdf.php',
                'msg' => '[DEBUG] '.$message,
                'data' => $data + [
                    'default_disk' => config('filesystems.default'),
                    'livewire_temp_disk' => config('livewire.temporary_file_upload.disk'),
                ],
            ]);
        } catch (\Throwable) {
        }
    }
    // #endregion
}
    
