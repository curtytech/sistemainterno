<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_libraries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link');
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        $now = now();
        DB::table('document_libraries')->insert([
            ['name' => 'Administrativo', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Administrativo', 'icon' => '/assets/icon/adm.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Comercial', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Comercial', 'icon' => '/assets/icon/com.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Compras', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Compras', 'icon' => '/assets/icon/comesup.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Controladoria', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Controladoria', 'icon' => '/assets/icon/cont.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Financeiro', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Financeiro', 'icon' => '/assets/icon/fin.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fiscal/Contábil', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Fiscal_contabil', 'icon' => '/assets/icon/fis.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Gerência', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Gerencia', 'icon' => '/assets/icon/ger.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Jurídico', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-juridico/SitePages/CollabHome.aspx', 'icon' => '/assets/icon/jur.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Logística', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Logistica', 'icon' => '/assets/icon/logetrans.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Manutenção', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Manutencao', 'icon' => '/assets/icon/man.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Marketing', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Marketing', 'icon' => '/assets/icon/mark.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NFe', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-NF', 'icon' => '/assets/icon/nfe.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Orçamento', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Orcamento', 'icon' => '/assets/icon/orc.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Patrimonial', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Patrimonial', 'icon' => '/assets/icon/pat.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'PCP', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-PCP', 'icon' => '/assets/icon/pcp.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pública', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Publica', 'icon' => '/assets/icon/publ.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Qualidade / PeD', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Qualidade/SitePages/CollabHome.aspx', 'icon' => '/assets/icon/quali.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'RH', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-RH', 'icon' => '/assets/icon/rh.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SST', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-SST', 'icon' => '/assets/icon/sst.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sustentabilidade', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Sustentabilidade', 'icon' => '/assets/icon/sust.jpeg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'TI', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/intrasequoia/SitePages/Inova%C3%A7%C3%B5es-Tecnol%C3%B3gicas.aspx', 'icon' => '/assets/icon/inov.jpeg', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('document_libraries');
    }
};
