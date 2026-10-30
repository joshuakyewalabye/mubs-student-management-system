<?php
namespace App\Http\Controllers;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
       public function index(Request $request)
    {
        $user  = Auth::user();
        $query = CourseRegistration::with(['student', 'course']);

        // Only people with "view registrations" (the admin) see everyone's.
        // Anyone else (a student) sees only their own.
        if (! $user->can('view registrations')) {
            $query->where('student_id', $user->student?->id ?? 0);
        }

        // Optional search by student name or number, or course code or title
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', fn ($s) => $s->where('name', 'like', "%{$search}%")->orWhere('student_number', 'like', "%{$search}%"))
                  ->orWhereHas('course', fn ($c) => $c->where('title', 'like', "%{$search}%")
                                                        ->orWhere('code', 'like', "%{$search}%"));
            });
        }

        $registrations = $query->latest()->get();

        return view('registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Real saving and the duplicate check come later.
        return redirect()->route('registrations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('registrations.index');
    }
}
