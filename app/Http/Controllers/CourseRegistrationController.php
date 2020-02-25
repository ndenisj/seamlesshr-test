<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\CourseResource;
use JWTAuth;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    /**
     * Holds the current logged in user
     * @var User
     */
    protected $user;

    public function __construct()
    {
        // get the current logged in user
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Store a newly created resource in storage.
     * @authenticated
     * @throws \Illuminate\Validation\ValidationException
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Display a listing of the resource.
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     */
    public function all_courses()
    {
        return  CourseResource::collection(Course::all())->getUser($this->user);
    }
}
