<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.category.create');
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
            'name' => 'required|string|max:255',
            'image' => 'required|mimes:jpeg,bmp,png|max:2000',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $imagePath = $request->image->store('categories', 'uploads');
        $url = $imagePath;
        $category->image_url = $url;
        $category->save();

        return redirect()->route('admin.category')->with('messenger', 'Create Category Successed!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category == null) {
            abort(404, 'Page not found');
        }
        $products = Product::published()->where('category_id', $category->id)->inRandomOrder()->paginate(10);

        return view('category', compact(['products']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admins.category.edit', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'image' => 'mimes:jpeg,bmp,png|max:2000',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        if ($request->image) {
            $imagePath = $request->image->store('categories', 'uploads');
            $url = '/' . $imagePath;
            $category->image_url = $url;
        }
        $category->save();

        return redirect()->route('admin.category')->with('messenger', 'Edit Category Successed!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id)->delete();
    }
}
