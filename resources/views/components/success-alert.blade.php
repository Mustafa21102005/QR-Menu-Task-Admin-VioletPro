@if (session('success'))
    <div class="alert alert-success mb-4">
        <span>{{ session('success') }}</span>
    </div>
@endif
