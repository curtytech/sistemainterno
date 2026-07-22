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
            $table->string('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('category_id');
            $table->mediumText('content');
            $table->string('title');
            $table->string('image');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('news_categories')->onDelete('cascade');
        });

        DB::table('news_categories')->updateOrInsert(
            ['id' => 'institucional'],
            [
                'name' => 'Institucional',
                'description' => 'Comunicados e novidades institucionais.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news_categories')->updateOrInsert(
            ['id' => 'rh'],
            [
                'name' => 'RH',
                'description' => 'Noticias internas para colaboradores.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news_categories')->updateOrInsert(
            ['id' => 'operacoes'],
            [
                'name' => 'Operacoes',
                'description' => 'Atualizacoes sobre operacoes e processos.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news')->updateOrInsert(
            ['id' => 'news-001'],
            [
                'category_id' => 'institucional',
                'title' => 'Nova intranet da Sequoia entra em operacao',
                'content' => 'A nova intranet foi publicada para centralizar comunicados, documentos e links uteis para todos os colaboradores.',
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news')->updateOrInsert(
            ['id' => 'news-002'],
            [
                'category_id' => 'rh',
                'title' => 'Campanha interna de desenvolvimento profissional',
                'content' => 'O RH iniciou uma nova campanha com trilhas de aprendizado e incentivo a capacitacao continua dos colaboradores.',
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('news')->updateOrInsert(
            ['id' => 'news-003'],
            [
                'category_id' => 'operacoes',
                'title' => 'Atualizacao dos processos de manutencao e suporte',
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
