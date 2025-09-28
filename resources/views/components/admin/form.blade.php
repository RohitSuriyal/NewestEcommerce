@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'lists' => [],
    'selected_id'=>'',
    'selected_brand_id'=>'',
     'newimages' => [],
   

])

@push('styles')
<style>
    .form-control:focus {
        outline: none !important;
        border-color: #80bdff !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }
</style>
<style>
  .upload-box {
    width: 200px;
    height: 150px;
    border: 2px dashed #ccc;
    position: relative;
    cursor: pointer;
    overflow: hidden;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #plusSign {
    position: absolute;
    font-size: 100px !important;
    color: rgba(150, 150, 150, 0.8); /* greyish color */
    text-shadow: 0 0 5px rgba(0,0,0,0.5); /* softer shadow */
    pointer-events: none; /* allows click to pass through to parent */
}

  .upload-box input[type="file"] {
    display: none; /* hide actual input */
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
                <option    value="{{ $list->id }}" {{$selected_id==$list->id ?'selected':''}} {{ old($name, $value) == $list->id ? 'selected' : '' }}>
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


    @elseif($type=="file" && $name=="main_image")
    <label class="my-2">image</label>
      <div class="upload-box"  
     style="background-image: url('{{ $value ? asset('images/' . $value) : asset('images/placeholder.png') }}');"  
     id="uploadBox">
     
    <span id="plusSign">+</span>
    <input name="{{ $name }}" class="form-control" type="{{ $type }}" id="fileInput"/>
</div>

  
    @elseif($type=="file" && $name=="images")
      <input type="file" id="images" name="images[]" multiple accept="image/*">
      <div id="exitingpreview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:10px;"></div>
    <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:10px;"></div>
   
    @endif
    @error($name)
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>



@push("scripts")

<script>
  let selectedFiles = []; 
 // your array from DB

 
      

    const input = document.getElementById('images');
    const preview = document.getElementById('preview');

    //this is for the update part
    const exitingPreviewContainer = document.getElementById('exitingpreview'); 
    let existingImages = @json($newimages?? []);
    console.log(existingImages);
    function exitingPreview() 
    {
        exitingPreviewContainer.innerHTML = '';
        existingImages.forEach((img, idx) => {
        const imgDiv = document.createElement('div');
        imgDiv.style.position = 'relative';

        const image = document.createElement('img');
        image.src = "{{ asset('images') }}/" + img;
        image.style.width = '100px';
        image.style.height = '100px';
        image.style.objectFit = 'cover';
        image.style.border = '1px solid #ccc';
        image.style.borderRadius = '5px';

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

        btn.addEventListener('click', function() {
            // remove image from array
            existingImages.splice(idx, 1);
            exitingPreview(); // rerender
        });

        imgDiv.appendChild(image);
        imgDiv.appendChild(btn);
        exitingPreviewContainer.appendChild(imgDiv);
    });
}
    
// First render DB images
exitingPreview();

    // You can loop through them or render previews here
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


    input.addEventListener('change', function () {
    for (let i = 0; i < this.files.length; i++) {
        selectedFiles.push(this.files[i]);
    }
    renderPreview(); // re-render
});

     // Make sure form submits the current selectedFiles
   // When the form is submitted
document.querySelector('.productform').addEventListener('submit', function (event) {
     
    // 1. Create a new "basket" to hold the files we actually want to upload
    const fileBasket = new DataTransfer();

    // 2. Go through all the files in our custom array (selectedFiles)
    selectedFiles.forEach(file => {
        // Add each file into the basket
        fileBasket.items.add(file);
    });

    // 3. Replace the real input's files with our cleaned basket
    // This makes sure only the remaining files are sent to the server
    input.files = fileBasket.files;

    // 4. (Optional) Debugging - see what files will actually go to Laravel
    console.log("Final files being uploaded:", input.files);

    //this is for the appeend of the exisitng array
   existingImages.forEach(img => {
    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'existing_images[]'; // [] → Laravel treats it as array
    hidden.value = img;
    this.appendChild(hidden);
});
});


    </script>
    <script>
    const uploadBox = document.getElementById('uploadBox');
    const fileInput = document.getElementById('fileInput');

    uploadBox.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            uploadBox.style.backgroundImage = `url(${e.target.result})`;
        }
        reader.readAsDataURL(file);
        }
    });
    </script>


@endpush