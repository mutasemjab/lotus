<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('section_headers', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique();
            $table->string('eyebrow_en')->nullable();
            $table->string('eyebrow_ar')->nullable();
            $table->text('title_en')->nullable();
            $table->text('title_ar')->nullable();
            $table->text('subtitle_en')->nullable();
            $table->text('subtitle_ar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_headers');
    }
};
