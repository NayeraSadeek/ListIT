<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $user = auth()->user();
        $user = Auth::user();


        $categoryId = $request->input('category');
        $status = $request->input('status');
        $from = $request->input('from');
        $to = $request->input('to');

        $tasksQuery = Task::where('user_id', $user->id);

        if ($categoryId) {
            $tasksQuery->where('category_id', $categoryId);
        }
      if($status==='completed')
      {
        $tasksQuery->whereNotNull('completed_at');
      }else if($status === 'pending')
      {
        $tasksQuery->whereNull('completed_at');
      }
      if($from)
      {
        $tasksQuery->whereDate('due_date','>=',$from);
      }
      if($to)
      {
        $tasksQuery->whereDate('due_date','<=',$to);
      }
      $tasks=$tasksQuery->orderBy('due_date')->paginate(10);
      $categories = Category::where('user_id', Auth::id())->get();

      return view('tasks.index',compact('tasks','categories',
      'categoryId','status','from','to'
    ));



        // $tasks=Task::where('user_id',Auth::id())->with('category')->latest()->paginate(10);
        // return view('tasks.index',compact('tasks'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::where('user_id', Auth::id())->get();
        return view('tasks.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);
        $category = Category::where('id', $validated['category_id'])->where('user_id', Auth::id())->firstOrFail();
        $validated['user_id'] = Auth::id();
        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully .');
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
    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        $categories = Category::where('user_id', Auth::id())->get();
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        Category::where('id', $validated['category_id'])
            ->where('user_id', Auth::id())->firstOrFail();
        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $this->authorizeTask($task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }


    public function toggleComplete(Task $task)
    {
        $this->authorizeTask($task);

        if ($task->completed_at) {
            $task->update(['completed_at' => null]);
        } else {
            $task->update(['completed_at' => now()]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task status updated.');
    }

    private function authorizeTask(Task $task)
    {


        // dd($task); //->مؤقتااا

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
