<x-app-layout>
    <div class="container mx-auto xl:px-72 lg:px-36 px-4 py-4">
        <h3 class="text-2xl font-semibold">Create Repo</h3>

        <form action="/repos" method="POST">
            @csrf
            <div class="mt-4">
                <label for="name" class="font-semibold block">Name</label>
                <input type="text" name="name" id="name" class="border border-gray-800 bg-slate-700 rounded w-full px-2 py-2 mt-2" value="{{ old('name') }}">
                @error('name')
                <div class="bg-red-200 text-red-700 rounded-md px-4 py-2 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <label for="description" class="font-semibold block">Description</label>
                <input type="text" name="description" id="description" class="border border-gray-800 bg-slate-700 rounded w-full px-2 py-2 mt-2" value="{{ old('description') }}">
                @error('description')
                <div class="bg-red-200 text-red-700 rounded-md px-4 py-2 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-8">
                <button type="submit" class="bg-green-700 text-gray-200 px-4 py-2 rounded">Create Repo</button>
            </div>
        </form>
    </div>
</x-app-layout>
