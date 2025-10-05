@extends('layouts.app')
@push('styles')

    <style>
        .image_preview {

            width: 100px;
            height: 100px;
            border: 2px solid green;

        }

        .fileinput {
            display: none;
        }
    </style>

@endpush
@section('content')
    <x-admin.pageheader title="Banner" />
    <x-admin.error/>
    <div class="card mx-3 my-2 p-3">
        <form action="{{route('admin.banner.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="row">
                <div class="col-md-3">

                    <x-Admin.form type="file" name="main_image" />

                </div>
                <div class="col-md-6">
                 <x-Admin.form type="text" label="name" name="name"  placeholder="Enter Banner name"/>
                </div>

            </div>

                 <x-Admin.button buttontext="Submit"/>

        </form>



    </div>

@endsection
