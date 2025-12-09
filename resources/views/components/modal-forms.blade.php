@props([
    'id',
    'title' => 'From',
    'action',
    'method' => 'POST',
    'buttonText' => 'Simpan',
    'fieldsView',
    'data' => null,
    'fieldsData' => [],
])

<div id="{{ $id }}" tabindex="-1" aria-hidden="true" onclick="handleBackdropClick(event, '{{ $id }}')"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">
        <div class="flex justify-between items-center border-b-2 border-gray-300 px-6 py-3">
            <h3 class="text-xl font-semibold text-gray-800">{{ $title }}</h3>
            <button type="button" class="text-gray-500 font-extrabold hover:text-gray-700" onclick="closeModal('{{ $id }}')">
                ✕
            </button>
        </div>

        <form action="{{ $action }}" method="POST" class="p-6 space-y-4 flex-1 overflow-y-auto">
            @csrf
            @if (strtoupper($method) === 'PUT')
                @method('PUT')
            @endif

            @include($fieldsView, array_merge($fieldsData, ['item' => $data]))

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 transition">
                    {{ $buttonText }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function handleBackdropClick(event, id) {
        if (event.target.id === id) {
            closeModal(id);
        }
    }
</script>
