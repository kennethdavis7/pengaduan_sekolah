<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\StudentClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $classes = StudentClass::all();
        return Inertia::render('Home/Index', [
            'canLogin' => Route::has('login') && auth()->user() === null,
            'categories' => $categories,
            'classes' => $classes
        ]);
    }
}
