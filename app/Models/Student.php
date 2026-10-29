<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    // Columns allowed for mass assignment (Student::create([...]))
    protected $fillable = ['user_id', 'student_number', 'name', 'email', 'phone'];

    // A student belongs to one login account
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Many-to-many: the courses this student is registered for (Q1c)
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_registrations')
                    ->withTimestamps();
    }

    // One-to-many: this student's rows in the registrations table
    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }
}