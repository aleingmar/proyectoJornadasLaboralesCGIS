<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_sanitarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargo_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('profesion_id')->nullable()->constrained()->onDelete('set null');
            #$table->enum('profesion', ['Médico', 'Enfermero']);
            #$table->enum('cargo', ['Jefe de Guardia', 'Residente', 'Especialista', 'Dirección']);
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_sanitarios');
    }
};
