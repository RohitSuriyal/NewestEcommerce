@extends('layouts.app')

@section('content')

    <div class="card mx-3 my-2">
        <x-admin.pageheader title="Edit Brand" />
    </div>
    <div class="card mx-3 my-2">
        <form class="px-5 py-3" action="{{route('admin.productbrand.update',$brand->id)}}" method="post">
            @csrf
            @method("PUT")
            <x-admin.form label="Brand" name="name" type="text" value="{{$brand->name}}" placeholder="Enter Brand Name" />
            <x-admin.button buttontext="Submit" />
        </form>
    </div>

@endsection
