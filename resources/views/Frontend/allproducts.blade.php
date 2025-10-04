@extends('layouts.website')
@section('content')
    <div class="container-fluid">
        <div class="row  d-flex gap-1">
            <div class="col-md-2">

                <h5 class="mt-3">filter</h5>
                <hr>
                <x-frontend.dropdown/>

            </div>


            <div class="col-md-9">
                <x-frontend.productcard :products="$allProducts" />

            </div>


        </div>

    </div>




@endsection