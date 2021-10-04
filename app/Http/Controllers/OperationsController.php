<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Exception;

class OperationsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.category');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryData = Category::get();
        return view('category.manage_categories', compact('categoryData'));
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
            'name' => 'required|min:3|unique:category',
                'user_img' => 'required|image|mimes:jpeg,png,jpg|dimensions:max_width=150,max_height=150',
                ], [
                    'name.required'    => 'Please Provide Your Name, Thank You.',
                    'user_img.required' => 'Choose Image As Jpg/Png With Dimension 150*150, Thank You.',
        ]);


          try {
        $fileName = time().'.'.$request->user_img->extension();
            $request->user_img->move(public_path('uploads/'), $fileName);
            $offerimg ='uploads/'.$fileName;

        $Category = new Category();
        $Category->name = $request->name;
        $Category->user_img = $offerimg;

        $Category->save();

        $cat_id = $Category->id;

        $SubCategory = new SubCategory();
        $SubCategory->category_id = $cat_id;
        $SubCategory->sub_category_name = $request->sub_category_name;

        $SubCategory->save();

        return back()->with('success','Stored successfully');
    }

    catch (Exception $e) {
        return back()->with('error', $e->getMessage());
    }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail(decrypt($id));
        $cat_id = $category->id;
        $sub_category = SubCategory::where('category_id', $cat_id)->first();
        // echo $sub_category;die;
        return view('category.edit_category', compact('category','sub_category'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $sub_category_name = $request->sub_category_name;
        if($request->file('user_img')!=''){
            $fileName = time().'.'.$request->user_img->extension();
            $request->user_img->move(public_path('uploads/'), $fileName);
            $blog_thumbimage1 ='uploads/'.$fileName;

            $update_blogg_data = Category::where('id', $id)->update(['name' => $name, 'user_img' => $blog_thumbimage1]);
            $update_sub_data = SubCategory::where('category_id', $id)->update(['sub_category_name' => $sub_category_name]);
           }
           else {
            $update_bloggs_data = Category::where('id', $id)->update(['name' => $name]);
            $update_subb_data = SubCategory::where('category_id', $id)->update(['sub_category_name' => $sub_category_name]);


           }

               return redirect()->route('category.create');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail(decrypt($id));
        // echo json_encode($category);die;
        Category::where('id', $category->id)->delete();
        SubCategory::where('category_id', $category->id)->delete();
        return redirect()->route('category.create');

    }
}
