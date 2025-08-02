<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
class GenerateRecurringTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-recurring-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' Generate recurring daily tasks for users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $users=User::all();
        $today=Carbon::today();

        foreach($users as $user)
        {
            $exists=Task::where('user_id',$user->id)
            ->where('title','Plan Your Day')
            ->whereDate('created_at',$today)
            ->exists();

            if(!$exists)
            {
                Task::create([
                    'user_id'=>$user->id,
                    'title' =>'Plan Your Day',
                    'description'=>'Daily recurring task to plan your schedule.',
                    'due_date'=>Carbon::today(),
                    'category_id'=>1,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ]);

                $this->info("Task created for user:{$user->email}");
            }else{
                $this->line("Task already exists for user :{$user->email}");

            }
        }
        $this->info('Recurring tasksgeneration complete');
        // return Command::SUCCESS;
        return \Symfony\Component\Console\Command\Command::SUCCESS;

    }
}
