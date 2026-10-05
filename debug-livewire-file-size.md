# Debug: limite de tamanho dos PDFs

Status: [OPEN]
Session ID: livewire-file-size

## Sintoma
- Upload de PDF de 13,5 MB falha no campo Arquivos PDF.
- A interface mostra `validation.max.file` e "Erro durante o envio".
- O campo Filament está configurado com `maxSize(20480)` (20 MB).

## Hipóteses falsificáveis
1. Livewire aplica o padrão temporário `max:12288` (12 MB).
2. Existe `config/livewire.php` sobrescrevendo o tamanho temporário com limite menor.
3. A regra `maxSize()` efetivamente carregada no Filament é menor que 13,5 MB.
4. PHP rejeita a requisição antes de aplicar a validação Laravel.

## Evidências
- A captura fornecida mostra um PDF de 13,5 MB com `validation.max.file`.
- `config/livewire.php` não existia e `php artisan config:show livewire` reportava `temporary_file_upload.rules = null`.
- O padrão do Livewire no vendor é `required|file|max:12288` (12 MB).
- `PdfResource` aplica `maxSize(20480)` (20 MB).
- PHP informa `upload_max_filesize=100M` e `post_max_size=100M`.
- Hipótese 1 confirmada; hipóteses 2, 3 e 4 rejeitadas.

## Próximos passos
- Configuração publicada em `config/livewire.php` e regra temporária ajustada para `max:20480`.
- Limpar cache de configuração e verificar o valor efetivo em runtime.
