<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $productcategories = ProductCategory::paginate(3);

        return view('Admin.product.productcategory.index', compact('productcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Admin.product.productcategory.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $validate = $request->validate([
                "name" => "required",


            ]);

            ProductCategory::create($validate);

            return redirect()->route("admin.productcategory.index")->with(["success" => "Category Added successfully"]);
        } catch (Exception $e) {

            return back()->with(["error" => $e->getMessage()]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            
            $category = ProductCategory::findOrFail($id);

            if($category){

                $category->delete();
            }
            session()->flash("success","category deleted successfully");

            return response()->json([
                "success"=>true,
            ]);

            
        } catch (Exception $e) {

         return redirect()->route("admin.productcategory.index")->with(["error"=>$e->getMessage()]);

        }


        if ($category) {

            $category->delete();
        }
    }

    public function searchproductcategory(Request $request)
    {
        $search = $request->searchValue;

        if ($search != null) {
            $items = ProductCategory::where('name', 'like', "{$search}%")->paginate(3);
            // Optional: headers and actions
            $headers = ['ID', 'Name', 'Created At'];
            $actions = [
                [
                    'label' => 'Edit',
                    'link' => fn($item) => route('admin.productcategory.edit', $item->id),
                    'class' => 'warning'
                ],
                [
                    'label' => 'Delete',
                    'link' => fn($item) => route('admin.productcategory.destroy', $item->id),
                    'class' => 'danger'
                ]
            ];

            $html = view('components.admin.table', compact('items', 'headers', 'actions'))->render();
        } else {
            $items = ProductCategory::paginate(3);
            // Optional: headers and actions
            $headers = ['ID', 'Name', 'Created At'];
            $actions = [
                [
                    'label' => 'Edit',
                    'link' => fn($item) => route('admin.productcategory.edit', $item->id),
                    'class' => 'warning'
                ],
                [
                    'label' => 'Delete',
                    'link' => fn($item) => route('admin.productcategory.destroy', $item->id),
                    'class' => 'danger'
                ]
            ];

            $html = view('components.admin.table', data: compact('items', 'headers', 'actions'))->render();
        }

        return response()->json(['html' => $html]);
    }
}
