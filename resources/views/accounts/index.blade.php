<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 white:text-gray-200 leading-tight">
            {{ __('Accounts List') }}
        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white white:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      
            <section class="py-6 px-3">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Create Accounts</h2>
                    <a href="{{ route('accounts.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Create Account</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($accounts as $key => $value)
                                <tr>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $value->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $value->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                        <a href="{{ route('accounts.edit', $value->email) }}" class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">Edit</a>
                                        {{-- <form action="{{ route('categories.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">Delete</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No Accounts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
        

                <div class="mt-6 flex justify-center">
                    {{ $accounts->links() }}
                </div>
            </section>
        </div>
    </div>
</div>    

</x-app-layout>