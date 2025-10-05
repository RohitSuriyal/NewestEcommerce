@extends('layouts.app')

@section('content')

    <div class="card mx-3 my-2">
        <x-Admin.pageheader title="Edit Brand" />
    </div>
    <div class="card mx-3 my-2">
        <form class="px-5 py-3" action="{{route('admin.productbrand.update',$brand->id)}}" method="post">
            @csrf
            @method("PUT")
            <x-Admin.form label="Brand" name="name" type="text" value="{{$brand->name}}" placeholder="Enter Brand Name" />
            <x-Admin.button buttontext="Submit" />
        </form>
    </div>

@endsection
