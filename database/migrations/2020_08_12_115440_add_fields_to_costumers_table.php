<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCostumersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('costumers', function (Blueprint $table) {
            $table->integer('email_abfragevollmacht_sent')->nullable();
            $table->integer('email_vertretungsvollmacht_sent')->nullable();
			$table->char('zaehlernummer_01',50)->nullable();
			$table->char('zaehlernummer_02',50)->nullable();
			$table->char('zaehlernummer_03',50)->nullable();
			$table->decimal('zaehlerstand_01',9,2)->nullable();
			$table->decimal('zaehlerstand_02',9,2)->nullable();
			$table->decimal('zaehlerstand_03',9,2)->nullable();
			$table->string('file_01')->nullable(); //kundenstammdatenblatt
			$table->string('file_02')->nullable(); //vertretungsvollmacht
			$table->string('file_03')->nullable(); //datenabfragevollmacht
			$table->decimal('ersparnis',7,2)->nullable();
			$table->decimal('ersparnis_netto',7,2)->nullable();
			$table->integer('ersparnis_prozent')->nullable();
			$table->integer('reserved_01')->nullable();
			$table->integer('reserved_02')->nullable();
			$table->char('reserved_03',50)->nullable();
			$table->char('reserved_04',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('costumers', function (Blueprint $table) {
            //$table->dropColumn('paid');
            $table->dropColumn('email_abfragevollmacht_sent');
            $table->dropColumn('email_vertretungsvollmacht_sent');
			$table->dropColumn('zaehlernummer_01');
			$table->dropColumn('zaehlernummer_02');
			$table->dropColumn('zaehlernummer_03');
			$table->dropColumn('zaehlerstand_01');
			$table->dropColumn('zaehlerstand_02');
			$table->dropColumn('zaehlerstand_03');
			$table->dropColumn('file_01');
			$table->dropColumn('file_02');
			$table->dropColumn('file_03');
			$table->dropColumn('ersparnis');
			$table->dropColumn('ersparnis_netto');
			$table->dropColumn('ersparnis_prozent');
			$table->dropColumn('reserved_01');
			$table->dropColumn('reserved_02');
			$table->dropColumn('reserved_03');
			$table->dropColumn('reserved_04');
        });
    }
}
