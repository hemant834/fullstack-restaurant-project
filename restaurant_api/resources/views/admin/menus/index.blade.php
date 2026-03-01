@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-3xl font-bold text-white">Menu Items</h2>
        <p class="text-gray-400 mt-1">Manage your restaurant's food and beverage offerings</p>
    </div>
    <a href="{{ route('admin.menus.create') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add New Item
    </a>
</div>

<div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden border border-gray-700">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-900 text-gray-400 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold border-b border-gray-700">Image</th>
                    <th class="p-4 font-semibold border-b border-gray-700">Name & Description</th>
                    <th class="p-4 font-semibold border-b border-gray-700">Type</th>
                    <th class="p-4 font-semibold border-b border-gray-700">Price</th>
                    <th class="p-4 font-semibold border-b border-gray-700">Status</th>
                    <th class="p-4 font-semibold border-b border-gray-700 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach($menus as $menu)
                <tr class="hover:bg-gray-750 transition-colors duration-150 group">
                    <td class="p-4">
                        @if($menu->image)
                         <img 
  src="{{ Str::startsWith($menu->image, 'http') 
      ? $menu->image 
      : asset('menuimage/' . ltrim($menu->image, '/')) }}" 
  alt="{{ $menu->name }}" 
  class="h-16 w-16 object-cover rounded-lg shadow-sm"
/> 
                      
                      @else
                            <div class="h-16 w-16 bg-gray-700 rounded-lg flex items-center justify-center text-gray-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="text-lg font-medium text-white">{{ $menu->name }}</div>
                        <div class="text-sm text-gray-400 hidden md:block max-w-xs truncate">{{ $menu->description }}</div>
                        <div class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                            {{ $menu->category }}
                        </div>
                    </td>
                    <td class="p-4">
                        @if($menu->food_type === 'veg')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-300 border border-green-700">
                                <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span> Veg
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-900 text-red-300 border border-red-700">
                                <span class="w-2 h-2 mr-1 bg-red-500 rounded-full"></span> Non-Veg
                            </span>
                        @endif
                    </td>
                    <td class="p-4 text-white font-semibold">
                        ${{ number_format($menu->price, 2) }}
                    </td>
                    <td class="p-4">
                        @if($menu->is_available)
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-500/10 text-green-400">
                                Available
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-500/10 text-red-400">
                                Unavailable
                            </span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end space-x-3 opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-blue-400 hover:text-blue-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                
                @if($menus->isEmpty())
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">
                        No menu items found. Get started by adding a new item!
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
