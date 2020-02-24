<?php

namespace App\Http\Resources;

use JWTAuth;
use App\UserCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    // get the user's object 
    protected $user;
    public function getUser($value)
    {
        $this->user = $value;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "id" => $this->id,
            "title" => $this->title,
            "tutor" => $this->tutor,
            "duration" => $this->duration,
            "text" => $this->text,
            "reg_date" => $this->when(DB::table('user_courses')->where([['course_id', '=', $this->id], ['user_id', '=', $this->user->id]])->exists(), function () {
                return DB::table('user_courses')->where([['course_id', '=', $this->id], ['user_id', '=', $this->user->id]])->pluck('registration_date')->first();
            }),
        ];
    }

    public static function collection($resource)
    {
        return new CourseResourceCollection($resource);
    }
}
