<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCambioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->index('fk_Cambio_users1_idx');
            $table->string('tabla', 45)->nullable();
            $table->string('id_Relacionado', 38)->nullable();
            $table->string('accion', 15)->nullable();
            $table->TIMESTAMP('fecha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cambio');
    }
}
