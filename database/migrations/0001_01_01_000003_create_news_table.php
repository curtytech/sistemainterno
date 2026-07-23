<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('news_categories')->cascadeOnDelete();
            $table->mediumText('content');
            $table->string('title');
            $table->string('image');
            $table->timestamps();
        });

        DB::table('news_categories')->updateOrInsert(
            [
                'name' => 'Institucional',
                'description' => 'Comunicados e novidades institucionais.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news_categories')->updateOrInsert(
            [
                'name' => 'RH',
                'description' => 'Noticias internas para colaboradores.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news_categories')->updateOrInsert(
            [
                'name' => 'Operacoes',
                'description' => 'Atualizacoes sobre operacoes e processos.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news')->updateOrInsert(
            ['title' => 'Nova intranet da Sequoia entra em operacao'],
            [
                'category_id' => 1,
                'content' => 'A nova intranet foi publicada para centralizar comunicados, documentos e links uteis para todos os colaboradores.',
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news')->updateOrInsert(
            ['title' => 'Campanha interna de desenvolvimento profissional'],
            [
                'category_id' => 2,
                'content' => 'O RH iniciou uma nova campanha com trilhas de aprendizado e incentivo a capacitacao continua dos colaboradores.',
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news')->updateOrInsert(
            ['title' => 'Atualizacao dos processos de manutencao e suporte'],
            [
                'category_id' => 3,
                'content' => 'As equipes operacionais passam a utilizar um fluxo unificado para solicitacoes internas, manutencao e acompanhamentos.',
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
        Schema::dropIfExists('news_categories');
    }
};
