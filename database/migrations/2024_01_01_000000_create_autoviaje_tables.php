<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tablas de Catálogo

        if (!Schema::hasTable('tp_permiso')) {
            Schema::create('tp_permiso', function (Blueprint $table) {
                $table->integer('id_tppermi')->autoIncrement();
                $table->string('des_tppermi', 30)->nullable();
            });
        }

        if (!Schema::hasTable('tp_documento')) {
            Schema::create('tp_documento', function (Blueprint $table) {
                $table->integer('id_tpdoc')->autoIncrement();
                $table->string('des_tpdoc', 50);
                $table->string('abrev_tpdoc', 20)->nullable();
            });
        }

        if (!Schema::hasTable('tp_transporte')) {
            Schema::create('tp_transporte', function (Blueprint $table) {
                $table->integer('id_tptrans')->autoIncrement();
                $table->string('des_tptrans', 255);
                $table->string('abrev_tptrans', 10);
            });
        }

        if (!Schema::hasTable('tp_relacion')) {
            Schema::create('tp_relacion', function (Blueprint $table) {
                $table->integer('id_tp_relacion')->autoIncrement();
                $table->string('descripcion', 50)->unique();
            });
        }

        if (!Schema::hasTable('ubigeo')) {
            // Nota: id_ubigeo es varchar(6) en la BD, no auto-increment
            Schema::create('ubigeo', function (Blueprint $table) {
                $table->string('id_ubigeo', 6)->primary();
                $table->string('nom_dis', 50);
                $table->string('nom_prov', 50);
                $table->string('nom_dpto', 50);
                $table->string('cod_dist', 2);
                $table->string('cod_prov', 2);
                $table->string('cod_dpto', 2);
            });
        }

        if (!Schema::hasTable('nacionalidades')) {
            Schema::create('nacionalidades', function (Blueprint $table) {
                $table->integer('id_nacionalidad')->autoIncrement();
                $table->char('cod_nacion', 2);
                $table->string('desc_nacionalidad', 100);
                $table->string('gentilicio', 100);
            });
        }

        // 2. Tablas Principales

        if (!Schema::hasTable('personas')) {
            Schema::create('personas', function (Blueprint $table) {
                $table->integer('id_persona')->autoIncrement();
                $table->integer('id_tpdoc'); // FK
                $table->string('num_doc', 255)->unique();
                $table->string('apellidos', 100);
                $table->string('nombres', 100);
                $table->integer('edad')->nullable();
                $table->string('tipo_edad', 50)->nullable();

                $table->integer('id_nacionalidad')->nullable();
                $table->string('id_ubigeo', 6)->nullable();

                $table->string('direccion', 255)->nullable();
                $table->tinyInteger('es_menor')->default(0);
            });
        }

        if (!Schema::hasTable('autorizaciones')) {
            Schema::create('autorizaciones', function (Blueprint $table) {
                $table->integer('id_autorizacion')->autoIncrement();
                $table->string('nro_kardex', 50)->default('0');
                $table->string('encargado', 20);
                $table->integer('id_tppermi');
                $table->date('fecha_ingreso');
                $table->string('viaja_a', 255);

                // Datos Acompañante
                $table->integer('id_tpdoc_acomp');
                $table->string('num_doc_acomp', 15);
                $table->string('nombres_acomp', 100);
                $table->string('apellidos_acomp', 100);

                // Datos Responsable
                $table->integer('id_tpdoc_resp');
                $table->string('num_doc_resp', 15);
                $table->string('nombres_resp', 100);
                $table->string('apellidos_resp', 100);

                // Transporte
                $table->integer('id_tptrans');
                $table->string('agencia_transporte', 255)->nullable();
                $table->string('tiempo_viaje', 150);

                $table->text('observaciones')->nullable();
            });
        }

        if (!Schema::hasTable('personas_autorizaciones')) {
            Schema::create('personas_autorizaciones', function (Blueprint $table) {
                $table->integer('id_persona_autorizacion')->autoIncrement();
                $table->integer('id_autorizacion');
                $table->integer('id_persona');
                $table->integer('id_tp_relacion');
                $table->enum('firma', ['SI', 'NO', 'HUELLA'])->default('SI');

                // Indices para facilitar busquedas
                $table->index('id_autorizacion');
                $table->index('id_persona');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas_autorizaciones');
        Schema::dropIfExists('autorizaciones');
        Schema::dropIfExists('personas');
        Schema::dropIfExists('nacionalidades');
        Schema::dropIfExists('ubigeo');
        Schema::dropIfExists('tp_relacion');
        Schema::dropIfExists('tp_transporte');
        Schema::dropIfExists('tp_documento');
        Schema::dropIfExists('tp_permiso');
    }
};
