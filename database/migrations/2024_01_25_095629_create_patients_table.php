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
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });

        Schema::create('pediatrics', function (Blueprint $table) {
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
            $table->longText('history')->nullable();
            $table->longText('orders')->nullable();
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
                    ->on('pediatrics')
                    ->onDelete('cascade');
        });
        
        Schema::create('obgyne', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->unsignedInteger('patient_id');
            $table->integer('age');
            $table->date('birthdate')->nullable();
            $table->text('civil_status');
            $table->string('address');
            $table->integer('contact_number');
            $table->string('occupation');
            $table->string('religion');
            $table->string('referred_by')->nullable();
            $table->integer('emergency_contact_no')->nullable();
            $table->timestamps();
            $table->foreign('patient_id')
                    ->references('id')
                    ->on('patients')
                    ->onDelete('cascade');
        });
        Schema::create('medical_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obgyne_id');
            $table->boolean('Hypertension')->nullable();
            $table->boolean('Bronchial_Asthma')->nullable();
            $table->boolean('Thyroid_Disease')->nullable();
            $table->boolean('Heart_Disease')->nullable();
            $table->boolean('Previous_Surgery')->nullable();
            $table->boolean('Allergy')->nullable();
            $table->text('Family_History')->nullable();
            $table->timestamps();
            $table->foreign('obgyne_id')
                    ->references('id')
                    ->on('obgyne')
                    ->onDelete('cascade');
        });

        Schema::create('baseline_diagnostics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obgyne_id');
            $table->string('CBC_HgB')->nullable();
            $table->string('plt')->nullable();
            $table->string('DPT')->nullable();
            $table->string('Hct')->nullable();
            $table->string('WBC')->nullable();
            $table->string('Blood_Type')->nullable();
            $table->string('FBS')->nullable();
            $table->string('HBsAg')->nullable();
            $table->string('VDRL')->nullable();
            $table->string('HiV')->nullable();
            $table->string('TT')->nullable();
            $table->string('Urinalysis')->nullable();
            $table->string('Other')->nullable();
            $table->timestamps();
            $table->foreign('obgyne_id')
                    ->references('id')
                    ->on('obgyne')
                    ->onDelete('cascade');
        });


        Schema::create('Obgyne_History', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obgyne_id');
            $table->string('gravitiy')->nullable();
            $table->string('parity')->nullable();
            $table->string('OB_score')->nullable();
            $table->string('table')->nullable();
            $table->string('Blood_Type')->nullable();
            $table->string('LMP')->nullable();
            $table->string('PMP')->nullable();
            $table->string('AOG')->nullable();
            $table->string('EDD')->nullable();
            $table->string('early_ultrasound')->nullable();
            $table->string('AOG_by_eutz')->nullable();
            $table->string('EDD_by_eutz')->nullable();
            $table->string('TT1')->nullable();
            $table->string('TT2')->nullable();
            $table->string('TT3')->nullable();
            $table->string('TDAP')->nullable();
            $table->string('Flu')->nullable();
            $table->string('HPV')->nullable();
            $table->string('PCV')->nullable();
            $table->string('covid19_brand')->nullable();
            $table->string('primary')->nullable();
            $table->string('booster')->nullable();
            $table->timestamps();
            $table->foreign('obgyne_id')
                    ->references('id')
                    ->on('obgyne')
                    ->onDelete('cascade');
        });
        
        Schema::create('consultation_pediatrics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->longText('consultation')->nullable();
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
        Schema::dropIfExists('pediatrics');
        Schema::dropIfExists('obgyne');
        Schema::dropIfExists('vaccines');
        Schema::dropIfExists('medical_history');
        Schema::dropIfExists('consultation_pediatrics');
    

    }
};
