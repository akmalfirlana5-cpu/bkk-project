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
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('student_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('major_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('major_id')->nullable()->constrained('majors')->nullOnDelete();
            $table->foreignId('student_class_id')->nullable()->constrained('student_classes')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropForeign(['student_class_id']);
            $table->dropColumn(['major_id', 'student_class_id']);
        });

        Schema::dropIfExists('student_classes');
        Schema::dropIfExists('majors');
    }
};
