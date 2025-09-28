@props([
    "title" => '',
    "products"=>[],
    "category"=>'',
])

@push("styles")
    <style>
        .slider_container {
            display: flex;
            gap: 20px;
            overflow: hidden;
            scroll-behavior: smooth;
        }

         .slider_container::-webkit-scrollbar { display: none; }
        .slider_container { -ms-overflow-style: none; scrollbar-width: none; }

        .card {
            flex: 0 0 auto;
            width: 18rem;
            border-radius: 20px;
           box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
           cursor:pointer;

        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 30px;
            background-color: rgb(241, 160, 8);
            color: white;
            z-index: 10;
            cursor: pointer;
        
        }


        .slider-btn.prev { left: -2%; }
        .slider-btn.next { right: -2%; }

        .slider-btn:hover {
            background-color: rgb(241, 160, 8) !important;
            color: white !important;
        }
       
        .card_image{

            object-fit: cover!important;
            height:200px!important;
        }
    </style>
@endpush

<div class="container p-3 position-relative slider-wrapper">
    <h1>{{ $title }}</h1>

    <!-- Slider -->
    <div class="slider_container">
        @foreach ($products as $product )
         @if ($category=="Mobiles" && $product->category->name=="Mobiles")
          <a>
             <div class="card p-3 h-100">
                <img src="{{ asset('images/'.$product->main_image) }}" class="card_image" alt="...">
                <div class="card-body">
                   <h5 class="card-title">{{ Str::limit($product->name, 20) }}</h5>

                  <p class="card-text description">
                 {{ Str::limit($product->description, 100) }}
                </p>
                <button class="btn btn-warning read-more-btn">Read more</button>
                </div>
            </div>
          </a>
        @endif

        @if ($category=="appliance" && $product->category->name=="appliance")
          <a>
             <div class="card p-3 h-100">
                <img src="{{ asset('images/'.$product->main_image) }}" class="card_image" alt="...">
                <div class="card-body">
                   <h5 class="card-title">{{ Str::limit($product->name, 20) }}</h5>

                  <p class="card-text description">
                 {{ Str::limit($product->description, 100) }}
                </p>
                <button class="btn btn-warning read-more-btn">Read more</button>
                </div>
            </div>
          </a>
          @endif

        @endforeach
    </div>

       
              <!-- Controls -->
    <button class="btn slider-btn prev"><</button>
    <button class="btn slider-btn next">></button>
</div>
@push('scripts')
<script>
document.querySelectorAll('.slider-wrapper').forEach(wrapper => {
    const slider = wrapper.querySelector('.slider_container');
    const nextBtn = wrapper.querySelector('.slider-btn.next');
    const prevBtn = wrapper.querySelector('.slider-btn.prev');
    const scrollAmount = 300;
    const intervalTime = 10000;

    // Auto-scroll
    let autoScroll = setInterval(() => {
        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
            slider.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }, intervalTime);

    // Button clicks
    nextBtn.addEventListener('click', () => slider.scrollBy({ left: scrollAmount, behavior: 'smooth' }));
    prevBtn.addEventListener('click', () => slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' }));

    // Pause on hover
   wrapper.addEventListener('mouseenter', () => {
  
    clearInterval(autoScroll);
    });
    wrapper.addEventListener('mouseleave', () => {
        autoScroll = setInterval(() => {
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
                slider.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }, intervalTime);
    });
});




</script>



@endpush

