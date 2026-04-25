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
        // Update Users Table
        Schema::table('users', function (Blueprint $table) {
            $table->string('domicile')->nullable();
            $table->string('entry_year')->nullable();
            $table->string('major_description')->nullable();
            $table->text('hard_skills')->nullable();
            $table->text('soft_skills')->nullable();
        });

        // Create PklExperiences Table
        Schema::create('pkl_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('company_name');
            $table->string('position');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Update Portfolios Table Name & Columns
        Schema::table('portfolios', function (Blueprint $table) {
            $table->renameColumn('gambar', 'image_path');
            $table->renameColumn('deskripsi', 'description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->renameColumn('image_path', 'gambar');
            $table->renameColumn('description', 'deskripsi');
        });

        Schema::dropIfExists('pkl_experiences');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['domicile', 'entry_year', 'major_description', 'hard_skills', 'soft_skills']);
        });
    }
};
