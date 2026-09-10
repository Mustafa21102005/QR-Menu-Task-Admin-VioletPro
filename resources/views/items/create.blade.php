@extends('layouts.app')

@section('title', 'Add Item')

@section('content')
    <div class="w-full max-w-2xl mx-auto px-4 py-8">
        <a href="{{ route('items.index') }}"
            class="group inline-flex items-center gap-1 text-sm opacity-70 hover:opacity-100 transition-opacity w-fit mb-4">
            <span class="inline-block transition-transform duration-200 group-hover:-translate-x-1">←</span>
            Back to items
        </a>

        <h2 class="text-3xl font-bold mb-6">Add Item</h2>

        <div class="card bg-base-200 shadow-xl">
            <div class="card-body">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Name --}}
                    <fieldset class="fieldset mb-4">
                        <label for="name" class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input id="name" type="text" name="name"
                            class="input input-bordered w-full @error('name') input-error @enderror"
                            value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="label-text-alt text-error mt-1">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    {{-- Description --}}
                    <fieldset class="fieldset mb-4">
                        <label for="description" class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="textarea textarea-bordered w-full @error('description') textarea-error @enderror" required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="label-text-alt text-error mt-1">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    {{-- Price --}}
                    <fieldset class="fieldset mb-4">
                        <label for="price" class="label">
                            <span class="label-text">Price</span>
                        </label>
                        <label
                            class="input input-bordered flex items-center gap-2 w-full @error('price') input-error @enderror">
                            $
                            <input id="price" type="number" step="0.01" min="0" name="price" class="grow"
                                value="{{ old('price') }}" required>
                        </label>
                        @error('price')
                            <span class="label-text-alt text-error mt-1">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    {{-- Category --}}
                    <fieldset class="fieldset mb-4">
                        <label for="category_id" class="label">
                            <span class="label-text">Category</span>
                        </label>
                        <select id="category_id" name="category_id"
                            class="select select-bordered w-full @error('category_id') select-error @enderror" required>
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Choose a category
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="label-text-alt text-error mt-1">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    {{-- Image --}}
                    <fieldset class="fieldset mb-4">
                        <label for="image" class="label">
                            <span class="label-text">Image</span>
                        </label>
                        <input id="image" type="file" name="image" accept="image/*"
                            class="file-input file-input-bordered w-full @error('image') file-input-error @enderror">
                        @error('image')
                            <span class="label-text-alt text-error mt-1">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    {{-- Active --}}
                    <fieldset class="fieldset mb-6">
                        <label class="label cursor-pointer justify-start gap-3">
                            <input type="checkbox" name="is_active" value="1" class="toggle toggle-success" checked>
                            <span class="label-text">Active</span>
                        </label>
                    </fieldset>

                    <div class="card-actions justify-end">
                        <a href="{{ route('items.index') }}" class="btn btn-ghost">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
