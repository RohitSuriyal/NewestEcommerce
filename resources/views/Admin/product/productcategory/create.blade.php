@extends('layouts.app')
@section('content')
    <div class="card mx-3 my-2">
        <x-admin.pageheader title="Create Category" />
    </div>
    @if(session("success"))
        <div class="alert alert-success mx-3" role="alert">
            {{session('success')}}
        </div>
    @endif
    <div class=" card mx-3 py-3">
        <form class="mx-3" action="{{route('admin.productcategory.store')}}" method="post">
            @csrf
            <x-admin.form name="name" type="text" placeholder="Enter the Category" lablel="Name" />
            <x-admin.button buttontext="Submit" />
        </form>
    </div>

  


@endsection