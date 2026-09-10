@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="w-full max-w-4xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold">Categories</h2>
            <button class="btn btn-primary" onclick="openCreateModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Category
            </button>
        </div>

        <x-success-alert />
        <x-error-alert />

        <div class="overflow-x-auto bg-base-200 rounded-box shadow p-6">
            <table id="categories" class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form action="{{ route('categories.update', $category) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name" value="{{ $category->name }}">
                                    <input type="hidden" name="is_active" value="{{ $category->is_active ? 0 : 1 }}">
                                    <button type="submit"
                                        class="badge {{ $category->is_active ? 'badge-success' : 'badge-error' }} cursor-pointer">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-right">
                                <button class="btn btn-outline btn-sm btn-warning"
                                    onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}', {{ $category->is_active ? 'true' : 'false' }})">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-error btn-outline"
                                    onclick="openDeleteModal({{ $category->id }}, '{{ addslashes($category->name) }}')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center opacity-60 py-6">
                                No categories yet. Add one to get started.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Create Modal --}}
    <dialog id="create_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Add Category</h3>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <fieldset class="fieldset mb-4">
                    <label for="create_name" class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input id="create_name" type="text" name="name"
                        class="input input-bordered w-full @error('name') input-error @enderror"
                        value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="label-text-alt text-error mt-1">{{ $message }}</span>
                    @enderror
                </fieldset>

                <fieldset class="fieldset mb-4">
                    <label class="label cursor-pointer justify-start gap-3">
                        <input type="checkbox" name="is_active" value="1" class="toggle toggle-success" checked>
                        <span class="label-text">Active</span>
                    </label>
                </fieldset>

                <div class="modal-action">
                    <button type="button" class="btn" onclick="create_modal.close()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    {{-- Edit Modal --}}
    <dialog id="edit_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Edit Category</h3>
            <form id="edit_form" method="POST">
                @csrf
                @method('PUT')

                <fieldset class="fieldset mb-4">
                    <label for="edit_name" class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input id="edit_name" type="text" name="name" class="input input-bordered w-full" required>
                </fieldset>

                <fieldset class="fieldset mb-4">
                    <label class="label cursor-pointer justify-start gap-3">
                        <input id="edit_is_active" type="checkbox" name="is_active" value="1"
                            class="toggle toggle-success">
                        <span class="label-text">Active</span>
                    </label>
                </fieldset>

                <div class="modal-action">
                    <button type="button" class="btn" onclick="edit_modal.close()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <x-delete-modal :model="\App\Models\Category::class" />
@endsection

@section('script')
    <script>
        const table = new DataTable('#categories');

        function openCreateModal() {
            create_modal.showModal();
        }

        function openEditModal(id, name, isActive) {
            document.getElementById('edit_form').action = `/categories/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_is_active').checked = isActive;
            edit_modal.showModal();
        }

        @if ($errors->any() && old('_modal') !== 'edit')
            create_modal.showModal();
        @endif
    </script>
@endsection
