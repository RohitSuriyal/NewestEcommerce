@props([
    'banners' => []
])

@push("styles")
<style>
 .banner_images{
   background-position: center;
    background-size: cover;
    background-repeat: no-repeat;

 }

</style>

@endpush
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner" style="height:90vh!important">
    @foreach ($banners as $key=>$banner )
    <div class="carousel-item  h-100 {{$key==0 ?'active':''}}">
      <img src="{{asset('images/'.$banner->main_image)}}" class="d-block w-100 " alt="...">
    </div>
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>