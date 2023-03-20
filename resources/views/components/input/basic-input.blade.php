<div {{ $is_hidden ? 'hidden' : ''}} {{ $attributes->merge(['class' => 'form-group']) }}>
    <label role="button" for="{{ $id }}">{{ $label }} <small class="text-danger">{{ $is_required ? '*' : '' }}</small></label>
    <input type="{{ $type }}" class="form-control" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $attr }}>
</div>
