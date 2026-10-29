<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'course_id'];

    // Each registration belongs to one student
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // Each registration belongs to one course
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}