<div
    x-data="{ show: @json(session('message') ? true : false), type: @json(session('type') ?? 'success') }"
    x-show="show"
    x-transition
    x-init="setTimeout(() => show = false, 5000)"
    class="notification"
    :class="type === 'success' ? 'bg-success' : 'bg-danger'"
>
    <p x-text="@json(session('message'))"></p>
</div>

<style>
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-size: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .bg-success {
        background-color: #28a745;
    }

    .bg-danger {
        background-color: #dc3545;
    }
</style>
