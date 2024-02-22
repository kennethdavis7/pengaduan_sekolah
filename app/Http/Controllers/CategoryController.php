<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $categories = Category::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })->paginate(3)->onEachSide(2);
        return Inertia::render('Categories/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('message', 'Category has been succesfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Categories/Edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $category->update($validatedData);

        return redirect()->route('categories.index')->with('message', 'Category has been succesfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index')->with('message', 'Category has been succesfully deleted!');
    }
}
