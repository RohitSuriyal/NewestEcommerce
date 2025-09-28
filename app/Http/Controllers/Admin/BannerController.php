<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $allbanners = Banner::paginate(3);

        return view("Admin.banner.index", compact('allbanners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.banner.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {

            $validate = $request->validate([
                "name" => "required",
                "main_image" => "required",


            ]);

            if ($request->hasFile("main_image")) {

                $image = $request->file('main_image');
                $name = $image->getClientOriginalName();

                $image->move(public_path('images'), $name);
            }

            $validate['main_image'] = $name;


            Banner::create($validate);


            return redirect()->route("admin.banner.index")->with(['success' => 'data added successfully']);
        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput();
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

        try {

            $banner = Banner::findOrFail($id);


            if ($banner) {

                return view("admin.banner.edit", compact('banner'));
            }
        } catch (Exception $e) {

            return back()->with(["error" => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        try {

            $banner = Banner::findOrFail($id);
            $validate = $request->validate([

                "name" => "required",
                "main_image" => "",
            ]);

            if ($request->hasFile('main_image')) {



                $image = $request->file('main_image');
                $name = $image->getClientOriginalName();
                $image->move(public_path('images'), $name);
                $validate["main_image"] = $name;

                $banner->update($validate);
            } else {


                $validate["main_image"] = $banner->main_image;

                $banner->update($validate);
            }

            return redirect()->route("admin.banner.index")->with([
                "success" => "Banner updated Sccessfully"
            ]);
        } catch (Exception $e) {


            return back()->with(["error" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $banner = Banner::findOrFail($id);

            if ($banner) {


                $banner->delete();

                return response()->json([
                    "success" => "Banner deleted Successfully"
                ]);
            }
        } catch (Exception $e) {
            return response([

                "error"=>$e->getMessage(),
            ]);
        }
    }
    public function searchbanner(Request $request)
    {

        $search = $request->searchValue;

        if ($search != null) {
            $items = Banner::where('name', 'like', "{$search}%")->paginate(3);
            // Optional: headers and actions
            $headers = ["S.no", "name",  "image"];
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

            $html = view('components.admin.bannertable', compact('items', 'headers', 'actions'))->render();
        } else {

            $items = Banner::paginate(3);
            // Optional: headers and actions
            $headers = ["S.no", "name", "image"];
            $actions = [
                [
                    'label' => 'Edit',
                    'link' => fn($item) => route('admin.banner.edit', $item->id),
                    'class' => 'warning'
                ],
                [
                    'label' => 'Delete',
                    'link' => fn($item) => route('admin.banner.destroy', $item->id),
                    'class' => 'danger'
                ]
            ];

            $html = view('components.admin.bannertable', compact('items', 'headers', 'actions'))->render();
        }



        return response()->json(['html' => $html]);
    }
}
