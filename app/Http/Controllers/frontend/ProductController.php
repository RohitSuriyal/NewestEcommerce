<?php

namespace App\Http\Controllers\frontend;

use App\Events\Eventmail;
use App\Http\Controllers\Controller;
use App\Models\admin\product;
use App\Models\CustomerAddress;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{


    public function allproduct(string $id)
    {
        $selectedProduct = Product::find($id);
        $allProducts = Product::where('id', '!=', $id)->get();

        //this is the product

        



        // Put the selected product at the start
        $allProducts->prepend($selectedProduct);

        return view('frontend.allproducts', compact('allProducts'));
    }

    public function singleproduct(string $id)
    {

        $product = product::where("id", $id)->first();

        $product_id = $product->category->id;

        $related_product = product::where("category_id", $product_id)->get();


        return view("frontend.singleproduct", compact('product', 'related_product'));
    }
    public function buynowlogin($id)
    {

        


        $product=product::where("id",$id)->first();

        $user = Auth::guard('web')->check();

        if ($user) 
        {
            $user_id=auth::guard('web')->user()->id;
            $userdetails=User::join('customer_addresses','users.id','=','customer_addresses.customer_id')
             ->where('users.id', $user_id)
            ->first(); 
        
        } else 
        {
            $userdetails = "";
        }

        return view('frontend.buynowlogin', compact('userdetails','product'));
    }

    public function emialverify(Request $request)
    {

        try {

            if ($request->otp != null) {


                $user = User::where("email", $request->email)->first();

                if ($user->otp == $request->otp) 
                {
                    auth()->guard('web')->login($user); // runtime works

                    return response()->json([
                        "success" => "otp mathced successfully",
                    ]);

                } else 
                {

                    return response()->json([
                        "failure" => "The Entered otp is wrong",
                    ]);
                }
            } elseif ($request->email) 
            {

                $user = User::where("email", $request->email)->first();

                // Generate OTP
                $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

                if ($user) 
                {

                    // If user exists, update OTP
                    $user->otp = $otp;
                    $user->save();

                    Eventmail::dispatch($user, $otp);

                } else {
                    // If user does not exist, create new one
                    $user = User::create([
                        "email" => $request->email,
                        "otp"   => $otp,
                    ]);

                    Eventmail::dispatch($user, $otp);
                }

                return response()->json([
                    "success" => "Email sent successfully",
                ]);
            }
        } catch (Exception $e) {
           
            return back()->with(["error" => "Something Went Wrong...!!!", "details" => $e->getMessage()]);
        }
    }

    public function saveuseraddress(Request $request)
    {
        try {

            $validate = $request->validate([

                "name" => "required",
                "mobile_no" => "required",
                "pincode" => "required",
                "locality" => "required",
                "address" => "required",
                "city" => "required",
                "state" => "required",
                "landmark" => "required",
                "alternate_number" => "required",
            ]);
            


            $validate['customer_id'] = auth()->guard('web')->user()->id;

            CustomerAddress::create($validate);

            return back()->with("success", "Address added successfully");
        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {

            dd($e->getMessage());

            return back()->with(["error" => $e->getMessage()]);
        }
    }
}
