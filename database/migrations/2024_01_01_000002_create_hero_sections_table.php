<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('kicker_en')->nullable();
            $table->string('kicker_ar')->nullable();
            $table->text('title_en')->nullable();
            $table->text('title_ar')->nullable();
            $table->text('lead_en')->nullable();
            $table->text('lead_ar')->nullable();
            $table->string('btn1_text_en')->nullable();
            $table->string('btn1_text_ar')->nullable();
            $table->string('btn1_link')->nullable();
            $table->string('btn2_text_en')->nullable();
            $table->string('btn2_text_ar')->nullable();
            $table->string('btn2_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
