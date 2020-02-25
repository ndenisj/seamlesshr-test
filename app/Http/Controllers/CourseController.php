<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CourseExport;
use App\Jobs\CreateCoursesJob;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        CreateCoursesJob::dispatch()->delay(now()->addSeconds(5));

        return response()->json([
            'success' => true,
            'message' => 'Courses created successfully'
        ], 200);
    }

    public function export()
    {
        return Excel::download(new CourseExport, 'courses.xlsx');
    }
}
