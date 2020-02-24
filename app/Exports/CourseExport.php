<?php

namespace App\Exports;

use App\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class CourseExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Course::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'TITLE',
            'TUTOR',
            'DURATION',
            'TEXT',
            'CREATED AT',
            'UPDATED AT',
        ];
    }
}
