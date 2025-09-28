@extends("layouts.website")

@section('content')
     <x-frontend.header/>
     <x-frontend.bannercarousel :banners="$banners" />
     <x-frontend.slider title="Brand New Smartphones" category="Mobiles" :products="$products"/>
     <x-frontend.slider title="Brand New Appliances"  category="appliance" :products="$products"/>
     <x-frontend.productbannercarousel :products="$products"/> 
     <x-frontend.footer/>
   
@endsection