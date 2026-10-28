<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('registrations.index');
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
