<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TracerStudyExport implements WithMultipleSheets
{
    use Exportable;

    protected string $type;
    protected ?array $userIds;

    /**
     * @param string $type The specific category to export ('bekerja', 'kuliah', etc.) or 'semua' for all categories.
     * @param array|null $userIds Array of user IDs to filter the export (for bulk actions).
     */
    public function __construct(string $type = 'semua', ?array $userIds = null)
    {
        $this->type = $type;
        $this->userIds = $userIds;
    }

    public function sheets(): array
    {
        $sheets = [];

        if ($this->type === 'semua') {
            $sheets[] = new TracerStudySheetExport('bekerja', $this->userIds);
            $sheets[] = new TracerStudySheetExport('kuliah', $this->userIds);
            $sheets[] = new TracerStudySheetExport('wirausaha', $this->userIds);
            $sheets[] = new TracerStudySheetExport('belum_bekerja', $this->userIds);
        } else {
            $sheets[] = new TracerStudySheetExport($this->type, $this->userIds);
        }

        return $sheets;
    }
}
