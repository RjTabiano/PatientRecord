<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('patient_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->string('type');
            $table->date('birthdate')->nullable();
            $table->string('sex');
            $table->integer('age');
            $table->string('address');
            $table->string('mother_name');
            $table->integer('mother_phone');
            $table->string('father_name');
            $table->integer('father_phone');
            $table->timestamps();
            $table->foreign('patient_id')
                    ->references('id')
                    ->on('patients')
                    ->onDelete('cascade');
        });
        Schema::create('vaccines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_record_id');
            $table->text('BCG')->nullable();
            $table->text('Hepatitis_B')->nullable();
            $table->text('DPT')->nullable();
            $table->text('Polio_OPU')->nullable();
            $table->text('Polio_IPU')->nullable();
            $table->text('HiB')->nullable();
            $table->text('PCV')->nullable();
            $table->text('Measles')->nullable();
            $table->text('Varicella')->nullable();
            $table->text('mmra')->nullable();
            $table->text('Hepatitis_A')->nullable();
            $table->text('Meningo')->nullable();
            $table->text('Typhoid')->nullable();
            $table->text('Jap_Enceph')->nullable();
            $table->text('HPV')->nullable();
            $table->text('Flu')->nullable();
            $table->timestamps();
            $table->foreign('patient_record_id')
                    ->references('id')
                    ->on('patient_records')
                    ->onDelete('cascade');
        });
        
        Schema::create('obgyne', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->unsignedInteger('patient_id');
            $table->integer('age');
            $table->string('civil_status');
            $table->string('address');
            $table->integer('contact_number');
            $table->string('occupation');
            $table->string('religion');
            $table->string('referred_by');
            $table->integer('emergency_contact_no');
            $table->timestamps();
            $table->foreign('patient_id')
                    ->references('id')
                    ->on('patients')
                    ->onDelete('cascade');
        });
        Schema::create('medical_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obgyne_id');
            $table->text('history')->nullable();
            $table->timestamps();
            $table->foreign('obgyne_id')
                    ->references('id')
                    ->on('obgyne')
                    ->onDelete('cascade');
        });
        
        Schema::create('consultation_pediatrics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->dateTime('dateTime')->nullable();
            $table->longText('history')->nullable();
            $table->longText('orders')->nullable();
            $table->string('created_by');
            $table->timestamps();
            $table->foreign('patient_id')
                    ->references('id')
                    ->on('patients')
                    ->onDelete('cascade');
        });

















    }

    /**php
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
        Schema::dropIfExists('patient_records');
        Schema::dropIfExists('obgyne');
        Schema::dropIfExists('vaccines');
        Schema::dropIfExists('medical_history');
        Schema::dropIfExists('consultation_pediatrics');
    

    }
};
