<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $complaint = Complaint::with(['user', 'category'])->get();
            $users = User::select('id', 'name')->get();
            $categories = Category::select('id', 'name')->get();

                return response()->json([
                'complaints' => $complaint,
                'users' => $users,
                'categories' => $categories
            ]);
        }
         return view('admin.complaint');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'complaint_user' => 'required|exists:users,id',
            'complaint_category' => 'required|exists:categories,id',
            'complaint_severity' => 'required|in:severe,mild,minor',
            'complaint_isresokved' => 'nullable|boolean',
        ]);

        // Create new complaint
        $complaint = new Complaint();
        $complaint->user_id = $request->complaint_user;
        $complaint->category_id = $request->complaint_category;
        $complaint->severity = $request->complaint_severity;
        $complaint->is_resolved = $request->complaint_isresokved ? 1 : 0;
        $complaint->created_by = Auth::id(); // assuming user is authenticated
        $complaint->updated_by = Auth::id();
        $complaint->save();
        return response()->json(['message' => 'Complaint created successfully']);
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
    public function edit(string $id)
    {
        $complaint = Complaint::with([
                'user:id,name,email', 
                'category:id,name'
            ])->findOrFail($id);
        return response()->json($complaint);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'complaint_user' => 'required|exists:users,id',
            'complaint_category' => 'required|exists:categories,id',
            'complaint_severity' => 'required|in:severe,mild,minor',
            'complaint_isresokved' => 'nullable|boolean',
        ]);
        $complaint = Complaint::findOrFail($id);
         $complaint->user_id = $request->complaint_user;
        $complaint->category_id = $request->complaint_category;
        $complaint->severity = $request->complaint_severity;
        $complaint->is_resolved = $request->complaint_isresokved ? 1 : 0;
        $complaint->updated_by = Auth::id();
        $complaint->save();
        return response()->json(['message' => 'Complaint update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete(); // soft delete
        return response()->json(['status' => 'success', 'message' => 'Complaint deleted successfully']);
    }
}
