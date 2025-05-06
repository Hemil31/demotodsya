<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.users.index');
        } catch (\Exception $e) {
            Log::error('Error displaying user index: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while loading the user list.');
        }
    }

    public function getUser()
    {
        try {
            $users = User::query();
            //dd( $users);
            return DataTables::of($users)
                ->addColumn('restaurant_name', function ($row) {
                    return $row->restaurant_name ?? "---";
                })
                ->addColumn('role', function ($row) {
                    return $row->role == 1 ? 'User' : 'Admin';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'Inactive';
                })
                ->addColumn('actions', function ($row) {
                    $editUrl = route('user.edit', $row->id);
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
        dd($e->getMessage());
            Log::error('Error fetching users: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while fetching users.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.users.create');
        } catch (\Exception $e) {
            Log::error('Error displaying user creation form: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while loading the user creation form.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'restaurant_name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
                'mobile_number' => 'required|numeric|digits_between:10,15',
                'role' => 'required|in:1,2',
                'status' => 'required|in:0,1',
            ]);

            User::create([
                'name' => $request->name,
                'restaurant_name' => $request->restaurant_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'mobile_number' => $request->mobile_number,
                'role' => $request->role,
                'status' => $request->status,
            ]);

            return redirect()->route('user.index')->with('success', 'User created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while creating the user.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));
        } catch (\Exception $e) {
            Log::error('Error displaying user details: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while loading the user details.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.edit', compact('user'));
        } catch (\Exception $e) {
            Log::error('Error displaying user edit form: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while loading the user edit form.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'restaurant_name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'mobile_number' => 'required|numeric|digits_between:10,15',
                'role' => 'required|in:1,2',
                'status' => 'required|in:0,1',
            ]);

            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'restaurant_name' => $request->restaurant_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'role' => $request->role,
                'status' => $request->status,
            ]);

            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while updating the user.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while deleting the user.'], 500);
        }
    }
}
