@extends('layouts.admin')

@section('title', 'General Settings')

@section('content')

<h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">General Settings</h1>

@if(session('success'))
<div
    class="p-4 mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg flex items-center animate-enter">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Site Name</label>
                    <input type="text" name="site_name" value="{{ $settings->site_name ?? 'LuxeGems' }}"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Font Family</label>
                    <select name="font_family"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                        <option value="Cinzel" {{ ($settings->font_family ?? '') == 'Cinzel' ? 'selected' : '' }}>Cinzel (Premium Serif)</option>
                        <option value="Playfair Display" {{ ($settings->font_family ?? '') == 'Playfair Display' ? 'selected' : '' }}>Playfair Display (Elegant)</option>
                        <option value="Inter" {{ ($settings->font_family ?? '') == 'Inter' ? 'selected' : '' }}>Inter (Modern Sans)</option>
                        <option value="Roboto" {{ ($settings->font_family ?? '') == 'Roboto' ? 'selected' : '' }}>Roboto (Clean)</option>
                        <option value="Lato" {{ ($settings->font_family ?? '') == 'Lato' ? 'selected' : '' }}>Lato (Humanist Sans)</option>
                        <option value="Open Sans" {{ ($settings->font_family ?? '') == 'Open Sans' ? 'selected' : '' }}>Open Sans (Neutral)</option>
                        <option value="Montserrat" {{ ($settings->font_family ?? '') == 'Montserrat' ? 'selected' : '' }}>Montserrat (Geometric)</option>
                        <option value="Merriweather" {{ ($settings->font_family ?? '') == 'Merriweather' ? 'selected' : '' }}>Merriweather (Classic Serif)</option>
                        <option value="Nunito" {{ ($settings->font_family ?? '') == 'Nunito' ? 'selected' : '' }}>Nunito (Rounded)</option>
                        <option value="Raleway" {{ ($settings->font_family ?? '') == 'Raleway' ? 'selected' : '' }}>Raleway (Elegant Sans)</option>
                    </select>
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Logo</label>
                    <input type="file" name="logo"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                    @if($settings->logo_path)
                    <div class="mt-4 p-2 bg-zinc-900 rounded-lg inline-block">
                        <img src="{{ asset('storage/' . $settings->logo_path) }}" class="h-12 object-contain">
                    </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Primary Color (Gold Accent)</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="primary_color" value="{{ $settings->primary_color ?? '#ffbf00' }}"
                            class="h-10 w-20 rounded border border-zinc-300 cursor-pointer">
                        <input type="text" value="{{ $settings->primary_color ?? '#ffbf00' }}"
                            class="flex-1 border-zinc-300 rounded-lg shadow-sm bg-zinc-50 text-zinc-500 p-2.5" readonly>
                    </div>
                    <p class="text-xs text-zinc-400 mt-1">Used for buttons, highlights, and active states.</p>
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Secondary Color (Dark Theme)</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="secondary_color" value="{{ $settings->secondary_color ?? '#000000' }}"
                            class="h-10 w-20 rounded border border-zinc-300 cursor-pointer">
                        <input type="text" value="{{ $settings->secondary_color ?? '#000000' }}"
                            class="flex-1 border-zinc-300 rounded-lg shadow-sm bg-zinc-50 text-zinc-500 p-2.5" readonly>
                    </div>
                    <p class="text-xs text-zinc-400 mt-1">Used for sidebar background and text headers.</p>
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Header Color</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="header_color" value="{{ $settings->header_color ?? '#ffffff' }}"
                            class="h-10 w-20 rounded border border-zinc-300 cursor-pointer">
                        <input type="text" value="{{ $settings->header_color ?? '#ffffff' }}"
                            class="flex-1 border-zinc-300 rounded-lg shadow-sm bg-zinc-50 text-zinc-500 p-2.5" readonly>
                    </div>
                    <p class="text-xs text-zinc-400 mt-1">Background color for the top navigation bar.</p>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-zinc-100 flex justify-end">
            <button
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">Save
                Settings</button>
            <a href="{{ route('admin.dashboard') }}"
                class="px-8 py-3 ml-4 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection