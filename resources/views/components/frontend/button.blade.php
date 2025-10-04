@props([

    "buttontext"=>"",
    "type"=>"",
])
@push("styles")
<style>

.button_color{
    background-color:#fb641b;
    color: white;
    border:none;
    font-weight:bold;
}

</style>

@endpush
<button type="{{$type}}" class="button_color px-5 py-2">
 {{$buttontext}}
</button>
    