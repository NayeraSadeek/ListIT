<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Carbon\Carbon;
//carbon simple apirelated to datetime
class DashboardController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $today=Carbon::today();
        $tomorrow=Carbon::tomorrow();

        $tasksCompletedToday=Task::where('user_id',$user->id)
        ->whereDate('completed_at',$today)
        ->count();

        $taskOverdue =Task::where('user_id',$user->id)
        ->where('due_date','<',$today)
        ->whereNull('completed_at')
        ->count();

        $upcomingTasks =Task::where('user_id',$user->id)
        ->whereDate('due_date','>=',$today)
        ->whereDate('due_date','<=',$tomorrow)
        ->orderBy('due_date')
        ->limit(5)
        ->get();

        return view('dashboard',compact(
            'tasksCompletedToday',
            'taskOverdue',
            'upcomingTasks'
        ));



    }
}
