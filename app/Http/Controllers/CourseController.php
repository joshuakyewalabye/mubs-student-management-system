<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();
        $query = Course::with('lecturer')->withCount('students');

        // Administrator and student have "view courses" and see every course.
        // A lecturer does not, so they see only the courses assigned to them.
        if (! $user->can('view courses')) {
            $query->where('lecturer_id', $user->id);
        }

        // Optional search by course code or title
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy('code')->get();

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $user = Auth::user();

        // A lecturer may open only their own courses; anyone else gets 403
        if (! $user->can('view courses') && (int) $course->lecturer_id !== (int) $user->id) {
            abort(403);
        }

        // Only the administrator and lecturers may see who is registered.
        // A student must not see the other students.
        $showStudents = $user->can('view registrations') || $user->can('view assigned courses');

        $course->load('lecturer');
        if ($showStudents) {
            $course->load(['students' => fn($q) => $q->orderBy('name')]);
        }

        return view('courses.show', compact('course', 'showStudents'));
    }

    // Placeholders: built in the course CRUD branch
    public function create()
    {return view('courses.create');}
    public function store(Request $request)
    {return redirect()->route('courses.index');}
    public function edit(string $id)
    {return view('courses.edit');}
    public function update(Request $request, string $id)
    {return redirect()->route('courses.index');}
    public function destroy(string $id)
    {return redirect()->route('courses.index');}
}
