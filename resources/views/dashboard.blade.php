@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="w-full px-4 py-8">
        <h2 class="text-3xl font-bold mb-6">Dashboard</h2>

        <x-success-alert />

        {{-- Stats --}}
        <div class="stats stats-vertical sm:stats-horizontal shadow bg-base-200 w-full mb-8">
            <div class="stat">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                    </svg>
                </div>
                <div class="stat-title">Categories</div>
                <div class="stat-value text-primary">{{ $stats['total_categories'] }}</div>
                <div class="stat-desc">{{ $stats['active_categories'] }} active</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 3v6.75a1.5 1.5 0 01-1.5 1.5H6a1.5 1.5 0 01-1.5-1.5V3M8.25 3v18M4.5 3v3.75m3.75-3.75v3.75M15.75 3c-1.243 0-2.25 1.679-2.25 3.75S14.507 10.5 15.75 10.5s2.25-1.679 2.25-3.75S16.993 3 15.75 3zm0 7.5V21" />
                    </svg>
                </div>
                <div class="stat-title">Items</div>
                <div class="stat-value text-secondary">{{ $stats['total_items'] }}</div>
                <div class="stat-desc">{{ $stats['active_items'] }} active</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-title">Inactive Items</div>
                <div class="stat-value text-accent">{{ $stats['total_items'] - $stats['active_items'] }}</div>
                <div class="stat-desc">not shown on menu</div>
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="flex gap-3 mb-8">
            <a href="{{ route('items.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Item
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-outline">
                Manage Categories
            </a>
        </div>

        {{-- Recent items --}}
        <h3 class="text-xl font-semibold mb-4">Recently Added Items</h3>

        <div class="overflow-x-auto bg-base-200 rounded-box shadow">
            <table class="table">
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
                    @forelse ($recentItems as $item)
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
                            <td>{{ $item->name }}</td>
                            <td>
                                <span class="badge badge-ghost">{{ $item->category->name }}</span>
                            </td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                <span class="badge {{ $item->is_active ? 'badge-success' : 'badge-error' }}">
                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('items.edit', $item) }}" class="btn btn-outline btn-sm btn-warning">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center opacity-60 py-6">
                                No items yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
