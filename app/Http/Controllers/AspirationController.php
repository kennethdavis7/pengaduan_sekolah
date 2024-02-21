<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use App\Models\Status;

use Inertia\Inertia;

class AspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_value = $request->search;
        $aspirations = Aspiration::with('category', 'status')
        ->join('students', 'students.id', '=', 'aspirations.student_id')
        ->join('student_classes', 'student_classes.id', '=', 'students.id')
        ->when($search_value, function($query, $search_value){
            $query->where('students.nisn', 'like', "%{$search_value}%");
        })
        ->paginate(2)->onEachSide(2);

        return Inertia::render('Aspirations/Index', [
            'aspirations' => $aspirations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspiration $aspiration)
    {
        return Inertia::render('Aspirations/Detail', [
            'aspiration' => $aspiration->load(['student','category', 'status']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspiration $aspiration)
    {
        $statuses = Status::all();
        return Inertia::render('Aspirations/Edit', [
            'aspiration' => $aspiration->load(['student','category', 'status']),
            'statuses' => $statuses
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspiration $aspiration)
    {
        $validatedData = $request->validate([
            'status_id' => 'required',
            'feedback' => 'required'
        ]);

        $aspiration->update($validatedData);

        return redirect()->route('aspirations.index')->with('message', 'Feedback has been succesfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
