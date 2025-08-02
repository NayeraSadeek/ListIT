<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">New Task</h1>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tasks.store') }}" class="space-y-4">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block font-semibold">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block font-semibold">Description</label>
                <textarea name="description" id="description"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            {{-- Due date --}}
            <div>
                <label for="due_date" class="block font-semibold">Due Date</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                       class="border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Category --}}
            <div>
                <label for="category_id" class="block font-semibold">Category</label>
                <select name="category_id" id="category_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Save Task
                </button>
                <a href="{{ route('tasks.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
