<?php

namespace App\Http\Controllers;

use App\Models\survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $survey = Survey::all();
            if ($request->ajax()) {
                return response()->json($survey);
            }
            if ($request->expectsJson() || $request->is('api/*')) {
                return apiResponse('Survey data.', [ 'survey' => $survey],
                true, 200,'');
            }
            return view('admin.survey');
        }catch (\Exception $e) {
            return apiResponse('Oops! Something went wrong', [],
                false, 500,'');
        }
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
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'description' => '',
        ]);

        // Create new complaint
        $survey = new Survey();
        $survey->start_date = $request->start_date;
        $survey->end_date = $request->end_date;
        $survey->status = $request->status;
        $survey->description = $request->description;
        $survey->created_by = Auth::id(); // assuming user is authenticated
        $survey->updated_by = Auth::id();
        $survey->save();
        if ($request->expectsJson() && $request->is('api/*')) {
                return apiResponse('Survey created successfully.', [],
                true, 201,'');
        }
        return response()->json(['message' => 'Survey created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $survey = survey::findOrFail($id);
        return response()->json($survey);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'description' => '',
        ]);
        $survey = survey::findOrFail($id);
        $survey->start_date = $request->start_date;
        $survey->end_date = $request->end_date;
        $survey->status = $request->status;
        $survey->description = $request->description;
        $survey->updated_by = Auth::id();
        $survey->save();
        return response()->json(['message' => 'Survey update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        try {
            $survey = survey::findOrFail($id);
            $survey->delete();
            if ($request->expectsJson() && $request->is('api/*')) {
                return apiResponse('Survey deleted successfully', [],
                true, 200,'');
            }
            return response()->json(['status' => 'success', 'message' => 'Survey deleted successfully']);
        }catch (\Exception $e) {
            return apiResponse('Oops! Something went wrong', [],
                false, 500,'');
        }
    }
}
