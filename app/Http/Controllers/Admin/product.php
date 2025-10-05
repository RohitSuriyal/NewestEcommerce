<?php

namespace App\Http\Controllers\Admin;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Product as ModelsAdminProduct;
use App\Models\Admin\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Product extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $products = ModelsAdminProduct::paginate(3);

        return view('Admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view('Admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {

            $validate = $request->validate([
                "name" => "required",
                "price" => "required",
                "rating" => "required|numeric|min:0|max:5",
                "category_id" => "required",
                "brand_id" => "required",
                "description" => "required",
                "quantity" => "required",
                "images" => "required",
                'main_image' => "required",
                "images.*" => "image|mimes:jpeg,png,jpg,gif,webp|max:2048" // validate each file

            ]);


            if ($request->hasFile('main_image')) {

                $main_image = $request->file('main_image');
                $main_image_name = $main_image->getClientOriginalName();
                $main_image->move(public_path('images'), $main_image_name);
            }


            if ($request->file('images')) {

                $filenames = []; // Initialize an array to hold filenames

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        // Use original filename directly
                        $filename = $image->getClientOriginalName();

                        // Move the file to public/images
                        $image->move(public_path('images'), $filename);

                        // Add filename to the array
                        $filenames[] = $filename;
                    }
                }

                // Convert array to JSON
                $images_json = json_encode($filenames);
                $validate['image'] = $images_json;
                $validate['main_image'] = $main_image_name;

                ModelsAdminProduct::create($validate);

                return redirect()->route('admin.product.index')->with(["success" => "Product added Successfully"]);
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $product = ModelsAdminProduct::where("id", $id)->first();
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view("admin.product.edit", compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        try {

            $product = ModelsAdminProduct::findOrFail($id);

            $validate = $request->validate([
                "name" => "required",
                "price" => "required",
                "rating" => "required|numeric|min:0|max:5",
                "category_id" => "required",
                "brand_id" => "required",
                "description" => "required",
                "quantity" => "required",
                "images" => "",
                'main_image' => "",
                "images.*" => "image|mimes:jpeg,png,jpg,gif,webp|max:2048" // validate each file

            ]);

            if ($request->hasFile('main_image')) 
            {
                $main_image = $request->file('main_image');
                $main_image_name = $main_image->getClientOriginalName();
                $main_image->move(public_path('images'), $main_image_name);
            } else 
            {
                $main_image_name = $product->main_image;
            }

            $filenames = [];


           
            if ($request->file('images')) {

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        // Use original filename directly
                        $filename = $image->getClientOriginalName();

                        // Move the file to public/images
                        $image->move(public_path('images'), $filename);

                        // Add filename to the array
                        $filenames[] = $filename;
                    }
                }

                $existing_images_array = $request->existing_images;

                if (!empty($existing_images_array)) 
                {
                    foreach ($existing_images_array as $existingimage) {
                        if ($existingimage != null) {
                            array_push($filenames, $existingimage);
                        }
                    }
                }
            } else 
            {


                $existing_images_array = $request->existing_images;

                if (!empty($existing_images_array)) {
                    foreach ($existing_images_array as $existingimage) {
                        if ($existingimage != null) {
                            array_push($filenames, $existingimage);
                        }
                    }
                }
            }


            // Convert array to JSON
            $images_json = json_encode($filenames);
            $validate['image'] = $images_json;
            $validate['main_image'] = $main_image_name;
            $product->update($validate);
            return redirect()->route('admin.product.index')->with(["success" => "Product Updated Successfully"]);
        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {

            return back()->with(["error" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try{

            $product=ModelsAdminProduct::findOrFail($id);

            if($product){

                $product->delete();
            }
           return response()->json([
            "status"=>'true'
           ]);

        }catch(Exception $e){

            return back()->with(['error'=>$e->getMessage()]);

        }

    }
    public function searchproducts(Request $request)
    {

        $search = $request->searchValue;

        if ($search != null) {
            $items = ModelsAdminProduct::where('name', 'like', "{$search}%")->paginate(3);
            // Optional: headers and actions
            $headers = ["S.no", "name", "price", "rating", "brand", "category", "image"];
            $actions = [
                [
                    'label' => 'Edit',
                    'link' => fn($item) => route('admin.product.edit', $item->id),
                    'class' => 'warning'
                ],
                [
                    'label' => 'Delete',
                    'link' => fn($item) => route('admin.product.destroy', $item->id),
                    'class' => 'danger'
                ]
            ];

            $html = view('components.admin.producttable', compact('items', 'headers', 'actions'))->render();
        } else {

            $items = ModelsAdminProduct::paginate(3);
            // Optional: headers and actions
            $headers = ["S.no", "name", "price", "rating", "brand", "category", "image"];
            $actions = [
                [
                    'label' => 'Edit',
                    'link' => fn($item) => route('admin.product.edit', $item->id),
                    'class' => 'warning'
                ],
                [
                    'label' => 'Delete',
                    'link' => fn($item) => route('admin.product.destroy', $item->id),
                    'class' => 'danger'
                ]
            ];

            $html = view('components.admin.producttable', compact('items', 'headers', 'actions'))->render();
        }



        return response()->json(['html' => $html]);
    }
}
