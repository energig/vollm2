<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostumer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costumers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			
			$table->foreignId('user_id')->nullable();
            
			$table->char('anrede', 20);
			$table->char('name',100);
			$table->char('uid',30)->nullable();
			$table->char('titel_vorne',30)->nullable();
			$table->char('titel_hinten',30)->nullable();
			$table->date('geburtsdatum')->nullable();
			$table->char('tel',30)->nullable();
			$table->char('email',70)->nullable();

			$table->char('adresse_strasse',70)->nullable();
			$table->char('adresse_plz',10)->nullable();
			$table->char('adresse_stadt',30)->nullable();
			$table->char('adresse_provinz',50)->nullable();
			$table->char('adresse_land',50)->nullable();

			$table->char('urspr_zaehlernummer',50)->nullable();
			$table->char('urspr_energielieferant',100)->nullable();

			$table->char('info',100)->nullable();

			$table->char('konto_inhaber',100)->nullable();
			$table->char('konto_iban',50)->nullable();
			$table->char('konto_bic',50)->nullable();
			$table->boolean('konto_sepa_checked')->default(0);

			$table->boolean('pref_oekostrom')->default(0);
			$table->boolean('pref_strom_aut')->default(0);		
			
			$table->boolean('stammdaten_checked')->default(0);
			$table->boolean('abfragevollmacht_checked')->default(0);
			$table->boolean('vertretungsvollmacht_checked')->default(0);
			
			$table->text('unterschrift_base64',60000)->nullable();
			
			$table->char('url_abfragevollmacht',60)->unique();
			$table->char('url_vertretungsvollmacht',60)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costumers');
    }
}
