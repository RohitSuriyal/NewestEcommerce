@props([
    'name' => '',
    'placeholder' => '',
    'type' => 'text',
    'class' => ''
])

<div>
    <input 
        name="{{ $name }}" 
        class="form-control {{ $class }}" 
        placeholder="{{ $placeholder }}" 
        type="{{ $type }}" 
    />
</div>
