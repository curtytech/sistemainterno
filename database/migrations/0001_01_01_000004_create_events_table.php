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
        Schema::create('event_categories', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('category_id');
            $table->mediumText('content');
            $table->string('title');
            $table->string('image');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('event_categories')->onDelete('cascade');
        });

        DB::table('event_categories')->updateOrInsert(
            ['id' => 'corporativo'],
            [
                'name' => 'Corporativo',
                'description' => 'Eventos internos e comunicacoes corporativas.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('event_categories')->updateOrInsert(
            ['id' => 'treinamentos'],
            [
                'name' => 'Treinamentos',
                'description' => 'Agenda de capacitacoes e encontros de aprendizado.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('event_categories')->updateOrInsert(
            ['id' => 'integracao'],
            [
                'name' => 'Integracao',
                'description' => 'Acoes para integracao e cultura interna.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('events')->updateOrInsert(
            ['id' => 'event-001'],
            [
                'category_id' => 'corporativo',
                'title' => 'Reuniao geral de alinhamento trimestral',
                'content' => 'Encontro com as liderancas para apresentar resultados, metas do trimestre e atualizacoes importantes para toda a empresa.',
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('events')->updateOrInsert(
            ['id' => 'event-002'],
            [
                'category_id' => 'treinamentos',
                'title' => 'Treinamento de processos internos e compliance',
                'content' => 'Capacitacao voltada para reforco de boas praticas, fluxos internos e conformidade nos processos operacionais.',
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('events')->updateOrInsert(
            ['id' => 'event-003'],
            [
                'category_id' => 'integracao',
                'title' => 'Cafe de integracao com novos colaboradores',
                'content' => 'Momento de recepcao dos novos integrantes com apresentacao das equipes, cultura da empresa e canais internos.',
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
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_categories');
    }
};
