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
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('event_categories')->cascadeOnDelete();
            $table->mediumText('content');
            $table->string('title');
            $table->string('image');
            $table->timestamps();
        });

        DB::table('event_categories')->updateOrInsert(
            [
                'name' => 'Corporativo',
                'description' => 'Eventos internos e comunicacoes corporativas.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('event_categories')->updateOrInsert(
            [
                'name' => 'Treinamentos',
                'description' => 'Agenda de capacitacoes e encontros de aprendizado.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('event_categories')->updateOrInsert(
            [
                'name' => 'Integracao',
                'description' => 'Acoes para integracao e cultura interna.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('events')->updateOrInsert(
            ['title' => 'Reuniao geral de alinhamento trimestral'],
            [
                'category_id' => 1,
                'content' => 'Encontro com as liderancas para apresentar resultados, metas do trimestre e atualizacoes importantes para toda a empresa.',
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('events')->updateOrInsert(
            ['title' => 'Treinamento de processos internos e compliance'],
            [
                'category_id' => 2,
                'content' => 'Capacitacao voltada para reforco de boas praticas, fluxos internos e conformidade nos processos operacionais.',
                'image' => 'https://picsum.photos/200/300',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('events')->updateOrInsert(
            ['title' => 'Cafe de integracao com novos colaboradores'],
            [
                'category_id' => 3,
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
