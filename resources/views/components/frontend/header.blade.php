@push("styles")
    <style>
        .navbar_background {

            background-color: #ffc107 !important;

        }

        .logo_image {
            height: 50px;
            border-radius: 30px;

        }
    </style>
@endpush
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar_background">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img class="logo_image" src="{{asset('images/ecommerce_logo.png')}}"></img>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex flex-grow-1 ps-lg--5">
                <input class="form-control me-2 ms-md-5" type="search" placeholder="Search" aria-label="Search">

            </form>
            <ul class="navbar-nav w-25  mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link active nav_text" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav_text" href="#"><i class="fa-solid fa-cart-shopping me-2"
                            style="color: #74C0FC;"></i>Cart</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>

                </li>

            </ul>

        </div>
    </div>
</nav>