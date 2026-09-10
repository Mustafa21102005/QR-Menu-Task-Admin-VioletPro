@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Banner --}}
    <div class="mt-8 mx-4 aura aura-gold">
        <div class="card bg-base-200 w-full justify-center h-25">
            <div class="card-body">
                <h2 class="card-title">A Taste Worth Savoring</h2>
                <p>
                    Thoughtfully crafted dishes, made with care — because comfort should
                    never feel ordinary.
                </p>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <main class="py-5 px-10">
        @forelse ($categories as $category)
            @if ($category->items->isNotEmpty())
                <h2 id="go-to-{{ Str::slug($category->name) }}" class="text-4xl pb-8 pt-8 font-bold text-center">
                    {{ $category->name }}
                </h2>

                {{-- Grid view (md and up) --}}
                <div class="gap-8 md:grid lg:grid-cols-4 md:grid-cols-2 hidden">
                    @foreach ($category->items as $item)
                        <div class="card bg-base-300 shadow-lg hover:shadow-2xl transition-shadow duration-400">
                            <figure>
                                @if ($item->imageable)
                                    <img src="{{ asset('storage/' . $item->imageable->path) }}" alt="{{ $item->name }}"
                                        title="{{ $item->name }}" class="object-cover w-150 h-48">
                                @else
                                    <div class="bg-base-200 w-full h-48 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-30" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16v12H4V6z" />
                                        </svg>
                                    </div>
                                @endif
                            </figure>
                            <div class="card-body">
                                <h2 class="card-title">
                                    {{ $item->name }}
                                    <div class="badge badge-primary">${{ number_format($item->price, 2) }}</div>
                                </h2>
                                <p>{{ $item->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- List view (below md) --}}
                <ul class="md:hidden list bg-base-300 rounded-box shadow-md mb-8">
                    @foreach ($category->items as $item)
                        <li class="list-row">
                            <div class="text-4xl font-thin opacity-30 tabular-nums">{{ $loop->iteration }}</div>
                            <div>
                                @if ($item->imageable)
                                    <img class="size-10 rounded-box object-cover"
                                        src="{{ asset('storage/' . $item->imageable->path) }}" alt="{{ $item->name }}">
                                @else
                                    <div class="size-10 rounded-box bg-base-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-30" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16v12H4V6z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="list-col-grow">
                                <div>{{ $item->name }}</div>
                                <div class="text-xs uppercase font-semibold opacity-60">
                                    {{ $item->description }}
                                </div>
                            </div>
                            <div class="badge badge-primary">${{ number_format($item->price, 2) }}</div>
                        </li>
                    @endforeach
                </ul>
            @endif
        @empty
            <p class="text-center opacity-60 py-10">No menu items available right now.</p>
        @endforelse
    </main>
@endsection
