<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Pdf extends Model
{
    protected $fillable = [
        'title',
        'file',
    ];

    protected $appends = [
        'file_url',
        'files_list',
        'files_count',
    ];

    public static function booted(): void
    {
        static::saving(function (self $pdf) {
            $temArquivoLegado = is_string($pdf->file) && trim($pdf->file) !== '';
            if ($temArquivoLegado) {
                return;
            }

            $primeiroArquivo = null;

            if ($pdf->relationLoaded('files') && count($pdf->files) > 0) {
                $primeiroArquivo = $pdf->files->first();
            }

            if ($primeiroArquivo === null && $pdf->exists) {
                $primeiroArquivo = $pdf->files()->orderBy('sort_order')->orderBy('id')->first();
            }

            if ($primeiroArquivo !== null && is_string($primeiroArquivo->file) && trim($primeiroArquivo->file) !== '') {
                $pdf->file = trim($primeiroArquivo->file);
            }
        });
    }

    public function files(): HasMany
    {
        return $this->hasMany(PdfFile::class)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC');
    }

    /**
     * Retorna uma lista única com os arquivos múltiplos + backward compat do campo único.
     *
     * @return Collection<int, array{file: string, file_url: string, filename: string}>
     */
    protected function filesList(): Attribute
    {
        return Attribute::make(
            get: function (): Collection {
                $arquivos = collect();

                $rel = $this->relationLoaded('files')
                    ? $this->files
                    : $this->files()->get();

                foreach ($rel as $pdfFile) {
                    $arquivos->push([
                        'file'      => (string) $pdfFile->file,
                        'file_url'  => (string) $pdfFile->file_url,
                        'filename'  => (string) $pdfFile->filename,
                    ]);
                }

                if (is_string($this->file) && $this->file !== '') {
                    $url = Str::startsWith($this->file, ['http://', 'https://', '/'])
                        ? $this->file
                        : Storage::disk('public')->url($this->file);

                    $jaExiste = $arquivos->contains(
                        fn (array $a) => trim($a['file']) === trim($this->file)
                    );

                    if (! $jaExiste) {
                        $nome = basename($this->file);
                        if ($nome === '' || $nome === '.' || $nome === '/') {
                            $nome = 'arquivo.pdf';
                        }

                        $arquivos->prepend([
                            'file'     => $this->file,
                            'file_url' => $url,
                            'filename' => $nome,
                        ]);
                    }
                }

                return $arquivos->values();
            },
        );
    }

    protected function filesCount(): Attribute
    {
        return Attribute::make(
            get: fn (): int => count($this->files_list),
        );
    }

    public function getFileUrlAttribute(): ?string
    {
        $primeiro = $this->files_list->first();
        if (is_array($primeiro) && isset($primeiro['file_url']) && $primeiro['file_url'] !== '') {
            return $primeiro['file_url'];
        }

        return null;
    }

    public function scopeLatestForSite(Builder $query, int $limit = 10): Builder
    {
        return $query
            ->with('files')
            ->latest()
            ->limit($limit);
    }

    public static function getLatestForSite(int $limit = 10): Collection
    {
        if (! Schema::hasTable('pdfs')) {
            return collect();
        }

        return static::query()
            ->latestForSite($limit)
            ->get();
    }
}
