<x-app-layout>
    <div class="container mx-auto xl:px-72 lg:px-36 px-4 py-4">
        <h2 class="text-3xl font-bold">Personal Access Tokens</h2>

        @if(session('success_message'))
            <div class="bg-green-200 text-green-800 rounded-md px-3 my-4">
                {{ session('success_message') }}
            </div>
        @endif

        <ul class="list-disc space-y-2 mt-8">
            @forelse(auth()->user()->tokens as $token)
                <li>{{ $token->name }}</li>
            @empty
                <li>You have no personal tokens.</li>
            @endforelse
        </ul>

        <div class="border-b border-gray-400 my-6"></div>

        <h3 class="text-2xl font-semibold">Create Token</h3>

        <form action="{{ route('personal-access-tokens') }}" method="POST">
            @csrf

            <div class="mt-4">
                <label for="token_name" class="font-semibold block">Token Name</label>
                <input type="text" name="token_name" id="token_name" class="border border-gray-800 bg-slate-700 rounded w-full px-2 py-2 mt-2" value="{{ old('token_name') }}">
                @error('token_name')
                    <div class="bg-red-200 text-red-700 rounded-md px-4 py-2 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex space-x-8 mt-4">
                <label>
                    <input type="checkbox" name="create" value="create">
                    <span class="ml-1">create</span>
                </label>

                <label>
                    <input type="checkbox" name="delete" value="delete">
                    <span class="ml-1">delete</span>
                </label>

            </div>

            <div class="mt-8">
                <button type="submit" class="bg-green-700 text-gray-200 px-4 py-2 rounded">Create Token</button>
            </div>
        </form>
    </div>
</x-app-layout>
