@props([
    "buttontext" => ""
])

@if($buttontext)

    <button class="btn btn-success">{{$buttontext}}</button>

@endif

</button>