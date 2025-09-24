@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'lists' => [],
])

@push('styles')
<style>
    .form-control:focus {
        outline: none !important;
        border-color: #80bdff !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }
</style>
@endpush

<div class="mb-3">
    @if($type == "select")
        @if($label)
            <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        @endif
        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
            <option value="">Select an option</option>
            @foreach ($lists as $list)
                <option value="{{ $list->id }}" {{ old($name, $value) == $list->id ? 'selected' : '' }}>
                    {{ $list->name }}
                </option>
            @endforeach
        </select>

    @elseif($type == "text"||$type=="number")
        @if($label)
            <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        @endif
        <input 
            type="{{ $type }}" 
            class="form-control" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            value="{{ old($name, $value) }}" 
            placeholder="{{ $placeholder }}">

    @elseif($type == "textarea")
        @if($label)
            <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        @endif
        <textarea 
            class="form-control" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>


    @elseif($type=="file" && $name="image")
      <input type="file" id="images" name="images[]" multiple accept="image/*">
    <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:10px;"></div>
    @endif

    @error($name)
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>
@push("scripts")
<script>
    let selectedFiles = [];

    const input = document.getElementById('images');
    const preview = document.getElementById('preview');

    input.addEventListener('change', function () {
        // Add new files to selectedFiles
        for (let i = 0; i < this.files.length; i++) {
            selectedFiles.push(this.files[i]);
        }
        renderPreview();
    });

    function renderPreview() {
        preview.innerHTML = '';
        selectedFiles.forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = (function (f, index) {
                return function (e) {
                    const imgDiv = document.createElement('div');
                    imgDiv.style.position = 'relative';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #ccc';
                    img.style.borderRadius = '5px';

                    const btn = document.createElement('button');
                    btn.innerText = '×';
                    btn.style.position = 'absolute';
                    btn.style.top = '0';
                    btn.style.right = '0';
                    btn.style.background = 'red';
                    btn.style.color = 'white';
                    btn.style.border = 'none';
                    btn.style.borderRadius = '50%';
                    btn.style.width = '20px';
                    btn.style.height = '20px';
                    btn.style.cursor = 'pointer';
                    btn.onclick = () => {
                        selectedFiles.splice(index, 1);
                        renderPreview();
                    }

                    imgDiv.appendChild(img);
                    imgDiv.appendChild(btn);
                    preview.appendChild(imgDiv);
                }
            })(file, idx);
            reader.readAsDataURL(file);
        });
    }

    // Make sure form submits the current selectedFiles
   document.querySelector('.productform').addEventListener('submit', function (e) {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    input.files = dataTransfer.files;
});

</script>


@endpush