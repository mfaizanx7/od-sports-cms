@php
    $currentValue = $value ?? '';
    $imageUrl = '';
    if ($currentValue) {
        if (str_starts_with($currentValue, 'http://') || str_starts_with($currentValue, 'https://')) {
            $imageUrl = $currentValue;
        } elseif (file_exists(public_path($currentValue))) {
            $imageUrl = asset($currentValue);
        } else {
            $imageUrl = RvMedia::getImageUrl($currentValue);
        }
    }
@endphp
<div class="custom-img-widget" data-name="{{ $name }}">
    <input type="hidden" name="{{ $name }}" value="{{ $currentValue }}" class="img-value">
    <input type="hidden" name="{{ $name }}_delete" value="0" class="img-delete-flag">
    <input type="file" name="{{ $name }}_file" accept="image/*" class="img-file-input" style="display:none;">

    <div class="img-preview-area" @if(!$imageUrl) style="display:none;" @endif>
        <img src="{{ $imageUrl }}" alt="Preview" class="img-preview">
    </div>

    <div class="img-empty" @if($imageUrl) style="display:none;" @endif>
        <i class="fa fa-image"></i>
        <span>No image selected</span>
    </div>

    <div class="img-action-bar">
        <button type="button" class="img-act-btn img-act-view" title="View Full Size" @if(!$imageUrl) disabled @endif>
            <i class="fa fa-eye"></i> View
        </button>
        <button type="button" class="img-act-btn img-act-replace" title="Choose from PC">
            <i class="fa fa-upload"></i> Replace
        </button>
        <button type="button" class="img-act-btn img-act-delete" title="Remove Image" @if(!$imageUrl) disabled @endif style="background:#7f1d1d;color:#fca5a5;border-color:#991b1b;">
            <i class="fa fa-trash"></i> Delete
        </button>
    </div>
</div>
