<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pdfs', function (Blueprint $table) {
            $columnExists = collect(Schema::getColumns('pdfs'))
                ->contains(fn (array $col) => $col['name'] === 'file');

            if (! $columnExists) {
                return;
            }

            try {
                $table->string('file')->nullable()->change();
            } catch (Throwable $e) {
                // SQLite nativamente não suporta ALTER COLUMN; fazemos o caminho seguro via recreate.
                $this->recreatePdfsWithNullableFile();
            }
        });
    }

    public function down(): void
    {
        // Não desfazemos a nullabilidade por segurança (dados existentes podem ter file === NULL agora).
    }

    private function recreatePdfsWithNullableFile(): void
    {
        DB::beginTransaction();

        try {
            DB::statement('ALTER TABLE pdfs RENAME TO pdfs_old');

            Schema::create('pdfs', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('file')->nullable();
                $table->timestamps();
            });

            DB::statement('
                INSERT INTO pdfs (id, title, file, created_at, updated_at)
                SELECT id, title, file, created_at, updated_at FROM pdfs_old
            ');

            $maxId = (int) DB::table('pdfs_old')->max('id');
            if ($maxId > 0) {
                DB::statement("DELETE FROM sqlite_sequence WHERE name = 'pdfs'");
                DB::statement("INSERT INTO sqlite_sequence (name, seq) VALUES ('pdfs', {$maxId})");
            }

            DB::statement('DROP TABLE pdfs_old');

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
};
