<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pdf_files')) {
            Schema::create('pdf_files', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pdf_id')
                    ->constrained('pdfs')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->string('file');
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();

                $table->index(['pdf_id', 'sort_order']);
            });
        }

        $pdfs = DB::table('pdfs')
            ->whereNotNull('file')
            ->where('file', '<>', '')
            ->get(['id', 'file']);

        foreach ($pdfs as $pdf) {
            $exists = DB::table('pdf_files')
                ->where('pdf_id', $pdf->id)
                ->where('file', $pdf->file)
                ->exists();

            if (! $exists) {
                DB::table('pdf_files')->insertOrIgnore([
                    'pdf_id'     => $pdf->id,
                    'file'       => $pdf->file,
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_files');
    }
};
