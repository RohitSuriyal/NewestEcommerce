@props([
    "products" => [],
])

@push("styles")
<style>
.product-card {
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    border-radius: 5px;
    min-height: 200px;
    display: flex;
    align-items: stretch;
}

.product-content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

</style>
@endpush

<div class="container-fluid">
    @foreach ($products as $product)
    
       <a href="{{route('website.singleproduct',$product->id)}}">
        <div class="product-card my-5 p-3">
            <div class="row w-100 ">
                <div class="col-md-2 d-flex align-items-center">
                    <img src="{{ asset('images/' . $product->main_image) }}" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="product-content">
                        <div>
                            <h5>{{ $product->name }}</h5>
                            <span class="rating-badge">
                                {{ $product->rating }} &#9733;
                            </span>
                            <p>{{ Str::limit($product->description, 500) }}</p>
                        </div>
                        <div>
                            <button class="btn btn-warning">Read More</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-center">
                 <h1>₹{{ number_format($product->price, 2) }}</h1>

                </div>
            </div>
        </div>
    </a> 
    
    
    @endforeach
</div>