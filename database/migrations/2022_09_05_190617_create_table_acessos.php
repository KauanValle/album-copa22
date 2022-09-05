<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAcessos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_access', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuario');
            $table->text('jwt_token');
            $table->timestamps();

            $table->foreign('id_usuario', 'fk_usuarios')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_acessos');
    }
}
