<div 
    x-data="{ open: false }"
    x-init="
        @if($errors->any() && ($is_edit_modal ?? false))
            open = true;
        @endif
    "
    @open-modal.window="
        if ($event.detail.id === '{{ $id }}') {
            open = true;
        }
    "
    @close-modal.window="
        if ($event.detail.id === '{{ $id }}') {
            open = false;
        }
    "
    class="relative z-50"
    role="dialog"
    aria-modal="true"
>

    <div 
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 bg-black/50"
    ></div>

    <div 
        x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
        @click.self="open = false"
    >

        <div 
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-6 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-6 sm:scale-95"
            class="relative w-full bg-white rounded-xl shadow-2xl overflow-hidden 
                   {{ $maxWidth ?? 'sm:max-w-lg' }} max-h-[90vh]"
            @keydown.escape.window="open = false"
        >

            <div class="bg-[#1E293B] px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white" id="modal-title">{{ $title }}</h3>

                <button 
                    type="button" 
                    @click="open = false"
                    class="text-white/70 hover:text-white transition"
                >
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form 
                action="{{ $action }}"
                method="{{ strtolower($method ?? 'post') === 'get' ? 'GET' : 'POST' }}"
                class="flex flex-col max-h-[calc(90vh-60px)]"
            >
                @csrf
                @if(in_array(strtolower($method ?? 'post'), ['put', 'patch']))
                    @method($method)
                @endif

                <div class="px-6 py-6 overflow-y-auto flex-1">
                    {{ $slot }}
                </div>

                <div class="bg-white px-6 py-3 flex justify-end gap-3">
                    <button 
                        type="button" 
                        @click="open = false"
                        class="px-4 py-2 rounded-lg border border-gray-300 bg-white
                               text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-100"
                    >
                        {{ $cancelText ?? 'Batal' }}
                    </button>

                    <button 
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm 
                               font-semibold shadow-md hover:bg-blue-700"
                    >
                        {{ $buttonText ?? 'Simpan' }}
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
