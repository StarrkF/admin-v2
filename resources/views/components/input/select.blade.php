<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label role="button" for="{{ $id }}">{{ $label }} <small class="text-danger">{{ $is_required ? '*' : '' }}</small></label>
    <select required name="{{ $name }}" id="{{ $id }}" class="{{ $sclass }} form-select">
        {{ $slot }}
    </select>
</div>

