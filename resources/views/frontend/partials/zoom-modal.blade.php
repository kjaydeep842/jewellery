<!-- Image Zoom Modal -->
<div x-show="zoomOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[10000] flex items-center justify-center bg-black/90 backdrop-blur-sm p-4"
    style="display: none;" @click="zoomOpen = false">

    <div class="relative w-full max-w-4xl max-h-[90vh] flex items-center justify-center" @click.stop>
        <button @click="zoomOpen = false"
            class="absolute -top-10 right-0 text-white hover:text-[#CBA65A] transition-colors z-[10002]">
            <i class="fa-solid fa-xmark text-2xl"></i>
        </button>

        <template x-if="zoomImages.length > 1">
            <button @click.prevent.stop="zoomIndex = zoomIndex === 0 ? zoomImages.length - 1 : zoomIndex - 1"
                class="absolute left-2 md:-left-12 z-[10001] w-10 h-10 md:w-12 md:h-12 bg-white/20 hover:bg-[#CBA65A] rounded-full flex items-center justify-center shadow-sm cursor-pointer transition-colors">
                <i class="fa-solid fa-chevron-left text-[20px] text-white transition-colors"></i>
            </button>
        </template>

        <template x-if="zoomImages.length > 0">
            <img :src="zoomImages[zoomIndex]" class="max-w-full max-h-[85vh] object-contain rounded-md shadow-2xl">
        </template>

        <template x-if="zoomImages.length > 1">
            <button @click.prevent.stop="zoomIndex = zoomIndex === zoomImages.length - 1 ? 0 : zoomIndex + 1"
                class="absolute right-2 md:-right-12 z-[10001] w-10 h-10 md:w-12 md:h-12 bg-white/20 hover:bg-[#CBA65A] rounded-full flex items-center justify-center shadow-sm cursor-pointer transition-colors">
                <i class="fa-solid fa-chevron-right text-[20px] text-white transition-colors"></i>
            </button>
        </template>
    </div>
</div>