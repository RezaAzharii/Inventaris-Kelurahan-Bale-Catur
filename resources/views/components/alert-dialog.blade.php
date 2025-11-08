@props([
    'title' => 'Konfirmasi',
    'message' => 'Apakah Anda yakin ingin menghapus data ini?',
    'confirmText' => 'Ya, Hapus',
    'cancelText' => 'Batal',
    'action' => '#',
])

<div x-data="{ show: false }">
    <span @click="show = true">
        {{ $trigger ?? '' }}
    </span>

    <div 
        x-show="show"
        x-transition
        @click.away="show = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                {{ $title }}
            </h3>
            <p class="text-gray-600 mb-6">
                {{ $message }}
            </p>
            <div class="flex justify-end gap-3">
                <button 
                    @click="show = false"
                    type="button"
                    class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-200"
                >
                    {{ $cancelText }}
                </button>

                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                    >
                        {{ $confirmText }}
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
