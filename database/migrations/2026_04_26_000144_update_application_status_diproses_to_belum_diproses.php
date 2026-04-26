<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah jadi varchar dulu agar tidak limitasi enum
        DB::statement("ALTER TABLE applications MODIFY COLUMN status VARCHAR(255)");
        
        DB::table('applications')->whereIn('status', ['diproses', 'dikirim'])->update(['status' => 'belum_diproses']);
        
        // Ubah ke enum baru
        DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('belum_diproses', 'lolos_berkas', 'interview', 'diterima', 'ditolak') DEFAULT 'belum_diproses'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE applications MODIFY COLUMN status VARCHAR(255)");
        DB::table('applications')->where('status', 'belum_diproses')->update(['status' => 'diproses']);
        DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('dikirim', 'diproses', 'diterima', 'ditolak') DEFAULT 'diproses'");
    }
};
