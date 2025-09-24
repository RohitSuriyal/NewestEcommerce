@extends('layouts.app')

@section('content')
    <div class="card mx-3 my-2">
        <x-admin.pageheader title="Create Product" />
    </div>

    <div class="card w-75 m-auto p-3">
        <form method="Post" class="productform" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <x-admin.form name="name" label="Name" type="text" placeholder="Enter Product Name" />
                </div>
                <div class="col-md-6">
                    <x-admin.form name="price" label="Price" type="number" placeholder="Enter the price" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.form name="rating" label="Rating" type="number" placeholder="Enter the rating" />
                </div>
                <div class="col-md-6">
                    <x-admin.form name="category_id" label="Category" type="select" :lists="$categories" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.form name="brand_id" label="Brand" type="select" :lists="$brands" />
                </div>
                <div class="col-md-6">
                    <x-admin.form name="description" label="Description" type="textarea"
                        placeholder="Enter product description" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-admin.form name="quantity" label="quantity" type="number" place />
                </div>

            </div>
            <div class="row">
                <label class="ms-1 my-2">Image</label>
               <x-admin.form name="image" label="image" type="file"/>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection