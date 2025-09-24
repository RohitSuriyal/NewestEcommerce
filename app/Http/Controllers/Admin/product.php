<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\ProductCategory;
use Illuminate\Http\Request;

class product extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
    echo("fsdfsdf");
        return view('Admin.product.index');
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


        if ($request->file('images')) 
        {
           
            

            foreach ($request->file('images') as $image) {
                // Use original filename directly
                $filename = $image->getClientOriginalName();

                // Move the file to public/images
                $image->move(public_path('images'), $filename);

                // Optional: save filenames in an array
                // $filenames[] = $filename;
            }
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
        //
    }
}
