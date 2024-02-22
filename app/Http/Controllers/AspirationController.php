<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use App\Models\Status;
use App\Models\Category;
use App\Models\StudentClass;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = strtolower($request->search);
        $category_id = intval($request->query('category_id') ?? -1);
        $class_id = intval($request->query('class_id') ?? -1);
        $date = $request->date;

        $aspirations = Aspiration::with('category', 'status', 'student')
            ->join('students', 'students.id', '=', 'aspirations.student_id')
            ->join('student_classes', 'student_classes.id', '=', 'students.student_class_id')
            ->join('categories', 'categories.id', '=', 'aspirations.category_id')
            ->when($search, function ($query, $search) {
                $query
                    ->where('students.nisn', 'like', "%{$search}%")
                    ->orWhere('students.name', 'like', "%{$search}%");
            })
            ->when($category_id, function ($query) use ($category_id) {
                if ($category_id !== -1) {
                    $query->where('categories.id', $category_id);
                }
            })
            ->when($date != null, function ($query) use ($date) {
                $query->whereDate('aspirations.created_at', $date);
            })
            ->when($class_id, function ($query) use ($class_id) {
                if ($class_id !== -1) {
                    $query->where('student_classes.id', $class_id);
                }
            })
            ->select('aspirations.*', DB::raw('`student_classes`.`class` AS student_class'))
            ->paginate(3)->appends([
                'search' => $search,
                'category_id' => $category_id,
                'class_id' => $class_id,
                'date' => $date
            ])->onEachSide(2);


        $categories = Category::all();
        $classes = StudentClass::all();

        return Inertia::render('Aspirations/Index', [
            'aspirations' => $aspirations,
            'categories' => $categories,
            'category_id' => $category_id,
            'class_id' => $class_id,
            'classes' => $classes,
            'date' => $date
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
        $request->validate([
            'name' =>  "required",
            'nisn' => "required",
            'class_id' => 'required',
            'location' => "required",
            'description' => "required",
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);


        $url = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $url = 'storage/' . $file->store('image');
        }

        $student = Student::create([
            'name' => $request->name,
            'nisn' => $request->nisn,
            'student_class_id' => $request->class_id
        ]);

        Aspiration::create([
            'class_id' => $request->class_id,
            'category_id' => $request->category_id,
            'student_id' => $student->id,
            'location' => $request->location,
            'description' => $request->description,
            'status_id' => 1,
            'image_url' => $url
        ]);

        return redirect()->route('home.index')->with('message', ' Aspiration has been succesfully sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspiration $aspiration)
    {
        return Inertia::render('Aspirations/Detail', [
            'aspiration' => $aspiration->load(['student', 'category', 'status']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspiration $aspiration)
    {
        $statuses = Status::all();
        return Inertia::render('Aspirations/Edit', [
            'aspiration' => $aspiration->load(['student', 'category', 'status']),
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
