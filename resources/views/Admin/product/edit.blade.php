@extends('layouts.app')

@section('content')
    <div class="card mx-3 my-2">
        <x-admin.pageheader title="Edit Product" />
    </div>

    <div class="card w-75 m-auto p-3">
        <x-admin.error />

        <form method="Post" class="productform" action="{{ route('admin.product.update', $product->id)}}"
            enctype="multipart/form-data">
            @method("PUT")
            @csrf
             @php
                $images = $product->image ? json_decode($product->image, true) : [];
            @endphp
            <x-admin.form :newimages="$images" />
            <div class="row">
                <div class="col-md-6">
                    <x-admin.form name="name" label="Name" type="text" value="{{$product->name}}"
                        placeholder="Enter Product Name" />
                </div>
                <div class="col-md-6">
                    <x-admin.form name="price" label="Price" value="{{$product->price}}" type="number"
                        placeholder="Enter the price" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.form name="rating" label="Rating" value="{{$product->rating}}" type="number"
                        placeholder="Enter the rating" />
                </div>
                <div class="col-md-6">
                    <x-admin.form name="category_id" selected_id="{{$product->category_id}}" label="Category" type="select"
                        :lists="$categories" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.form name="brand_id" label="Brand" selected_id="{{$product->brand_id}}" type="select"
                        :lists="$brands" />
                </div>
                <div class="col-md-6">
                    <x-admin.form name="description" label="Description" value="{{$product->description}}" type="textarea"
                        placeholder="Enter product description" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-admin.form name="quantity" label="quantity" value="{{$product->quantity}}" type="number" place />
                </div>
            </div>

            <div class="row">
                <x-admin.form name="images" value="{{$product->main_image}}" label="Main Image" name="main_image"
                    type="file" aria-placeholder="selec the image" />
            </div>
           
            <div class="row">
                <label class="ms-1 my-2">Image</label>
                <x-admin.form name="images"  label="image" type="file" />
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
