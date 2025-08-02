<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="mb-4 text-gray-700">Welcome to your dashboard!</p>

                {{-- Links --}}
                <div class="flex gap-4 flex-wrap mb-6">
                    <a href="{{ route('categories.index') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                        📂 Manage Categories
                    </a>

                    <a href="{{ route('tasks.index') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                        📋 View My Tasks
                    </a>
                </div>

                {{-- Stats Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-green-100 p-4 rounded-xl shadow">
                        <h3 class="text-lg font-semibold text-green-800">✅ Tasks Completed Today</h3>
                        <p class="text-3xl mt-2 text-green-900">{{ $tasksCompletedToday }}</p>
                    </div>

                    <div class="bg-red-100 p-4 rounded-xl shadow">
                        <h3 class="text-lg font-semibold text-red-800">⚠️ Tasks Overdue</h3>
                        <p class="text-3xl mt-2 text-red-900">{{ $taskOverdue }}</p>
                    </div>

                    <div class="bg-blue-100 p-4 rounded-xl shadow">
                        <h3 class="text-lg font-semibold text-blue-800">📆 Upcoming Tasks</h3>
                        <p class="text-3xl mt-2 text-blue-900">{{ $upcomingTasks->count() }}</p>
                    </div>
                </div>

                {{-- Upcoming Task List --}}
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">🕒 Due Today or Tomorrow</h3>
                    @if($upcomingTasks->isEmpty())
                        <p class="text-gray-500">No upcoming tasks 🎉</p>
                    @else
                        <ul class="space-y-3">
                            @foreach($upcomingTasks as $task)
                                <li class="p-4 border rounded-lg shadow-sm bg-gray-50 flex justify-between items-center">
                                    <span class="font-medium text-gray-800">{{ $task->title }}</span>
                                    <span class="text-sm text-gray-500">{{ $task->due_date->format('D, M j') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
