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
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthdate')->nullable();
            $table->string('sex');
            $table->integer('age')->nullable();
            $table->string('address');
            $table->string('mother_name');
            $table->bigInteger('mother_phone')->nullable();;
            $table->string('father_name');
            $table->bigInteger('father_phone')->nullable();
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
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age')->nullable();
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
            $table->boolean('Asthma')->nullable();
            $table->boolean('Thyroid_disease')->nullable();
            $table->boolean('Allergy')->nullable();
            $table->text('social_history')->nullable();
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
            $table->date('date')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('FBS')->nullable();
            $table->string('Hgb')->nullable();
            $table->string('Hct')->nullable();
            $table->string('WBC')->nullable();
            $table->string('Platelet')->nullable();
            $table->string('HIV')->nullable();
            $table->string('first_hr')->nullable();
            $table->string('second_hr')->nullable();
            $table->string('HBsAg')->nullable();
            $table->string('RPR')->nullable();
            $table->string('protein')->nullable();
            $table->string('sugar')->nullable();
            $table->string('LMP')->nullable();
            $table->string('PMP')->nullable();
            $table->string('AOG')->nullable();
            $table->string('EDD')->nullable();
            $table->string('early_ultrasound')->nullable();
            $table->string('AOG_by_eutz')->nullable();
            $table->string('EDD_by_eutz')->nullable();
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
            $table->string('gravidity')->nullable();
            $table->string('parity')->nullable();
            $table->string('OB_score')->nullable();
            $table->string('table')->nullable();
            $table->string('M')->nullable();

            $table->string('I')->nullable();
            $table->string('D')->nullable();
            $table->string('A')->nullable();
            $table->string('S')->nullable();
            $table->timestamps();
            $table->foreign('obgyne_id')
                    ->references('id')
                    ->on('obgyne')
                    ->onDelete('cascade');
        });
        
        Schema::create('immunizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obgyne_id');
            $table->string('TT_1')->nullable();
            $table->string('TT_2')->nullable();
            $table->string('TT_3')->nullable();
            $table->string('TT_4')->nullable();
            $table->string('TT_5')->nullable();
            $table->string('flu')->nullable();
            $table->string('Pneumo')->nullable();
            $table->string('hepa_b')->nullable();
            $table->timestamps();
            $table->foreign('obgyne_id')
                    ->references('id')
                    ->on('obgyne')
                    ->onDelete('cascade');
        });



        Schema::create('consultation', function (Blueprint $table) {
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
