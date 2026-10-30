<?php
namespace App\Http\Controllers;

use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();
        $query = CourseRegistration::with(['student', 'course']);

        // Only people with "view registrations" (the administrator) see everyone's.
        // Anyone else (a student) sees only their own.
        if (! $user->can('view registrations')) {
            $query->where('student_id', $user->student?->id ?? 0);
        }

        // Optional search by student name or number, or course code or title
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', fn($s) => $s->where('name', 'like', "%{$search}%")
                        ->orWhere('student_number', 'like', "%{$search}%"))
                    ->orWhereHas('course', fn($c) => $c->where('title', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%"));
            });
        }

        $registrations = $query->latest()->get();

        return view('registrations.index', compact('registrations'));
    }

    public function create()
    {return view('registrations.create');}
    public function store(Request $request)
    {return redirect()->route('registrations.index');} // STUB
    public function destroy(string $id)
    {return redirect()->route('registrations.index');}     // STUB
}
