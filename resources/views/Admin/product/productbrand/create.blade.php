@extends("layouts.app")
@section('content')

    <div class="card mx-3 my-2">
        <x-admin.pageheader title="Create Brand" />
    </div>
    <div class="card mx-3 my-2">

       
        <form class="px-5 py-3" action="{{route('admin.productbrand.store')}}" method="post">
            @csrf

            <x-Admin.form label="Brand" name="name" type="text" value="" placeholder="Enter Brand Name" />


            <x-Admin.button buttontext="Submit" />

        </form>

    </div>

@endsection