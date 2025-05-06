<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.sub-categorys.index');
        } catch (\Exception $e) {
            Log::error('Error displaying sub-category index: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while displaying the sub-category index.');
        }
    }

    public function getSubCategory()
    {
        try {
            $subCategorys = SubCategory::query();
            return DataTables::of($subCategorys)
                ->addColumn('gujarati_name', function ($row) {
                    return $row->name_i18n['gu'] ?? 'N/A';
                })
                ->addColumn('hindi_name', function ($row) {
                    return $row->name_i18n['hi'] ?? 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    $editUrl = route('sub-category.edit', $row->id);
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
            Log::error('Error fetching sub-categories: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while fetching sub-categories.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $category = Category::where('status', '!=', 0)->get(['id', 'name']);
            return view('admin.sub-categorys.create', compact('category'));
        } catch (\Exception $e) {
            Log::error('Error displaying create sub-category form: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while displaying the create form.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'name_i18n' => 'required|array',
                'name_i18n.gu' => 'required|string',
                'name_i18n.hi' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:0,1',
            ]);
            if ($request->file('image')) {
                $image = $request->file('image');
                $imageName = $request->name . rand(0, 1111) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('sub-category', $imageName, 'public');
            }
            SubCategory::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'name_i18n' => $request->name_i18n,
                'image' => $imageName ?? 'demo.png',
                'status' => $request->status,
            ]);

            return redirect()->route('sub-category.index')->with('success', 'SubCategory created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating sub-category: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while creating the sub-category.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::where('status', '!=', 0)->get(['id', 'name']);
            $subCategory = SubCategory::findOrFail($id);
            return view('admin.sub-categorys.edit', compact('subCategory', 'category'));
        } catch (\Exception $e) {
            Log::error('Error displaying edit sub-category form: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while displaying the edit form.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'name_i18n' => 'required|array',
                'name_i18n.gu' => 'required|string',
                'name_i18n.hi' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:0,1',
            ]);
            $subCategory = SubCategory::findOrFail($id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->name . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('sub-category', $imageName, 'public');

                // Optionally delete the old image (if not demo.png)
                if ($subCategory->image && $subCategory->image !== 'demo.png') {
                    Storage::disk('public')->delete('sub-category/' . $subCategory->image);
                }
            }
            $updateData = [
                'category_id' => $request->category_id,
                'name' => $request->name,
                'name_i18n' => $request->name_i18n,
                'status' => $request->status,
            ];

            // Add image only if it's uploaded
            if (isset($imageName)) {
                $updateData['image'] = $imageName;
            }
            $subCategory->update($updateData);
            return redirect()->route('sub-category.index')->with('success', 'SubCategory updated successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating sub-category: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while updating the sub-category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subCategory = SubCategory::findOrFail($id);
            $subCategory->delete();
            return response()->json([
                'message' => 'SubCategory deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting sub-category: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while deleting the sub-category.'], 500);
        }
    }
}
