<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'title', 'credits', 'lecturer_id'];

    // A course belongs to one lecturer (a User).
    // The foreign key is lecturer_id, not user_id, so we name it.
    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    // Many-to-many: the students registered for this course (Q1c)
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_registrations')
                    ->withTimestamps();
    }

    // One-to-many: this course's rows in the registrations table
    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }
}