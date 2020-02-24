<?php

namespace App\Http\Controllers;

use App\Exports\CourseExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{
    public function export()
    {
        return Excel::download(new CourseExport, 'courses.xlsx');
    }
}
