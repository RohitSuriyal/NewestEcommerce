@extends('layouts.app')
@section('content')
<div class="card">

     <x-admin.pageheader title="Banner" />
    <x-admin.error/>
    <div class="card mx-3 my-2 p-3">
        <form action="{{route('admin.banner.update',$banner->id)}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-md-3">
                    <x-admin.form type="file" value="{{$banner->main_image}}" name="main_image" />
                </div>

                <div class="col-md-6">
                 <x-admin.form type="text" value="{{$banner->name}}" label="name" name="name"  placeholder="Enter Banner name"/>
                </div>

            </div>

                 <x-admin.button buttontext="Submit"/>

        </form>



    </div>

</div>

@endsection