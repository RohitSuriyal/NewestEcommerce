<style>
    .button_color {
        background-color: #fb641b;
        color: white;
        font-weight: bold;
        border: none;
    }
</style>
@props([
    "product_id"=>"",
])


<a href="{{route('website.buynowlogin',$product_id)}}">
    <button class="px-3 py-2  button_color mt-5">

        <i class="fa-solid fa-bolt" style="color: #ffffff;"></i>
        BUY NOW
    </button>
</a>