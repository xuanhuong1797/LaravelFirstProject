<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\Product\CreateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ImageProduct;
use App\Models\User;
use App\Models\Comment;
use App\Models\Love;
use App\Models\Rating;
use App\Models\Province;
use App\Models\Category;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('index', 'show', 'search');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincies = Province::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view('products.create', compact(['categories', 'provincies']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $product = Product::create(
            array_merge(
                $request->all(),
                [
                    'user_id' => $request->user()->id,
                ]
            )
        );

        $product->address()->create([
            'address' => $request->address,
            'ward_id' => $request->ward_id,
        ]);

        foreach ($request->images as $image) {
            $imagePath = $image->store('products', 'uploads');
            $url = $imagePath;
            ImageProduct::create([
                'product_id' => $product->id,
                'image_url' => $url,
            ]);
        }

        return redirect()->route('product.create')->with('messenger', 'Create Product Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product == null) {
            abort(404, 'Page not found');
        }
        if (!$product->published) {
            if (Auth::check()) {
                if (!Auth::user()->can('publish products') || !Auth::user()->can('unpublish products')) {
                    if (Auth::user()->id != $product->user_id) {
                        abort(404, 'Page not found');
                    }
                }
            } else {
                abort(404, 'Page not found');
            }
        }
        $rating = Rating::findProduct($product->id)->selectRaw('value,count(*) AS count')->groupBy('value')->get();
        //Load image of product
        $images = ImageProduct::findProduct($product->id)->get();
        //Load product creator product
        $user = User::where('id', $product->user_id)->first();
        $comments = null;
        $userComment = null;
        if (Auth::check()) {
            //Load other comments
            $comments = Comment::findProduct($product->id)->where('user_id', '!=', Auth::user()->id)->with(['user', 'rating'])->latest()->get();
            //Load Current user comment
            $userComment = Comment::findProduct($product->id)->findByUser(Auth::user()->id)->with(['user', 'rating'])->first();
        } else {
            //Load other comments
            $comments = Comment::findProduct($product->id)->with('user')->latest()->get();
        }
        if (!$userComment) {
            return view('products.show', compact(['product', 'images', 'user', 'comments', 'rating']));
        } else {
            return view('products.show', compact(['product', 'images', 'user', 'comments', 'userComment', 'rating']));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $input = $request->except(['_token', '_method']);
        $product->fill($input);
        $product->save();

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product = Product::find($request->id)->delete();
    }

    public function publish(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product->published) {
            $product->published = false;
        } else {
            $product->published = true;
        }
        $product->save();

        return $product;
    }

    public function addLove(Request $request)
    {
        $idProduct = $request->id;

        $product = Product::find($idProduct);
        if (!$product) {
            return null;
        }
        $user = Auth::user();
        $love = $user->love()->where('product_id', $idProduct)->first();
        if ($love) {
            if ($love->loved) {
                $love->loved = false;
                $product->love -= 1;
            } else {
                $love->loved = true;
                $product->love += 1;
            }
        } else {
            $love = new Love();
            $love->user_id = $user->id;
            $love->product_id = $idProduct;
            $product->love += 1;
        }
        $love->save();
        $product->save();

        return $product->love;
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::published()->where('name', 'LIKE', "{$request->data}%")->get();

            return json_encode($product, JSON_UNESCAPED_UNICODE);
        }
    }

    public function adminCreate()
    {
        $users = User::all();

        return view('admins.product.create', compact(['users']));
    }

    public function adminStore(Request $request)
    {
        $product = Product::create(array_merge($request->except('_token')));
        foreach ($request->images as $image) {
            $imagePath = $image->store('products', 'uploads');
            $url = $imagePath;
            ImageProduct::create([
                'product_id' => $product->id,
                'image_url' => $url,
            ]);

            return redirect()->route('admin.product')->with('messenger', 'Create Product Successed!!!');
        }
    }

    public function adminEdit($id)
    {
        $product = Product::findOrFail($id);

        return view('admins.product.edit', compact(['product']));
    }

    public function adminUpdate(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $input = $request->except(['_token', '_method']);
        $product->fill($input);
        $product->save();

        return redirect()->route('admin.product')->with('messenger', 'Edit Product Successed!!!');
    }
}
