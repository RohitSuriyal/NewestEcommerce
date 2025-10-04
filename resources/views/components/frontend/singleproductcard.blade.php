@props([

    "product" => [],
    "ordersummary"=>"",

])
@push('styles')
    <style>
        .image_shadow {
            box-shadow: 0.5px 0.5px 0.5px rgba(0, 0, 0.1)
        }

        .card_shadow {

            box-shadow: 0.1px 0.1px 0.5px rgba(0, 0, 0.4)
        }

        .related_products{
            margin-left:6%!important;
        }
    </style>
    <style>
        .quantity-selector {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            width: 120px;
            justify-content: space-between;
        }

        .quantity-btn {
            background-color: #2874f0;
            /* Flipkart blue */
            color: #fff;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.2rem;
            transition: background 0.2s;
            flex: 1;
            text-align: center;
        }

        .quantity-btn:hover {
            background-color: #0056b3;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            outline: none;
            font-size: 1rem;
            padding: 8px 0;
            flex: 1;
        }

        .quantity-selector .minus {
            border-right: 1px solid #ccc;
        }

        .quantity-selector .plus {
            border-left: 1px solid #ccc;
        }
    </style>

@endpush
<div class="row d-flex gap-2">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-2 d-flex flex-column gap-3">
                @foreach ($product->image as $image)
                    <img  class="image_shadow" src="{{asset('images/' . $image)}}"></img>
                @endforeach
            </div>

            <div class="col-md-9 p-3 card_shadow">
                <img 
                style="height: {{ $ordersummary != '' ? '250px' : 'auto' }};object-fit:cover" 
                class="w-100" 
                src="{{ asset('images/' . $product->main_image) }}" 
                alt="Product Image">

                <div class="d-flex justify-content-between">
                    @if($ordersummary=="")
                    <x-frontend.cartbutton/>
                    <x-frontend.buybutton   product_id="{{$product->id}}"  />
                    @endif   
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <h5>{{$product->name}}</h5>

        <span class="rating-badge">
                    {{ $product->rating }} &#9733;
        </span>

    
       <h1>
       <span>&#8377;</span>
       <span class="product_price">
            {{ number_format($product->price, 2) }}
       </span>
       
       </h1>

    @if ($ordersummary!="")
    <div class="quantity-selector d-flex align-items-center">
        
        <button type="button" class="quantity-btn minus">-</button>
        <input type="number" class="quantity-input" value="1" min="1">
        <button type="button" class="quantity-btn plus">+</button>
    </div>
      

    @endif

    @if ($ordersummary=='')
    <p>
        {{$product->description}}
    </p>
    @endif
    
    </div>
<div>
    @if($ordersummary=="")
    <h1 class="related_products">Related Products</h1>
    @endif
</div>
</div>

@push("scripts")

<script>
  // Get the original base price (unit price)
const firstBasePriceText = document.querySelector(".product_price").innerText;
const firstBasePrice = parseFloat(firstBasePriceText.replace(/[^0-9.]/g, ''));

// Select all quantity buttons
document.querySelectorAll(".quantity-btn").forEach(function(button) {
    button.addEventListener("click", function() {
        // Get the quantity input
        const input = this.parentElement.querySelector(".quantity-input");
        let currentValue = parseInt(input.value);

        // Get the price display element
        const priceInput = document.querySelector(".product_price");

        // Check if button is plus or minus
        if (this.classList.contains("plus")) {
            input.value = currentValue + 1;
        } else if (this.classList.contains("minus")) {
            if (currentValue > 1) {  // prevent going below 1
                input.value = currentValue - 1;
            }
        }

        // Calculate total price = unit price * quantity
        let total = firstBasePrice * parseInt(input.value);

        // Format with commas and 2 decimal places (Indian format)
        priceInput.innerText = total.toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    });
});


</script>


@endpush
