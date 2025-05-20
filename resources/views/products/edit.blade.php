<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 white:text-gray-200 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white white:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif  
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <section class="py-6 px-3">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Edit Product</h2>
                    <a href="{{ route('products.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">All Product</a>
                </div>

                <form method="POST" action="{{ route('products.update', $product->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Product Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div> 
                      <x-input-label for="name" :value="__('Categories List')" />
                        <select id="categories" name="categories[]" class="mt-1 block w-full" multiple>
                            @foreach($categories as $key => $category)
                            <option value="{{ $category->id }}" 
                                {{ in_array($category->id, $product->category->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                      <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                    <div>
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" class="mt-1 block w-full" rows="4" required>{{ old('description', $product->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price', $product->price)" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                     <div>
                        <x-input-label for="stock" :value="__('Stock')" />
                        <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $product->stock)" required />
                        <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image_url" :value="__('Image URL')" />
                        <x-text-input  id="image_url" name="image_url"  type="url" class="mt-1 block w-full" :value="old('image_url', $product->image_url)"   />
                        <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>    

</x-app-layout>
