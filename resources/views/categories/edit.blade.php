<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto p-6">
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block mb-1 font-medium">Category Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update
            </button>
            <a href="{{ route('categories.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
        </form>
    </div>
</x-app-layout>
