<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @isset($method) @method($method) @endisset

    <div class="grid gap-6">
        @foreach($locales as $loc)
            <div class="p-4 border border-zinc-100 rounded-lg bg-zinc-50/30">
                <div class="mb-4">
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Title ({{ strtoupper($loc) }})</label>
                    <input type="text" name="title[{{ $loc }}]" value="{{ old('title.' . $loc, $banner->title[$loc] ?? '') }}"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Description
                        ({{ strtoupper($loc) }})</label>
                    <textarea name="desc[{{ $loc }}]" rows="3"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">{{ old('desc.' . $loc, $banner->desc[$loc] ?? '') }}</textarea>
                </div>
            </div>
        @endforeach

        <div>
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Banner Image</label>
            <input type="file" name="image"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
            @if(!empty($banner->image))
                <div class="mt-3">
                    <img src="{{ $banner->imageUrl() }}" class="h-24 rounded-lg shadow-md border border-zinc-200">
                </div>
            @endif
        </div>

        <div class="flex items-center gap-8">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="status" value="1" class="sr-only peer" {{ old('status', $banner->status ?? true) ? 'checked' : '' }}>
                <div
                    class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500">
                </div>
                <span class="ml-3 font-medium text-zinc-700">Active Status</span>
            </label>

            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_product_banner" value="1" class="sr-only peer" {{ old('is_product_banner', $banner->is_product_banner ?? false) ? 'checked' : '' }}>
                <div
                    class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
                <span class="ml-3 font-medium text-zinc-700">Is Product Banner?</span>
            </label>
        </div>

        <div>
            <button type="submit"
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg w-full md:w-auto">
                Save Banner
            </button>
        </div>
    </div>
</form>