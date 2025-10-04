@extends('layouts.website')
@section('content')
<div class="container p-3">
    <x-frontend.singleproductcard :product="$product"/>
    <x-frontend.slider  :products="$related_product"  />
</div>
@endsection

