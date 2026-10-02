<?php

namespace App\Filament\Resources\PdfResource\Pages;

use App\Filament\Resources\PdfResource;
use App\Models\PdfFile;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditPdf extends EditRecord
{
    protected static string $resource = PdfResource::class;

    /**
     * @var array<int, string>
     */
    protected array $uploadedFilePaths = [];

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['arquivos_existentes_placeholder'] = $this->record
            ->files()
            ->orderBy('sort_order')
            ->get()
            ->map(static fn (PdfFile $file): array => [
                'id' => $file->getKey(),
                'file' => $file->file,
            ])
            ->all();

        return $data;
    }

    // protected function afterValidate(): void
    // {
    //     parent::afterValidate();

    //     $arquivos = $this->data['arquivos'] ?? [];
    //     $quantidadeNovos = is_array($arquivos) ? count($arquivos) : 0;

    //     $existentes = (int) PdfFile::query()
    //         ->where('pdf_id', $this->record->getKey())
    //         ->count();

    //     if ($quantidadeNovos + $existentes === 0) {
    //         throw ValidationException::withMessages([
    //             'data.arquivos' => 'Informe pelo menos 1 arquivo PDF.',
    //         ]);
    //     }

    //     if ($quantidadeNovos + $existentes > 30) {
    //         $max = max(0, 30 - $existentes);
    //         throw ValidationException::withMessages([
    //             'data.arquivos' => "Este registro já possui {$existentes} arquivo(s). Você pode adicionar no máximo {$max} novo(s).",
    //         ]);
    //     }
    // }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->uploadedFilePaths = array_values(array_filter(
            $data['arquivos'] ?? [],
            static fn (mixed $path): bool => is_string($path) && trim($path) !== '',
        ));

        unset($data['arquivos'], $data['arquivos_existentes_placeholder']);

        return $data;
    }

    protected function afterSave(): void
    {
        if ($this->uploadedFilePaths === []) {
            return;
        }

        $ultimaOrdem = (int) PdfFile::query()
            ->where('pdf_id', $this->record->getKey())
            ->max('sort_order');

        $ordem = $ultimaOrdem;
        $novos = 0;
        foreach ($this->uploadedFilePaths as $caminho) {
            $caminho = trim($caminho);
            if ($caminho === '') {
                continue;
            }

            $ordem++;
            PdfFile::query()->create([
                'pdf_id'     => $this->record->getKey(),
                'file'       => $caminho,
                'sort_order' => $ordem,
            ]);
            $novos++;
        }

        if ($novos > 0) {
            if (! is_string($this->record->file) || trim($this->record->file) === '') {
                $this->record->file = $this->uploadedFilePaths[0];
                $this->record->save();
            }

            $this->record->load('files');
        }
    }
}
