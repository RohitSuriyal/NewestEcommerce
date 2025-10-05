@extends('layouts.website')

@push("styles")
    <style>
        .accordion-button:focus {
            box-shadow: none !important;
            border-color: transparent !important;
        }

        .emal_input {
            border: none !important;
        }

        .quantitybutton {
            border-radius: 30px !important;
        }
    </style>

@endpush

@section('content')

    @if(session('success'))
        <x-frontend.success />
    @endif
    </div>
    <div class="container">
        <div class="accordion mt-3" id="accordionExample">


            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h5>LOGIN OR SIGNUP</h5>
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form method="post" id="emialverifyform">
                            <input name="email" class="form-control w-25 emal_input" value="{{$userdetails->email}}"
                                placeholder="Enter your email/Mobile Number" />
                            <hr>
                            <div class="d-none otp_input" id="otpinput">
                                <input name="otp" class="form-control w-25 my-2 border-0 " placeholder="Enter the otp" />
                                <hr>
                            </div>
                            <x-frontend.button buttontext="Continue" />
                        </form>
                    </div>
                </div>


                <hr>
                <div class="accordion-item my-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h5>Address</h5>
                        </button>
                    </h2>

                    <div id="collapseTwo" class="accordion-collapse collapse {{ $errors->any() ? 'show' : '' }}"
                        data-bs-parent="#accordionExample">

                        <div class="accordion-body">
                            <form method="post" action="{{route('website.saveuseraddress')}}">
                                @csrf
                                <div class="row w-75">
                                    <div class="col-md-6">
                                        <lable>Name</lable>
                                        <input value="{{$userdetails->name}}" name="name" class="form-control"
                                            placeholder="Enter your name" />
                                        @error("name")
                                            <span class="text-danger"> {{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>10 digit mobile No</label>
                                        <input {{$userdetails->mobile_no}} name="mobile_no" class="form-control"
                                            placeholder="mobile no" />
                                        @error('mobile_no')
                                            <span class="text-danger"> {{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row w-75 my-3">
                                    <div class="col-md-6">
                                        <label>Pincode</label>
                                        <input value="{{$userdetails->pincode}}" name="pincode" class="form-control" />
                                        @error("pincode")
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>Locality</label>
                                        <input value="{{$userdetails->locality}}" name="locality" class="form-control" />
                                        <span class="text-danger">
                                            @error("locality")
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>

                                </div>
                                <div class="col-md-12  w-75">
                                    <lablel>Address</lablel>
                <textarea name="address" class="form-control" placeholder="Enter your Address">{{$userdetails->address}} </textarea>
          
                                                                   
                                    @error("address")
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror

                                </div>

                                <div class="row w-75 my-3">
                                    <div class="col-md-6">
                                        <label>City/District/town</label>
                                        <input value="{{$userdetails->city}}" name="city" class="form-control"
                                            placeholder="Enter the City" />
                                        <span class="text-danger">
                                            @error("city")
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>

                                            @enderror
                                        </span>

                                    </div>

                                    <div class="col-md-6">
                                        <label>State</label>
                                        <select name="state" class="form-control" id="state">
                                            <option value="">-- Select State --</option>
                                            <option value="Andhra Pradesh" {{ (isset($userdetails->state) && $userdetails->state == 'Andhra Pradesh') ? 'selected' : '' }}>Andhra Pradesh
                                            </option>
                                            <option value="Arunachal Pradesh" {{ (isset($userdetails->state) && $userdetails->state == 'Arunachal Pradesh') ? 'selected' : '' }}>Arunachal
                                                Pradesh</option>
                                            <option value="Assam" {{ (isset($userdetails->state) && $userdetails->state == 'Assam') ? 'selected' : '' }}>Assam</option>
                                            <option value="Bihar" {{ (isset($userdetails->state) && $userdetails->state == 'Bihar') ? 'selected' : '' }}>Bihar</option>
                                            <option value="Chhattisgarh" {{ (isset($userdetails->state) && $userdetails->state == 'Chhattisgarh') ? 'selected' : '' }}>Chhattisgarh
                                            </option>
                                            <option value="Goa" {{ (isset($userdetails->state) && $userdetails->state == 'Goa') ? 'selected' : '' }}>Goa</option>
                                            <option value="Gujarat" {{ (isset($userdetails->state) && $userdetails->state == 'Gujarat') ? 'selected' : '' }}>Gujarat</option>
                                            <option value="Haryana" {{ (isset($userdetails->state) && $userdetails->state == 'Haryana') ? 'selected' : '' }}>Haryana</option>
                                            <option value="Himachal Pradesh" {{ (isset($userdetails->state) && $userdetails->state == 'Himachal Pradesh') ? 'selected' : '' }}>Himachal
                                                Pradesh</option>
                                            <option value="Jharkhand" {{ (isset($userdetails->state) && $userdetails->state == 'Jharkhand') ? 'selected' : '' }}>Jharkhand</option>
                                            <option value="Karnataka" {{ (isset($userdetails->state) && $userdetails->state == 'Karnataka') ? 'selected' : '' }}>Karnataka</option>
                                            <option value="Kerala" {{ (isset($userdetails->state) && $userdetails->state == 'Kerala') ? 'selected' : '' }}>Kerala</option>
                                            <option value="Madhya Pradesh" {{ (isset($userdetails->state) && $userdetails->state == 'Madhya Pradesh') ? 'selected' : '' }}>Madhya Pradesh
                                            </option>
                                            <option value="Maharashtra" {{ (isset($userdetails->state) && $userdetails->state == 'Maharashtra') ? 'selected' : '' }}>Maharashtra
                                            </option>
                                            <option value="Manipur" {{ (isset($userdetails->state) && $userdetails->state == 'Manipur') ? 'selected' : '' }}>Manipur</option>
                                            <option value="Meghalaya" {{ (isset($userdetails->state) && $userdetails->state == 'Meghalaya') ? 'selected' : '' }}>Meghalaya</option>
                                            <option value="Mizoram" {{ (isset($userdetails->state) && $userdetails->state == 'Mizoram') ? 'selected' : '' }}>Mizoram</option>
                                            <option value="Nagaland" {{ (isset($userdetails->state) && $userdetails->state == 'Nagaland') ? 'selected' : '' }}>Nagaland</option>
                                            <option value="Odisha" {{ (isset($userdetails->state) && $userdetails->state == 'Odisha') ? 'selected' : '' }}>Odisha</option>
                                            <option value="Punjab" {{ (isset($userdetails->state) && $userdetails->state == 'Punjab') ? 'selected' : '' }}>Punjab</option>
                                            <option value="Rajasthan" {{ (isset($userdetails->state) && $userdetails->state == 'Rajasthan') ? 'selected' : '' }}>Rajasthan</option>
                                            <option value="Sikkim" {{ (isset($userdetails->state) && $userdetails->state == 'Sikkim') ? 'selected' : '' }}>Sikkim</option>
                                            <option value="Tamil Nadu" {{ (isset($userdetails->state) && $userdetails->state == 'Tamil Nadu') ? 'selected' : '' }}>Tamil Nadu</option>
                                            <option value="Telangana" {{ (isset($userdetails->state) && $userdetails->state == 'Telangana') ? 'selected' : '' }}>Telangana</option>
                                            <option value="Tripura" {{ (isset($userdetails->state) && $userdetails->state == 'Tripura') ? 'selected' : '' }}>Tripura</option>
                                            <option value="Uttar Pradesh" {{ (isset($userdetails->state) && $userdetails->state == 'Uttar Pradesh') ? 'selected' : '' }}>Uttar Pradesh
                                            </option>
                                            <option value="Uttarakhand" {{ (isset($userdetails->state) && $userdetails->state == 'Uttarakhand') ? 'selected' : '' }}>Uttarakhand
                                            </option>
                                            <option value="West Bengal" {{ (isset($userdetails->state) && $userdetails->state == 'West Bengal') ? 'selected' : '' }}>West Bengal
                                            </option>
                                            <option value="Andaman and Nicobar Islands" {{ (isset($userdetails->state) && $userdetails->state == 'Andaman and Nicobar Islands') ? 'selected' : '' }}>
                                                Andaman and Nicobar Islands</option>
                                            <option value="Chandigarh" {{ (isset($userdetails->state) && $userdetails->state == 'Chandigarh') ? 'selected' : '' }}>Chandigarh</option>
                                            <option value="Dadra and Nagar Haveli and Daman and Diu" {{ (isset($userdetails->state) && $userdetails->state == 'Dadra and Nagar Haveli and Daman and Diu') ? 'selected' : '' }}>Dadra and Nagar Haveli and Daman
                                                and Diu</option>
                                            <option value="Delhi" {{ (isset($userdetails->state) && $userdetails->state == 'Delhi') ? 'selected' : '' }}>Delhi</option>
                                            <option value="Jammu and Kashmir" {{ (isset($userdetails->state) && $userdetails->state == 'Jammu and Kashmir') ? 'selected' : '' }}>Jammu and
                                                Kashmir</option>
                                            <option value="Ladakh" {{ (isset($userdetails->state) && $userdetails->state == 'Ladakh') ? 'selected' : '' }}>Ladakh</option>
                                            <option value="Lakshadweep" {{ (isset($userdetails->state) && $userdetails->state == 'Lakshadweep') ? 'selected' : '' }}>Lakshadweep
                                            </option>
                                            <option value="Puducherry" {{ (isset($userdetails->state) && $userdetails->state == 'Puducherry') ? 'selected' : '' }}>Puducherry</option>
                                        </select>

                                        @error("state")
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="row w-75 my-3">
                                    <div class="col-md-6">
                                        <label>landmark(optional)</label>
                                        <input value="{{$userdetails->landmark}}" name="landmark" class="form-control"
                                            placeholder="Landmark" />

                                        @error("landmark")
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">

                                        <label>Alternate Number</label>
                                        <input value="{{$userdetails->alternate_number}}" name="alternate_number"
                                            class="form-control" placeholder="Enter the alternate number" />

                                        @error("alternate_number")
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                        <div class="ms-3 my-3">
                            <x-frontend.button type="submit" buttontext="Submit" />
                        </div>
                        </form>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{Auth::guard('web')->check() ? '' : 'collapsed'}}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree">
                            <h5>Order Summary</h5>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse {{Auth::guard('web')->check() ? '' : 'collapse' }}"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <x-frontend.singleproductcard :product="$product" ordersummary="ordersummary" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex  justify-content-between py-3 my-3 px-3 global_box_shadow">
            <div>Order Confirmtion will be sent to <strong>{{Auth::guard("web")->user()->email}}</strong></div>
            <div>
                <x-frontend.button type="button" buttontext="Continue" />
            </div>
        </div>
@endsection
    @push("scripts")
        <script>

            //for the accoccordion button for the click button

            document.getElementById('emialverifyform').addEventListener('submit', async function (e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData(form);

                // Add extra string if needed
                const arr = ['one', 'two', 'three'];
                formData.append('extra_array', arr.join(','));

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const response = await fetch('{{ route("website.emialverify") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    });

                    const data = await response.json(); // ✅ no .then here

                    console.log(data);


                    if (data.success == "otp mathced successfully") {

                        //this is to hide the pin div
                        document.querySelector("#otpinput").style.display = "none";

                        // Collapse all accordion buttons
                        document.querySelectorAll(".accordion-button").forEach(b => b.classList.add("collapsed"));

                        // Then expand the specific one (collapseTwo)
                        document.querySelector("#collapseTwo").previousElementSibling.querySelector(".accordion-button").classList.remove("collapsed");

                        //this is the for for loop
                        document.querySelectorAll(".accordion-collapse").forEach(b => b.classList.remove('show'));

                        // Also open the collapse body
                        let collapseEl = document.querySelector("#collapseTwo");
                        collapseEl.classList.add("show");

                    }

                    else if (data.success) {
                        console.log("we are inside of this");
                        document.querySelector(".otp_input").classList.remove("d-none");

                        Swal.fire({
                            toast: true,
                            position: "top-end", // side/top-right style
                            icon: "success",
                            title: data.success,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });

                        // form.reset(); // uncomment if you want reset
                    } else {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: data.failure,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }



                } catch (error) {
                    console.error('Error:', error);
                    alert('Something went wrong, please try again.');
                }
            });


        </script>
    @endpush