<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([           
            [
                'name' => 'Marcio Lamonica',
                'email' => 'marciolamonica@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);
    }


ALLAN NUNES BARREIROS	allannunesbarreiros@gmail.com
ANDERSON CARVALHO PEREIRA	andpereira30@gmail.com
ANDRE LUIZ DOS SANTOS PAIXAO	andreluiz090304@gmail.com
CHRISTIANO JORGE DA SILVA	christianojorgesilva@gmail.com
ELENICE DA CRUZ	elenicecruz43@gmail.com
EMERSON LUIS SOUZA DA SILVA	stuartsilvasouza@gmail.com
FELIPE POLCENO DE ARAUJO	felipepolceno36@gmail.com
ADRIANA DE SOUZA BARBOSA	ab443025@gmail.com
ADRIANA FERREIRA COELHO	adrianaf_10@hotmail.com
ANDERSON LUIZ LINHARES REBECHI	arebechi@tortillas.com.br
ANDREIA CRISTINA GONÇALVES	andreiablack802@gmail.com
CLAUDIO BARBOSA RIBEIRO	cribeiro@tortillas.com.br
GARY ALLEN URBAN	gary@tortillas.com.br
GILVAN ALVES DE FREITAS	gilvfreitas@gmail.com
HEITOR PINTO DA CUNHA	hcunha@tortillas.com.br
JESSICA RAMOS BORSATO CLEMENTE	jessicaborsato@gmail.com.br
JOAO GABRIEL ROCHA DA CRUZ	joaogabrielrochacruz201@gmail.com
LUANA APARECIDA VIEIRA CARVALHO GOMES	luana.carvalho179@hotmail.com
LUIS ARTHUR DA SILVA PINTO PINHEIRO	luisarthur389m@gmail.com
MARESSA VIEIRA FERREIRA	maressavieiraferreira@gmail.com
MARIA CLARA ESTEVES MAURÍCIO	mariaclaraesteves3rios@gmail.com
MARIA MADALENA RAMOS BONATTO	madahbonatto1004@gmail.com
MAURO AUGUSTO FELIX	mauro_a_felix@yahoo.com.br
MAXWELL GUIMARAES CARDOSO	maxwellguimaraesc@gmail.com
NAYARA GENTIL DA SILVA	silvanay439@gmail.com
RAFAELA DE LIMA BARBOSA	rafaeladelimabarbosa79@gmail.com
ROBERTA DE OLIVEIRA GIOVANINI	robertagiovanini6@gmail.com
THALYS GOMES DOS SANTOS	thalysgomes095@gmail.com
VIVIANE APARECIDA PEREIRA DA CONCEICAO	vivianepviviane120@gmail.cm
ALEXANDRE GOMES BALTAR	baltar417@gmail.com
ANDERSON LUIZ LINHARES REBECHI	arebechi@tortillas.com.br
ANDRE LUIZ DE SOUZA BRAMUNCHENKEL	alsbgaviao405@gmail.com
ANDREA FERREIRA DA SILVA	afsilva@tortillas.com.br
ANGELICA TEIXEIRA QUADROS	angelica.rics@gmail.com
ARTHUR CARVALHO LAURINDO	arthurlaurindo.ti@gmail.com
BERNARDO JULIANELLI	bjulianelli@tortillas.com.br
BRUNO DE OLIVEIRA SALVADOR	brunokbx@live.com
DEBORA DA SILVA FURTADO	deborasilvarosa0@gmail.com
DOUGLAS DE CASTRO DA SILVA	douglas-c-silva@hotmail.com
EBANO GEORGE ALENCAR DE ALMEIDA	ebano776@gmail.com
ERIC JASON URBAN	eurban@tortillas.com.br
FABIANA DE OLIVEIRA AMORIM	fabianaemarcosrizo@gmail.com
FABIO ARTHUR CAMACHO DE AZEREDO	arthurfabio535@gmail.com
FELIPE GONÇALVES GUIMARAES	fgg1989@hotmail.com
FERNANDA GONÇALVES	fernadacsj@gmail.com.br
FERNANDA MOREIRA SILVA	fernanda.moreira@gmail.com
FRANCISCO MATEUS PAIVA DE OLIVEIRA FREITAS	matteuso58@gmail.com
IANDRA GEISA SANTOS MARQUES	iandramarquess@outlook.com
ISABELA PINTO DOS SANTOS CORDEIRO	isabelapinto@msn.com
ISABELLA DE CARVALHO MAGALHAES	imagalhaes@tortillas.com.br
ISMAEL SILVA MATIAS	maelgreta@gmail.com
JAQUELINE MARINHO DE CASTRO	jaquelinemclulu@gmail.com
JOAO EVANGELISTA SANTOS FERREIRA	joaocafe52@gmail.com
JOAO PEDRO ROCHA SIQUEIRA	joaopedro_rochasiqueira@yahoo.com.br
JORGE LUIZ NUNES LUZORIO	jorgeluzorio@gmail.com
JOSE FILIPE CANELLA DE MORAES	josefilipeca@hotmail.com
JULIA RODRIGUES GAGO ANDRADE	juliagago89@gmail.com
JULIANE LOPES DA SILVA	julianelopess2014@gmail.com
KARINE VIANA BARRETO PINTO	barreto.karine@gmail.com
LARISSA MELO REBELO LIMA	larissamelorlima@gmail.com
LEANDRO DA SILVA OLIVEIRA	leandrodasilvaoliveira@gmail.com
LUAN MIGUEL PEREIRA ZO CAVALCANTI	luanmiguuelzo@gmail.com
LUIZ PHILIPE ROCHA DE OLIVEIRA	phe_rdo@hotmail.com
MARCOS VINICIUS GONÇALVES WERLY	viniwerly@hotmail.com
MARIANA MAGALHAES PINTO	mmgpinto@gmail.com
MATHEUS REZENDE GAMA	rezendegama06@gmail.com
MICHELE MACEDO COUTINHO	michelemacedocoutinhomacedo@gmail.com
MIRIA DA SILVA DE ANDRADE	miriysilva25@hotmail.com
NEILO PINTO CARNEIRO	neilopc@hotmail.com
PAMMELLA LIMA DE SOUZA	pammellalima2724@gmail.com.br
PEDRO HENRIQUE REIS DA SILVA	reisp7788@gmail.com
PEDRO MARTINS ALBUQUERQUE	pedromartiins6@gmail.com
PRISCILLA MARTINS DE OLIVEIRA	pmartins@tortillas.com.br
RAFAEL DE OLIVEIRA MARCELINO	fredexbelem@gmail.com
RAFAEL LEAL DO NASCIMENTO	lealnascimento13@hotmail.com
RAFAELLA MENDES FORTUNATO	mendesrafaella86@gmail.com
RENATA GRALATO DO NASCIMENTO ARAUJO	renatagralato@hotmail.com
ROSEMARY SOUSA DA RESSURREIÇÃO	rosemary14souzaressurreicao@gmail.com
ROSIANE DE SOUZA SILVA LOPES	nanesouzalopes555@gmail.com
SARAH IANAE GUETHS LAGUNA	sarahiglaguna@hormail.com
SEVERINA GERLANI DA SILVA MONTEIRO	gerlainevellyn@gmail.com
STEFANY ALVES SILVA DE ALMEIDA	stefanyalvs@hotmail.com
TAIANA SANTANA FRANCA	taiana_santana17@hotmail.com
TATIANA CORDEIRO RIBEIRO	tatianacordeiro41@gmail.com
THAIS DA SILVA E SILVA	thaissilva.t2s@gmail.com
THAMIRES FERNANDES MACHADO	thamiresgrativolmac@gmail.com
VAGNER FONSECA DA CONCEICAO	vagnerfonseca2010@bol.com.br
VANESSA SOARES DE AZEVEDO	vanessa1984soares@gmail.com
VICTORIA PINTO MARTINS	victoriapintomartins@hotmail.com
VINICIUS CURTY DE FREITAS	viniciuscurtydf@gmail.com
WAGNER FECHER OLIVEIRA DA SILVA	wagnerfecher02@gmail.com
ABIGAIL DIAS DOS SANTOS	abigaildiassantos23@gmail.com
ALEIXO TELES	catolica_ecciza10@hotmail.com
ALEXANDRE DA SILVA LIMA JUNIOR	silvaalexandre733@gmail.com
ALMIR MACEDO JUNIOR	almirmacedojunior@gmail.com
ALTAIR NAZARIO DE FIGUEIREDO	altairnazario02@gmail.com
ANDERSON DE AGUIAR REBECCHI	ninotricolor72@gmail.com
ANDERSON LUIZ LINHARES REBECHI	arebechi@tortillas.com.br
ANDRE DE OLIVEIRA GERMINIANO	germinianoandre89@gmail.com
ANDRE RIOS LEMOS	
ANDRESSA LANDIM BARBOSA	dedelandimb@gmail.com
ANTONIO DA SILVA CASTRO	antoniobuque55@gmail.com
ARTHUR PONTES MELONI DOS REIS	arthurpmr10@gmail.com
ATILA DE OLIVEIRA GERVAZIO PENKUHN	atilaoli712@gmail.com
CAIO CESAR OURIQUE DA SILVA	ouriquecaio1@gmail.com
CAIO MENEZES REPANI DE AZEVEDO	caio.menezesrepani@gmail.com
CARLOS EDUARDO DO CANTO MARQUES	carloscanto50@gmail.com
COSME PENA VIANA	cosmeviana62@gmail.com
CRISTIANE HILARIA DE SOUZA	spetersonp@gmail.com
CRISTIANE LOPES NARCIZO	cristianelopesnarcizo@gmail.com
CRISTIANO PIRES DE SOUZA	cp5460389@gmail.com
CRISTIANO RIBEIRO VIEIRA	tianinhoribeiro@gmail.om
DAIANI MORAES CONCEICAO GUIMARAES	daianiedu@gmail.com
DANIEL DE SOUZA PIRES	daniel.pires@unigranrio.com
DANIEL MARTINS PEREIRA SILVA	dn240silva@gmail.com
DANIEL RODRIGO PEREIRA DO NASCIMENTO	danielrodrigo465@gmail.com
DIEGO JUNIOR AMORIM PAIVA	diegojr537@gmail.com
DIEGO VAZ GOMES  VIANA	diegovazgomesviana89@gmail.com
DIOGO DA CONCEICAO CAMARA LOPES	diogolopes0104@gmail.com
DORILAN ROSA VIEIRA XAVIER	dorilanrosavieira@yahoo.com.br
ELIANE FERREIRA DA SILVA LEMOS	elianelemos455@gmail.com
ELIAS SOARES FERREIRA	eliasnatosophi@gmail.com
ELIZABETH DA SILVA GONÇALVES DOS SANTOS	kevingoncalves219@gmail.com
ELMANO DAVI TRISTAO	elmanodavi09@gmail.com
ERIC BILE ARRUDA DOS SANTOS	erickbile408@gmail.com
EVERTON FERREIRA LOPES	ev.lopes16@gmail.com
FABIANO GUARNIERI AQUINO	fabiano_guarnieri@hotmail.com
FABRICIO KRUGER BREMIKAMP	
FAGNO LIMA FIGUEIREDO	ianafrutuoso@outlook.com
GABRIEL DOS SANTOS BARCELLO	gabrielbarcello1313@gmail.com
GABRIEL PIRES LOPES	gabriel0974932@gmail.com
GABRIELA FERRAZ SIQUEIRA	gabiferraz020@gmail.com
GARY ALLEN URBAN	gary@tortillas.com.br
GILMAR LOURENCO REZENDE JUNIOR	gilmar.rezende172@gmail.com
GUILHERME RAMOS PINTO	pontramos2017@gmail.com
GUSTAVO QUINTEIRO LIMA	gustavo27.limaa@gmail.com
HENRIQUE ANDRADE DA FONSECA	henriquefonseca5220@gmail.com
HESTEFFANI DE OLIVEIRA MARTELETE	hesteffani@hotmail.com
HIGOR MENEGUSSI XAVIER	higor.m.xavier23@gmail.com
IAN FRANCA DE ALMEIDA	iannalmmeida@icloud.com
IAN SERRADO FRUTUOSO	ianserrado03@gmail.com
IGOR MARTELETE DA SILVA	igormsilva50@gmail.com
IONAN SERRADO FRUTUOSO	ionanserrado90@gmail.com
ISABELA SERRADO FRUTUOSO	isabela-serrado13@hotmail.com
ISABELLE LAIS SANT'ANNA AMORIM	isah123321love@gmail.com
ISAIAS DA SILVA OLIVEIRA AMORIM	amorimbr321@gmail.com
ISETE MARIA PEREIRA NASCENTE	marianascente7@gmail.com
ITALO DA ROCHA DIAS SILVA	itallomaraquinha@gmail.com
JAIME GONÇALVES DE ABREU	jaimegoncalves32255@gmail.com
JANAINA VALENTIM DA SILVA	janar.d.o@hotmail.com
JEFFERSON DE PINHO ANACLETO	jefferson.cpl@hotmail.com
JESSE MACHADO DE OLIVEIRA	jessemachadodeoliveira@gmail.com
JESSE ROCHA DA CUNHA	jesse_rcunha@hotmail.com
JHONE DE ANDRADE BARBOSA	jhoneandrade75@gmail.com
JOABE DA SILVA FONSECA	joabezorro@gmail.com
JOAO FELIPE CARNEIRO MAGALHAES	joaofelipeandrade18@gmail.com
JOAO VICTOR DA SILVA DIAS	jvdias2203@gmail.com
JOETH PEREIRA RAMOS	joethpereira@gmail.com
JOSUE MACHADO DE OLIVEIRA	josuemachadodeoliveira30@gmail.com
JULIA ROSSI GUIMARAES	juliarossieu@icloud.com
JULIO CESAR DEMARCE SAMPAIO	sampaiojulio86@gmail.com
KAUA SANTOS DE ALMEIDA	kauasantosalmeida06@gmail.com
KEVIN LEAL OURIQUE DE CARVALHO	kevin.ourique@gmail.com
LARISSA DA SILVA PINTO	dsp.larissa@gmail.com
LEONARDO CUNHA DIAS	leodias0468@gmail.com
LEONARDO SANTOS FRANCO	leofranco96@gmail.com
LILIANA MEDRANO DE SOUZA	enzofelipecarmo755@gmail.com
LINDIOMAR NAZARIO DE FIGUEIREDO	eunazario3@gmail.com
LUANA APARECIDA DE OLIVEIRA PIRES	oliveiraluana756@yahoo.com.br
LUCAS DE CASTRO GONCALVES	lucascastrog29@gmail.com
LUCIANA LEAL DA SILVA OURIQUE DE CARVALHO	lucianaleal111070@gmail.com
LUCIANO PICONI FURTADO	lucianofurtado788@gmail.com
LUCIMAR MACEDO QUADROS NASCIMENTO	lucimar.quadros.lq@gmail.com
LUIS FERNANDO DE OLIVEIRA LEMOS	luissequoia123@gmail.com
LUIZ AUGUSTO BENEVENTE BITTENCOURT	gutobittencourt87@gmail.com
MARCIA CRISTINA BARBOSA CORDEIRO	marcyabarboza@gmail.com
MARCILENE VIANA LOPES	marcilene.lopes936612@gmail.com
MARCUS VINÍCIUS DOS SANTOS BRAGA	marcusviniciussbraga@gmail.com
MARIA LUIZA CAMACHO BATISTA	malubatistabatista@gmail.com
MARIA LUIZA SOARES DA SILVA	marialuizasoares1209@gmail.com
MARIA REGINA FERREIRA DOS SANTOS	regina.ferreira1993@gmail.com
MICHEL DEMARCE SAMPAIO	micheldemarce9@gmail.com
NATALIA LOPES TAVARES	natalia_16tavares@hotmail.com
NAYARA CABRAL DOS SANTOS	nayaracabralsantos@gmail.com
NILTA LEANDRO	niltaleandro6@outlook.com
ODIRLEI MARIANO PINHEIRO	odirleimp@gmail.com
PATRICIA DE SIQUEIRA	pattysiqueira147@gmail.com
PEDRO HENRIQUE LARANJEIRA TEIXEIRA PINTO	pedrolaranjeira09@gmail.com
PEDRO JOSE BARBOSA REPANI	pedrorepani@outlook.com
PEDRO LUCAS OLIVEIRA FERRAZ E SILVA	pedroolferraz@gmail.com
PHILLIPE FREITAS DE OLIVEIRA	phillfreitasdeoliveira@gmail.com
PRISCILA MUZI ALVES	priscila.muzi@yahoo.com.br
RAFAEL DO NASCIMENTO DA SILVA	rafael2006010@gmail.com
RAFAEL SIQUEIRA MELONI	rafasmeloni@gmail.com
REBECA HERCULANO MENEZES	rebecamenezes67@gmail.com
REDRIK MACHADO CALDEIRA	redrikmc@gmail.com
RENAN RAMOS D ANUNCIACAO	renanramos637@gmail.com
SAMARA SOARES DA SILVA	samaras2protegida@gmail.com
SAMUEL REIS VIANA	samuelreisviana@icloud.com
SARA SOARES TOBIAS DA COSTA	stobiasmoreira@gmail.com
SUELI GOMES DE ARAUJO	sueliigomesdearaujo@gmail.com
SUELLEM CARLA AMORIM DE ARRUDA	suellenarruda87@gmail.com
TAIGUARA DA SILVA	taiguaradasilva382@gmail.com
TATYANE VIEIRA MARCHIORO	tatyvm@outlook.com
THIAGO PEREIRA DE SOUZA	thiagotim1@hotmail.com
TIAGO DE SOUZA PIRES	tiagoneguet.tjf@gmail.com
UBIRACI GOMES FERREIRA	dilmaegoita@gmail.com
UELLINTON PAULA DOS SANTOS	uellintonpaulasantos@gmail.com
VALCILEA DE OLIVEIRA FERRAZ	valcilea0806@gmail.com
VANESSA LOPES DA SILVA	vanessa.macae@gmail.com
VINICIUS RANGEL DE JESUS	rangelvinicius92@gmail.com
VITOR FERREIRA DE ALMEIDA	vitor.ferreiraa@hotmail.com
WENDEL DA SILVA MAGALHÃES	wendelmagalhaes82@gmail.com
WESLEY BORGES DE SOUZA	wlbsouza@outlook.com
WEVERTON DIAS LIAL	wevertonlial01@gmail.com
ALFREDO ANTONIO RODRIGUEZ RAMIREZ	israelprime6987@gmail.com
CAIO GONÇALVES CANDIDO	caio.gcandido@gmail.com
DANILLO HENRIQUE AUGUSTO AGUIAR	danillohenriqueaugusto@gmail.com
DOMINGOS SOARES LEAO	domingos.soares1985@gmail.com
ERIC MEDINA GONCALVES DE SOUSA	ericmedinags@gmail.com
EUDISMAR ALVES MENDES	eudesmar0222@gmail.com
GUILHERME CORREA E SILVA	guilhermecorrea492@gmail.com
MANUELLA VILAR PEREIRA DA SILVA	manuellavilar3@gmail.com
PAMELA DE LIMA OLIVEIRA	ppamelinhalimaoliveira@gmail.com
WILLIAM RODRIGUES BATISTA	willianrodri31@gmail.com
ELTON DOS SANTOS	eltonsantos100@hotmail.com
GARY ALLEN URBAN	gary@tortillas.com.br
PAULA LOPES DA SILVA PINTO	paulalpinto@gmail.com




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
