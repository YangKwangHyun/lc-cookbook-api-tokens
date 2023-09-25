<x-app-layout>
    <div class="container mx-auto xl:px-72 lg:px-36 px-4 py-4">
        <h3 class="flex items-center space-x-2">
            <a href="/repos/{{ $repo->name }}" class="text-blue-500 text-xl font-semibold">{{ $repo->name }}</a>
            <span class="border border-gray-500 rounded-full text-xs px-2 py-1">Public</span>
        </h3>

        <div class="mt-2">{{ $repo->description }}</div>

        <div>
            <form action="/repos/{{ $repo->id }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="mt-8">
                    <button type="submit" class="bg-red-700 text-gray-200 px-4 py-2 rounded">Delete Repo</button>
                </div>
            </form>
        </div>

        <div class="text-xl mt-8">List of files here</div>

    </div>
</x-app-layout>
