<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_phones', function (Blueprint $table) {
            $table->id();
            $table->string('label_en')->nullable();
            $table->string('label_ar')->nullable();
            $table->string('phone');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('contact_locations', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('address_en')->nullable();
            $table->text('address_ar')->nullable();
            $table->string('maps_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_locations');
        Schema::dropIfExists('contact_phones');
    }
};
