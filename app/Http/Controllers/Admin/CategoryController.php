<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categorys.index');
    }

    /**
     * Fetch categories for DataTables.
     */
    public function getCategory()
    {
        try {
            $categories = Category::query();

            return DataTables::of($categories)
                ->addColumn('gujarati_name', fn($row) => $row->name_i18n['gu'] ?? 'N/A')
                ->addColumn('hindi_name', fn($row) => $row->name_i18n['hi'] ?? 'N/A')
                ->addColumn('actions', function ($row) {
                    $editUrl = route('category.edit', $row->id);
                    return '
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="' . $editUrl . '" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                <i class="la la-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-btn"
                                data-id="' . $row->id . '">
                                <i class="la la-trash"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);

        } catch (\Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while fetching categories.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'name_i18n' => 'required|array',
                'name_i18n.gu' => 'required|string',
                'name_i18n.hi' => 'required|string',
                'status' => 'required|in:0,1',
            ]);

            Category::create($validatedData);

            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while creating the category.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categorys.edit', compact('category'));
        } catch (\Exception $e) {
            Log::error('Error fetching category for edit: ' . $e->getMessage());
            return redirect()->route('category.index')->with('error', 'Something went wrong while fetching the category.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'name_i18n' => 'required|array',
                'name_i18n.gu' => 'required|string',
                'name_i18n.hi' => 'required|string',
                'status' => 'required|in:0,1',
            ]);

            $category = Category::findOrFail($id);
            $category->update($validatedData);

            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while updating the category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json(['message' => 'Category deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while deleting the category.'], 500);
        }
    }
}
