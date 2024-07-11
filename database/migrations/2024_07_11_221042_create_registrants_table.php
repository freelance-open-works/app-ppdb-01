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
        Schema::create('registrants', function (Blueprint $table) {
            $table->ulid('id')->primary();
            //
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('nik')->nullable();
            $table->string('nisn')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('junior_sch')->nullable();
            $table->string('junior_sch_year')->nullable();
            $table->string('address')->nullable();
            $table->string('village')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('regency')->nullable();
            $table->string('phone')->nullable();
            $table->string('number_kis_pkh')->nullable();
            $table->string('description')->nullable();
            $table->string('coordinate')->nullable();
            $table->string('distance')->nullable();
            $table->string('status')->nullable();
            //
            $table->timestamps();
            $table->softDeletes();
            $table->ulid('created_by')->nullable();
            $table->ulid('updated_by')->nullable();
            $table->ulid('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrants');
    }
};
