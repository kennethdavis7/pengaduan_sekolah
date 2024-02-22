<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;


use Inertia\Inertia;
use Illuminate\Http\Request;

class GuestAspirationController extends Controller
{
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
                $query->where('students.nisn', 'like', "%{$search}%");
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

        return Inertia::render('GuestAspiration/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'aspirations' => $aspirations,
            'categories' => $categories,
            'category_id' => $category_id,
            'class_id' => $class_id,
            'classes' => $classes,
            'date' => $date
        ]);
    }

    public function show(Aspiration $aspiration)
    {
        return Inertia::render('GuestAspiration/Detail', [
            'canLogin' => auth()->user() === null,
            'canRegister' => Route::has('register') && auth()->user() === null,
            'aspiration' => $aspiration->load(['student', 'category', 'status']),
        ]);
    }
}
