@extends('frontend.layouts.master')


@section('title', 'Return & Exchange')

@section('content')
    <div class="bg-[#F9F5EB] min-h-screen py-20 px-4">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h1 class="text-6xl font-serif font-bold text-[#A67C52] mb-8">Return and Exchange</h1>
            <p class="text-zinc-500 max-w-2xl mx-auto leading-relaxed text-lg">
                Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion his extended.
                Ecstatic followed handsome drawings entirely Mrs one yet outweigh.
            </p>
        </div>

        <div class="max-w-5xl mx-auto space-y-6">
            @forelse($returns as $return)
                <div x-data="{ open: false }"
                    class="bg-white rounded-xl shadow-sm border border-zinc-100/50 overflow-hidden transition-all duration-300"
                    :class="{ 'shadow-md': open }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between p-8 text-left focus:outline-none group">
                        <span class="text-xl font-bold text-zinc-800 group-hover:text-[#A67C52] transition-colors"
                            :class="{ 'text-[#A67C52]': open }">
                            {{ $return->title }}
                        </span>
                        <div class="flex-shrink-0 ml-6">
                            <div class="w-10 h-10 rounded-full bg-[#F3EFE0] flex items-center justify-center text-[#A67C52] font-bold text-2xl transition-transform duration-300"
                                :class="{ 'rotate-180': open }">
                                <span x-text="open ? '−' : '+'"></span>
                            </div>
                        </div>
                    </button>
                    <div x-show="open" x-collapse x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                        class="px-8 pb-8 text-zinc-600 text-lg leading-relaxed pt-2">
                        <div class="border-t border-zinc-50 pt-6">
                            {!! nl2br(e($return->content)) !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-lg shadow-sm border border-zinc-100">
                    <p class="text-zinc-500">No Return & Exchange policy found yet.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Ensure Cinzel or Playfair is used for premium font if available */
        .font-premium {
            font-family: 'Cinzel', 'Playfair Display', serif;
        }
    </style>
@endpush