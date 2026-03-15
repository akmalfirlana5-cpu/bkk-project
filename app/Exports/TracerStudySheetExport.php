<?php

namespace App\Exports;

use App\Models\WorkFill;
use App\Models\CollegeFill;
use App\Models\EntrepreneurFill;
use App\Models\UnemployedFill;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TracerStudySheetExport implements FromQuery, WithHeadings, WithMapping, WithTitle, WithColumnFormatting, WithStyles
{
    protected string $type;
    protected ?array $userIds;

    public function __construct(string $type, ?array $userIds = null)
    {
        $this->type = $type;
        $this->userIds = $userIds;
    }

    public function query()
    {
        $query = match ($this->type) {
            'bekerja' => WorkFill::query()->with('user')->orderBy('created_at', 'desc'),
            'kuliah' => CollegeFill::query()->with('user')->orderBy('created_at', 'desc'),
            'wirausaha' => EntrepreneurFill::query()->with('user')->orderBy('created_at', 'desc'),
            'belum_bekerja' => UnemployedFill::query()->with('user')->orderBy('created_at', 'desc'),
            default => WorkFill::query()->with('user'),
        };

        if (!empty($this->userIds)) {
            $query->whereIn('id_user', $this->userIds);
        }

        return $query;
    }

    public function title(): string
    {
        return match ($this->type) {
            'bekerja' => 'Bekerja',
            'kuliah' => 'Kuliah',
            'wirausaha' => 'Wirausaha',
            'belum_bekerja' => 'Belum Bekerja',
            default => 'Data',
        };
    }

    public function headings(): array
    {
        $baseHeadings = [
            'Nama Lengkap',
            'NISN',
            'No HP',
            'Email',
            'Tahun Kelulusan',
            'Jurusan SMK',
        ];

        $specificHeadings = match ($this->type) {
            'bekerja' => [
                'Perusahaan/Instansi',
                'Posisi/Jabatan',
                'Pendapatan/Bulan',
                'Lokasi',
                'Kesesuaian dengan Jurusan',
                'Tanggal Mulai',
            ],
            'kuliah' => [
                'Nama Universitas/Perguruan Tinggi',
                'Program Studi/Jurusan',
                'Gelar',
                'Tanggal Mulai',
            ],
            'wirausaha' => [
                'Nama Usaha',
                'Bidang Usaha',
                'Pendapatan/Bulan',
                'Lokasi',
                'Kesesuaian dengan Jurusan',
                'Media Sosial/Link Usaha',
                'Tanggal Mulai',
            ],
            'belum_bekerja' => [
                'Alasan',
                'Aktivitas Saat Ini',
                'Rentang Waktu Menganggur',
            ],
            default => [],
        };

        return array_merge($baseHeadings, $specificHeadings, ['Tanggal Pengisian']);
    }

    public function map($row): array
    {
        $userStr = function ($val) {
            // Force string conversion to prevent numeric interpretation in mapping phase
            return $val !== null ? (string) $val : '-';
        };

        $baseData = [
            $userStr($row->user->full_name ?? '-'),
            $userStr($row->user->nisn ?? '-'),
            $userStr($row->user->no_hp ?? '-'),
            $userStr($row->user->email ?? '-'),
            $userStr($row->user->graduation_year ?? '-'),
            $userStr($row->user->major ?? '-'),
        ];

        $specificData = match ($this->type) {
            'bekerja' => [
                $userStr($row->company_name),
                $userStr($row->position),
                $userStr($row->salary),
                $userStr($row->location),
                $userStr($row->major_relevance),
                $row->start_date ? $row->start_date->format('d/m/Y') : '-',
            ],
            'kuliah' => [
                $userStr($row->university_name),
                $userStr($row->major),
                $userStr($row->degre),
                $row->start_date ? $row->start_date->format('d/m/Y') : '-',
            ],
            'wirausaha' => [
                $userStr($row->company_name),
                $userStr($row->field),
                $userStr($row->salary),
                $userStr($row->location),
                $userStr($row->major_relevance),
                $userStr($row->sosial_media),
                $row->start_date ? $row->start_date->format('d/m/Y') : '-',
            ],
            'belum_bekerja' => [
                $userStr($row->reason),
                $userStr($row->activity),
                $userStr($row->timespan),
            ],
            default => [],
        };

        return array_merge($baseData, $specificData, [$row->created_at ? $row->created_at->format('d/m/Y H:i') : '-']);
    }

    public function columnFormats(): array
    {
        // To strictly ensure ALL columns are treated as text in Excel:
        $formats = [];
        
        // Assuming max 20 columns for our data. Setting all from A to Z as TEXT.
        foreach (range('A', 'Z') as $columnID) {
            $formats[$columnID] = NumberFormat::FORMAT_TEXT;
        }

        return $formats;
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
