@extends('layouts.app')

@section('title', 'Items')

@section('content')
    <div class="w-full max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold">Items</h2>
            <a href="{{ route('items.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Item
            </a>
        </div>

        <x-success-alert />

        <div class="overflow-x-auto bg-base-200 rounded-box shadow p-6">
            <table id="items" class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>
                                <div class="avatar">
                                    <div class="w-12 h-12 rounded-box">
                                        @if ($item->imageable)
                                            <img src="{{ asset('storage/' . $item->imageable->path) }}"
                                                alt="{{ $item->name }}">
                                        @else
                                            <div class="bg-base-300 w-12 h-12 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-40"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16v12H4V6z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="font-semibold">{{ $item->name }}</div>
                                <div class="text-xs opacity-60">{{ $item->description }}</div>
                            </td>
                            <td>
                                <span class="badge badge-ghost">{{ $item->category->name }}</span>
                            </td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                <form action="{{ route('items.update', $item) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                    <input type="hidden" name="description" value="{{ $item->description }}">
                                    <input type="hidden" name="price" value="{{ $item->price }}">
                                    <input type="hidden" name="category_id" value="{{ $item->category_id }}">
                                    <input type="hidden" name="is_active" value="{{ $item->is_active ? 0 : 1 }}">
                                    <button type="submit"
                                        class="badge {{ $item->is_active ? 'badge-success' : 'badge-error' }} cursor-pointer">
                                        {{ $item->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('items.edit', $item) }}" class="btn btn-outline btn-sm btn-warning mb-2">
                                    Edit
                                </a>
                                <button class="btn btn-sm btn-error btn-outline"
                                    onclick="openDeleteModal({{ $item->id }}, '{{ addslashes($item->name) }}')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center opacity-60 py-6">
                                No items yet. Add one to get started.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-delete-modal :model="\App\Models\Item::class" />
@endsection

@section('script')
    <script>
        const table = new DataTable('#items');
    </script>
@endsection
