@php
    $actionTemplate = route($routeName, [$paramName => '__ID__']);
@endphp

<dialog id="delete_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-2">Delete {{ $label }}</h3>
        <p class="opacity-70 mb-4">
            Are you sure you want to delete <span id="delete_name" class="font-semibold"></span>? This can't be
            undone.
        </p>
        <form id="delete_form" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-action">
                <button type="button" class="btn" onclick="delete_modal.close()">Cancel</button>
                <button type="submit" class="btn btn-error">Delete</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    function openDeleteModal(id, name) {
        document.getElementById('delete_form').action = @json($actionTemplate).replace('__ID__', id);
        document.getElementById('delete_name').textContent = name;
        delete_modal.showModal();
    }
</script>
