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
        Schema::dropIfExists('hero_slides');

        // Change value column to longText for JSON data (Builder component)
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->longText('value')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->string('cta_text')->nullable()->default('Lihat Selengkapnya');
            $table->string('cta_link')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->text('value')->nullable()->change();
        });
    }
};
