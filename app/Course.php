<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'tutor', 'duration', 'text'];

    /**
     * Get Users that belongs to the course
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }
}
