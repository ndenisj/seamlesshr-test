<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\CourseResource;
use JWTAuth;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    protected $user;

    public function __construct()
    {
        // get the current logged in user
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function register_course(Request $request)
    {
        $request->validate([
            'courses' => 'required|array'
        ]);

        $courses = Course::find($request->courses);

        if (!$this->user->courses()->attach($courses))
            return response()->json([
                'success' => true,
                'message' => 'Course registration successful'
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, registration failed'
            ], 500);
    }

    public function all_courses()
    {
        return  CourseResource::collection(Course::all())->getUser($this->user);
    }
}
