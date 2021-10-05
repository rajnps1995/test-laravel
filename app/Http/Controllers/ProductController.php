<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator, Redirect, Response;
use Exception;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categor_data = Category::all();
        return view('product.product', compact('categor_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productData = Product::get();
        return view('product.manage_products', compact('productData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:product',
            'description' => 'required|min:3',
            'user_img' => 'required|image|mimes:jpeg,png,jpg|dimensions:max_width=150,max_height=150',
        ], [
            'name.required'    => 'Please Provide Your Name, Thank You.',
            'user_img.required' => 'Choose Image As Jpg/Png With Dimension 150*150, Thank You.',
        ]);


        try {
            $fileName = time() . '.' . $request->user_img->extension();
            $request->user_img->move(public_path('uploads/'), $fileName);
            $offerimg = 'uploads/' . $fileName;

            $Product = new Product();
            $Product->name = $request->name;
            $Product->cat_id = $request->cat_id;
            $Product->description = $request->description;
            $Product->user_img = $offerimg;

            $Product->save();

            $cat_name = Category::where('id', $Product->cat_id)->first();
            $categoyName = $cat_name->name;

            $todayDate = Carbon::now();
            $myNewDate = date("m/d/Y", strtotime($todayDate));

            $details = [
                'product_name' => $Product->name,
                'category_name' => $categoyName,
                'date' => $myNewDate
            ];

            \Mail::to('applocumadmin@yopmail.com')->send(new MyMail($details));

            return back()->with('success', 'Stored successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail(decrypt($id));
        return view('product.edit_product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $description = $request->description;
        $cat_id = $request->cat_id;
        if ($request->file('user_img') != '') {
            $fileName = time() . '.' . $request->user_img->extension();
            $request->user_img->move(public_path('uploads/'), $fileName);
            $blog_thumbimage1 = 'uploads/' . $fileName;

            $update_product_data = Product::where('id', $id)->update(['name' => $name, 'description' => $description, 'cat_id' => $cat_id, 'user_img' => $blog_thumbimage1]);
        } else {
            $update_product_data = Product::where('id', $id)->update(['name' => $name, 'description' => $description, 'cat_id' => $cat_id]);
        }

        return redirect()->route('products.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail(decrypt($id));
        Product::where('id', $product->id)->delete();
        return redirect()->route('products.create');
    }
}
