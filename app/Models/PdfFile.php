<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PdfFile extends Model
{
    protected $fillable = [
        'pdf_id',
        'file',
        'sort_order',
    ];

    protected $appends = [
        'file_url',
    ];

    public function pdf(): BelongsTo
    {
        return $this->belongsTo(Pdf::class);
    }

    public function getFileUrlAttribute(): ?string
    {
        if (! is_string($this->file) || $this->file === '') {
            return null;
        }

        if (Str::startsWith($this->file, ['http://', 'https://', '/'])) {
            return $this->file;
        }

        return Storage::disk('public')->url($this->file);
    }

    public function getFilenameAttribute(): string
    {
        $path = $this->file;
        if (is_array($path)) {
            $path = (string) ($path['path'] ?? $path['file'] ?? $path[0] ?? '');
        }
        $path = (string) $path;
        if ($path === '') {
            return 'arquivo.pdf';
        }

        $nome = basename($path);
        if ($nome === '' || $nome === '.' || $nome === '/') {
            return 'arquivo.pdf';
        }

        return $nome;
    }
}
