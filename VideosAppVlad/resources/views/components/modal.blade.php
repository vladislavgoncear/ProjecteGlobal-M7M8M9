@props(['id' => 'customModal', 'title' => 'Default Title', 'message' => 'Default Message', 'confirmText' => 'Confirm', 'cancelText' => 'Cancel', 'confirmAction' => null])

<div id="{{ $id }}" class="modal" x-data="{ show: false }" x-show="show" style="display: none;">
    <div class="modal-backdrop" x-on:click="show = false"></div>
    <div class="modal-content">
        <h4 class="modal-title">{{ $title }}</h4>
        <p class="modal-message">{{ $message }}</p>
        <div class="modal-footer">
            <button class="btn btn-secondary" x-on:click="show = false">{{ $cancelText }}</button>
            <button class="btn btn-primary" x-on:click="if (typeof confirmAction === 'function') confirmAction(); show = false;">
                {{ $confirmText }}
            </button>
        </div>
    </div>
</div>

<style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-backdrop {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        position: relative;
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1001;
        width: 400px;
        max-width: 90%;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .modal-message {
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }

    .btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background: #0056b3;
    }
</style>
