<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Requests\StoreCategoryRequest;

class CathegoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all categories
        $categories = Categories::paginate(10);

        // Return the categories as a JSON response
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Redirect to the categories create page
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // Create a new cathegory
        Categories::create($validated);

        // Redirect to the categories index page
        return redirect()->route('categories.index')->with('success', 'Cathegory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the cathegory by ID
        $cathegory = Categories::findOrFail($id);

        // Return the cathegory as a JSON response
        return view('categories.show', compact('cathegory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the cathegory by ID
        $cathegory = Categories::findOrFail($id);

        // Return the edit view with the cathegory data
        return view('categories.edit', compact('cathegory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, string $id)
    {
        // Find the cathegory by ID
        $cathegory = Categories::findOrFail($id);

        // Validate the request
        $validated = $request->validated();

        // Update the cathegory
        $cathegory->update($validated);

        // Redirect to the categories index page
        return redirect()->route('categories.index')->with('success', 'Cathegory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the cathegory by ID
        $cathegory = Categories::findOrFail($id);

        // Soft delete the cathegory
        $cathegory->delete();

        // Redirect to the categories index page
        return redirect()->route('categories.index')->with('success', 'Cathegory deleted successfully.');
    }
}
