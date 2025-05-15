<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use App\Models\UserCategoryScore;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permissions = \Spatie\Permission\Models\Permission::latest()->get();
            return response()->json($permissions);
        }

        return view('admin.permissions.index');
    }
    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return response()->json(['success' => true, 'message' => 'Permission created successfully.']);
    }

    public function show(Permission $permission)
    {
        return response()->json($permission);
    }

    public function edit(Permission $permission)
    {
        return response()->json($permission);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return response()->json(['success' => true, 'message' => 'Permission updated successfully.']);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['success' => true, 'message' => 'Permission deleted successfully.']);
    }
    public function chart()
    {
        $maxAttempt = UserCategoryScore::where('user_id', Auth::id())->max('attempt');
        $labels = Category::orderBy('id', 'asc')->pluck('name')->toArray();

        $dataset1 = UserCategoryScore::where('user_id', Auth::id())
            ->where('attempt', $maxAttempt)  // Filter by max attempt
            ->orderBy('category_id', 'asc')  // Order by created_at
            ->pluck('average_score')  // Get the average_score
            ->toArray();
        //$dataset1 = [90, 100, 85, 90, 90, 90];
        $dataset2 = [80, 90, 75, 80, 80, 80];
        return view('admin.chart', compact('labels', 'dataset1', 'dataset2'));
    }
    public function dashboard()
    {
        $maxAttempt = UserCategoryScore::where('user_id', Auth::id())->max('attempt');
        $labels = Category::orderBy('id', 'asc')->pluck('name')->toArray();

        $dataset1 = UserCategoryScore::where('user_id', Auth::id())
            ->where('attempt', $maxAttempt)  // Filter by max attempt
            ->orderBy('category_id', 'asc')  // Order by created_at
            ->pluck('average_score')  // Get the average_score
            ->toArray();
            $averageOfAverages = round(
            UserCategoryScore::where('user_id', Auth::id())
                ->where('attempt', $maxAttempt)
                ->avg('average_score'),
            2
        );
        //$dataset1 = [90, 100, 85, 90, 90, 90];
        $dataset2 = [80, 90, 75, 80, 80, 80];
        return view('admin.dashbord', compact('labels', 'dataset1', 'dataset2','averageOfAverages'));
    }
    public function stakeholder_data()
    {
        $userTree = getUserTree(Auth::user()->id, Auth::user()->level, Auth::user()->manager_id);
        return view('admin.stakeholder', compact('userTree'));
    }
    public function questions()
    {
        $questions = Question::with('answers')
            ->where([
                ['type', '=', 'self'],
                ['level', '=', Auth::user()->level],
            ])
            ->orderBy('id')
            //->limit('2')
            ->get();
        //dd($questions);
        return view('admin.question', compact('questions'));
    }
    public function stakeholder($UserID = null)
    {
        $userTree = getUserTree(Auth::user()->id, Auth::user()->level, Auth::user()->manager_id);
        $questions = collect();

        if (!is_null($UserID)) {
            $userLevel = getUserLevel($UserID);

            if ($userLevel) {
                $questions = Question::with('answers')
                    ->where([
                        ['type', '=', 'stakeholder'],
                        ['level', '=', $userLevel],
                    ])
                    ->orderBy('id')
                    //->limit('2')
                    ->get();
            }
        }

        return view('stakeholder_question', compact('questions', 'userTree', 'UserID'));
    }
}