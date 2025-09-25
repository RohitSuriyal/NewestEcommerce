<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Exception;
use Illuminate\Http\Request;

class ProductBrand extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Brands = Brand::paginate(3);

        return view('Admin.product.productbrand.index', compact('Brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Admin.product.productbrand.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {

            //    $data=[
            //     "name"=>""
            //    ]
            $validated = $request->validate([

                "name" => "required"
            ]);

            Brand::create($validated);


            return redirect()->route("admin.productbrand.index")->with(["success" => "Brand Added Succesfully"]);
        } catch (Exception $e) {
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

        $brand = Brand::where("id", $id)->first();
        
        return view("Admin.product.productbrand.edit", compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {

        try {

            $brand = Brand::findOrFail($id);

            $validated = $request->validate([
                "name" => "required|string|max:255"
            ]);


            $brand->update($validated);

            return redirect()
                ->route("admin.productbrand.index")
                ->with("success", "Brand updated successfully!");
        } catch (Exception $e) {

            return redirect()->route('admin.productbrand.index')->with(['error' => $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {


            $Brand = Brand::findOrFail($id);

            if ($Brand) {
                $Brand->delete();
            }
            session()->flash('success', 'Data deleted successfully');

            return response()->json([

                "success" => "true",

            ]);
        } catch (Exception $e) {
            return redirect()->route('admin.productbrand.index')->with(["error" => $e->getMessage()]);
        }
    }
    public function searchbrand(Request $request)
    {
        $search = $request->searchValue;
        $success = session('success');
        $error = session('error');
        if ($search != null) {
            $items = Brand::where('name', 'like', "{$search}%")->paginate(3);
            // Optional: headers and actions
            $headers = ['ID', 'Name', 'Created At'];
            $actions = [
                [
                    'label' => 'Edit',
                    'link' => fn($item) => route('admin.productbrand.edit', $item->id),
                    'class' => 'warning'
                ],
                [
                    'label' => 'Delete',
                    'link' => fn($item) => route('admin.productbrand.destroy', $item->id),
                    'class' => 'danger'
                ]
            ];

            $html = view('components.admin.table', compact('items', 'headers', 'actions'))->render();
        } else {

            $items = Brand::paginate(3);
            // Optional: headers and actions
            $headers = ['ID', 'Name', 'Created At'];
            $actions = [
                [
                    'label' => 'Edit',
                    'link' => fn($item) => route('admin.productbrand.edit', $item->id),
                    'class' => 'warning'
                ],
                [
                    'label' => 'Delete',
                    'link' => fn($item) => route('admin.productbrand.destroy', $item->id),
                    'class' => 'danger'
                ]
            ];

            $html = view('components.admin.table', compact('items', 'headers', 'actions'))->render();
        }



        return response()->json(['html' => $html]);
    }
}
