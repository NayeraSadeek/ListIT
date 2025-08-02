<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">
        {{-- Success message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Your Tasks 📝</h1>
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + New Task
            </a>
        </div>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="py-3 px-4 text-left">Title</th>
                    <th class="py-3 px-4 text-left">Category</th>
                    <th class="py-3 px-4 text-left">Due Date</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $task->title }}</td>
                        <td class="py-3 px-4">
                            {{ $task->category->name ?? 'No Category' }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $task->due_date ? $task->due_date->format('Y-m-d') : '—' }}
                        </td>
                        <td class="py-3 px-4">
                            @if($task->completed_at)
                                <span class="text-green-600 font-semibold">✅ Completed</span>
                            @else
                                <span class="text-yellow-600 font-semibold">⏳ Incomplete</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 space-x-2">
                            {{-- Toggle complete/incomplete --}}
                            <form action="{{ route('tasks.toggleComplete', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-gray-700 hover:underline">
                                    @if($task->completed_at)
                                        Mark Incomplete
                                    @else
                                        Mark Complete
                                    @endif
                                </button>
                            </form>

                            {{-- Edit --}}
                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:underline">
                                   Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Delete this task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 text-gray-500">
                            No tasks found. <a href="{{ route('tasks.create') }}" class="text-blue-500 hover:underline">Create one now.</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <br>

                        <h1 class="text-2xl font-bold">Filter ▼</h1>

<div class="flex justify-between items-center mb-4">

<form method="GET" action="{{ route('tasks.index') }}" class="w-full mb-6 bg-gray-50 p-4 rounded-lg shadow-sm space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Category Filter -->
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category" id="category" class="mt-1 block w-full rounded border-gray-300">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Filter -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full rounded border-gray-300">
                <option value="">All</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <!-- From Date -->
        <div>
            <label for="from" class="block text-sm font-medium text-gray-700">From</label>
            <input type="date" name="from" id="from" value="{{ request('from') }}" class="mt-1 block w-full rounded border-gray-300">
        </div>

        <!-- To Date -->
        <div>
            <label for="to" class="block text-sm font-medium text-gray-700">To</label>
            <input type="date" name="to" id="to" value="{{ request('to') }}" class="mt-1 block w-full rounded border-gray-300">
        </div>
    </div>

    <div class="flex justify-end gap-4 mt-4">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Filter</button>
        <a href="{{ route('tasks.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow">Reset</a>
    </div>
</form>


        {{-- Pagination --}}
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>
