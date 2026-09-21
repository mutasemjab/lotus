<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('value')->default(0);
            $table->string('suffix', 10)->nullable();
            $table->string('label_en');
            $table->string('label_ar');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('map_countries', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2);
            $table->string('name_en');
            $table->string('name_ar');
            $table->decimal('latitude', 8, 4);
            $table->decimal('longitude', 8, 4);
            $table->boolean('is_hub')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('shipping_modes', function (Blueprint $table) {
            $table->id();
            $table->string('icon', 10)->default('sea'); // sea | air | land
            $table->string('tag_en')->nullable();
            $table->string('tag_ar')->nullable();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('link')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('shipping_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_mode_id')->constrained('shipping_modes')->cascadeOnDelete();
            $table->string('from_en');
            $table->string('from_ar');
            $table->string('to_en')->nullable();
            $table->string('to_ar')->nullable();
            $table->boolean('is_bidirectional')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_routes');
        Schema::dropIfExists('shipping_modes');
        Schema::dropIfExists('map_countries');
        Schema::dropIfExists('site_stats');
    }
};
