<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseResourceCollection;
use JWTAuth;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    protected $user;

    public function __construct()
    {
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
        // $permissions = Course::select('id', 'title')->with('users')->get()->toArray();


        // $mappedPermissions = array_map(function ($permission) { 
        //     $permission['user_id'] = data_get($permission, '0.pivot.user_id');

        //     return $permission; 
        // }, $permissions);

        return CourseResource::collection(Course::all());
    }
}
