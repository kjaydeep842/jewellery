<?php
<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @isset($method) @method($method) @endisset

    <div class="grid gap-4">
        @foreach($locales as $loc)
            <div>
                <label>Title ({{ $loc }})</label>
                <input type="text" name="title[{{ $loc }}]" value="{{ old('title.'.$loc, $banner->title[$loc] ?? '') }}">
            </div>

            <div>
                <label>Desc ({{ $loc }})</label>
                <textarea name="desc[{{ $loc }}]">{{ old('desc.'.$loc, $banner->desc[$loc] ?? '') }}</textarea>
            </div>
        @endforeach

        <div>
            <label>Image</label>
            <input type="file" name="image">
            @if(!empty($banner->image))
                <img src="{{ $banner->imageUrl() }}" style="height:70px;">
            @endif
        </div>

        <div>
            <label>
                <input type="checkbox" name="status" value="1" {{ old('status', $banner->status ?? true) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <div>
            <button type="submit">Save</button>
        </div>
    </div>
</form>