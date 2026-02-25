<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Throwable;
use Carbon\Carbon;

class UsersImport implements ToModel, WithHeadingRow, SkipsOnError, \Maatwebsite\Excel\Concerns\SkipsEmptyRows
{
    use SkipsErrors;

    public function headingRow(): int
    {
        return 1;
    }

    public function model(array $row)
    {
        // Debugging: Log data baris yang sedang diproses
        \Illuminate\Support\Facades\Log::info('Processing Row:', $row);

        // 1. Validasi Keberadaan Kolom Utama
        // Jika row kosong atau key utama tidak ada, skip.
        // NOTE: Kita cek isset untuk key utama. Jika file export tidak sesuai, header mungkin tidak terbaca.
        if (!isset($row['nisn']) || !isset($row['nama_lengkap'])) {
            \Illuminate\Support\Facades\Log::warning('Skipping row: Missing NISN or Nama Lengkap', $row);
            return null;
        }

        // 2. Pembersihan NISN
        $cleanNisn = preg_replace("/['\s,\.]/", '', $row['nisn']);
        
        // Pastikan ada isinya setelah dibersihkan
        if (empty($cleanNisn)) {
            return null;
        }

        // 3. Cek Duplikat di Database
        if (User::where('nisn', $cleanNisn)->exists()) {
             \Illuminate\Support\Facades\Log::info('Skipping duplicate NISN: ' . $cleanNisn);
            return null;
        }

        // 4. Normalisasi Jurusan
        $inputJurusan = isset($row['jurusan']) ? trim($row['jurusan']) : '';
        $validMajors = \App\Models\vacancie::MAJORS;
        $finalMajor = $inputJurusan; // Default pakai input user

        // Coba cari match yang case-insensitive dari daftar baku
        foreach ($validMajors as $major) {
            if (strcasecmp($inputJurusan, $major) === 0) {
                $finalMajor = $major; 
                break;
            }
        }
        // Jika tidak ketemu di daftar baku, kita TETAP SIMPAN input user apa adanya
        // agar data tidak hilang cuma gara-gara jurusan tidak baku.

        // 5. Proses Tahun Lulus (Varchar)
        // Ambil langsung sebagai string. Jika kosong, biarkan null.
        $graduationYear = isset($row['tahun_lulus']) ? (string) $row['tahun_lulus'] : null;

        return new User([
            'nisn'            => $cleanNisn,
            'full_name'       => $row['nama_lengkap'],
            'major'           => $finalMajor,
            'graduation_year' => $graduationYear, // Simpan sebagai string
            'password'        => Hash::make('pass00' . $cleanNisn),
            'role'            => 'user',
        ]);
    }
    public function rules(): array
    {
        return [
            'nisn' => 'required|string',
            'nama_lengkap' => 'required|string',
            'jurusan' => 'required|string|in:' . implode(',', $this->validMajors),
            'tahun_lulus' => 'nullable|date',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'jurusan.in' => 'Jurusan tidak valid. Pilihan: Animasi, DKV, Logistik, Perhotelan, Teknik Grafika, TKJ, RPL, Mekatronika',
        ];
    }
}