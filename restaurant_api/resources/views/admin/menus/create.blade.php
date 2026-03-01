@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white">Add New Menu Item</h2>
            <p class="text-gray-400 mt-1">Create a new culinary masterpiece</p>
        </div>
        <a href="{{ route('admin.menus.index') }}" class="text-gray-400 hover:text-white transition-colors flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to List
        </a>
    </div>

    <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 overflow-hidden">
        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="col-span-2 md:col-span-1">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Item Name</label>
                    <input type="text" name="name" id="name" required class="w-full bg-gray-900 border border-gray-700 rounded-lg py-2.5 px-4 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all" placeholder="e.g. Truffle Pasta">
                    @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Price -->
                <div class="col-span-2 md:col-span-1 relative">
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">$</span>
                        </div>
                        <input type="number" step="0.01" name="price" id="price" required class="w-full bg-gray-900 border border-gray-700 rounded-lg py-2.5 pl-8 px-4 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all" placeholder="0.00">
                    </div>
                    @error('price') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Category -->
                <div class="col-span-2 md:col-span-1">
                    <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                    <select name="category" id="category" required class="w-full bg-gray-900 border border-gray-700 rounded-lg py-2.5 px-4 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all appearance-none cursor-pointer">
                        <option value="" disabled selected>Select a category</option>
                        <option value="Starters">Starters</option>
                        <option value="Main Course">Main Course</option>
                        <option value="Desserts">Desserts</option>
                        <option value="Beverages">Beverages</option>
                    </select>
                    @error('category') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Food Type -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Food Type</label>
                    <div class="flex space-x-4 mt-1">
                        <label class="flex items-center space-x-2 cursor-pointer group">
                            <input type="radio" name="food_type" value="veg" class="form-radio text-green-500 bg-gray-900 border-gray-700 focus:ring-green-500">
                            <span class="text-gray-300 group-hover:text-white transition-colors">Veg</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer group">
                            <input type="radio" name="food_type" value="non-veg" class="form-radio text-red-500 bg-gray-900 border-gray-700 focus:ring-red-500" checked>
                            <span class="text-gray-300 group-hover:text-white transition-colors">Non-Veg</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer group">
                            <input type="radio" name="food_type" value="egg" class="form-radio text-yellow-500 bg-gray-900 border-gray-700 focus:ring-yellow-500">
                            <span class="text-gray-300 group-hover:text-white transition-colors">Egg</span>
                        </label>
                    </div>
                    @error('food_type') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <textarea name="description" id="description" rows="3" class="w-full bg-gray-900 border border-gray-700 rounded-lg py-2.5 px-4 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all" placeholder="Describe the dish..."></textarea>
                    @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Image -->
                <div class="col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full bg-gray-900 border border-gray-700 rounded-lg py-2.5 px-4 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all">
                    @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            
                <!-- Availability -->
                <div class="col-span-2">
                    <label class="flex items-center space-x-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="is_available" class="sr-only peer" checked>
                            <div class="w-10 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-yellow-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-300 group-hover:text-white transition-colors">Available to order</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-700 mt-6">
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2.5 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                    Save Menu Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
