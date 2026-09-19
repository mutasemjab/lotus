<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow_en')->nullable();
            $table->string('eyebrow_ar')->nullable();
            $table->text('title_en')->nullable();
            $table->text('title_ar')->nullable();
            $table->text('paragraph1_en')->nullable();
            $table->text('paragraph1_ar')->nullable();
            $table->text('paragraph2_en')->nullable();
            $table->text('paragraph2_ar')->nullable();
            $table->string('image')->nullable();
            $table->string('badge_number')->nullable();
            $table->string('badge_text_en')->nullable();
            $table->string('badge_text_ar')->nullable();
            $table->timestamps();
        });

        Schema::create('about_stats', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->string('label_en');
            $table->string('label_ar');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_stats');
        Schema::dropIfExists('about_sections');
    }
};
