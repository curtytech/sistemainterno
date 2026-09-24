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
        Schema::create('link_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        DB::table('link_categories')->insertOrIgnore([
            ['id' => 1, 'title' => 'Sistemas',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'title' => 'Gestão RH',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'title' => 'Ordem de Serviço',  'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'title' => 'Denúncias',         'created_at' => now(), 'updated_at' => now()],
          
        ]);


        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_category_id')->constrained('link_categories');
            $table->string('title');
            $table->string('link');
            $table->timestamps();
        });

        DB::table('links')->insertOrIgnore([
            ['link_category_id' => 1,  'title' => 'Qive',                            'link' => 'https://qive.com.br/',                                                                                                        'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 1,  'title' => 'Mercos',                          'link' => 'https://app.mercos.com/login/',                                                                                              'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 1,  'title' => 'Hive Cloud - CTe',                'link' => 'https://cte.hivecloud.com.br/ctes',                                                                                          'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 1,  'title' => 'Hive Cloud - MDFe',               'link' => 'https://mdfe.hivecloud.com.br/',                                                                                             'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 1,  'title' => 'Universidade Sankhya',            'link' => 'https://ead.sankhya.com.br/login.php',                                                                                       'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 1,  'title' => 'Sankhya Om',                      'link' => 'https://sequoia.sankhyacloud.com.br/mge/',                                                                                   'created_at' => now(), 'updated_at' => now()],

            ['link_category_id' => 2,  'title' => 'Solicitação Admissão de Colaboradores',  'link' => 'https://forms.office.com/pages/responsepage.aspx?id=iQL2wSFX90aaQLCc6Yi0DJOpBteh8IVCkQqORfhz3J1UNjBVUkpSSjgwWlZUOEExWkhTSEM5SlVXTi4u&route=shorturl',  'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 2,  'title' => 'Solicitação Demissional',               'link' => 'https://forms.office.com/pages/responsepage.aspx?id=iQL2wSFX90aaQLCc6Yi0DJOpBteh8IVCkQqORfhz3J1UODhUVFgxN0YyME1TREZJT0pNV0tOVEU1Vy4u&route=shorturl',  'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 2,  'title' => 'Plataforma de Treinamentos',            'link' => 'https://gruposequoia.grupoimpulsionar.com/',                                                                                                                        'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 2,  'title' => 'Pontotel',                              'link' => 'https://gestao.pontotel.com.br/#/cognito/login',                                                                                                                  'created_at' => now(), 'updated_at' => now()],

            ['link_category_id' => 3,  'title' => 'Solicitação Manutenção',          'link' => 'https://sequoiamanutencao.vercel.app/login',                                                                                 'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 3,  'title' => 'Solicitação Patrimonial',         'link' => 'https://forms.office.com/Pages/ResponsePage.aspx?id=iQL2wSFX90aaQLCc6Yi0DJLv1d-JqxVOkIzJSns4QY1UOTlMSFQ5NlYxUUdJTUw2UlhTSlJUR0dRNyQlQCN0PWcu',            'created_at' => now(), 'updated_at' => now()],

            ['link_category_id' => 4,  'title' => 'Canal de Ética',                           'link' => 'https://contatoseguro.com.br/sequoiabrasil',                                                                    'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 4,  'title' => 'Canal da mulher',                          'link' => 'https://contatoseguro.com.br/pt/canaldamulhersequoiabrasil',                                                    'created_at' => now(), 'updated_at' => now()],
            ['link_category_id' => 4,  'title' => 'Formulário Anônimo de Denuncia e Sugestões', 'link' => 'https://forms.office.com',                                                                                  'created_at' => now(), 'updated_at' => now()],
        ]);

        Schema::create('pdfs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_categories');
        Schema::dropIfExists('links');
        Schema::dropIfExists('pdfs');
    }
};
