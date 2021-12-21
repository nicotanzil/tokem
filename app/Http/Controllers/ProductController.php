<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index() {
        $products = Product::paginate(12);
        
        return view('products')->with('products', $products);
    }

    public function search(Request $request) {
        $keyword = $request->search;

        $products = Product::where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('description', 'like', '%'.$keyword.'%')
                    ->paginate(12);

        if(strlen($keyword) <= 0) {
            return redirect('/products');
        }
        $products->withPath('/products/search?search='.$keyword);
        return view('products')->with('products', $products)->with('keyword', $keyword);
    }

    public function addProductView(Request $request) {
        $categories = Category::all();
        
        return view('product.add')->with('categories', $categories);
    }

    public function updateProductView(Request $request, $id) {
        $product = Product::find($id);
        
        return view('product.update')->with('product', $product);
    }

    public function create(Request $request) {

        $rules = [
            'image' => 'required|mimes:jpg,jpeg,png',
            'name' => 'required|min:5',
            'description' => 'required|between:15,500',
            'price' => 'required|numeric|between:1000,10000000',
            'quantity' => 'required|numeric|between:1,10000',
            'category_id' => 'required|exists:App\Models\Category,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            // dd($validator->errors());
            // $imageErrors = $validator->errors()->messages()["image"];
            // if($imageErrors) {
            //     echo "<script>alert('$imageErrors[0]')</script>";
            // }
            return back()->withErrors($validator);
        } 
        
        $file = $request->file('image');

        $imageName = time().'.'.$file->getClientOriginalExtension();
        Storage::putFileAs('public/images', $file, $imageName);
        $imageName = 'images/'.$imageName;

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->image = $imageName;

        $product->save();

        return redirect()->route('products')->with('success', $product->name . ' has been inserted!');
    }

    public function update(Request $request) {

        $rules = [
            'description' => 'required|between:15,500',
            'price' => 'required|numeric|between:1000,10000000',
            'quantity' => 'required|numeric|between:1,10000',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return back()->withErrors($validator);
        } 

        $file = $request->file('image');
        $product = Product::find($request->id);

        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        
        if($file != null) {
            $imageName = time().'.'.$file->getClientOriginalExtension();

            Storage::putFileAs('public/images', $file, $imageName);

            $imageName = 'images/'.$imageName;

            // Delete the previous image
            Storage::delete('public/'.$product->image);

            $product->image = $imageName;
        }

        $product->save();
        
        return redirect()->route('products')->with('success', $product->name . ' has been updated!');
    }

    public function destroy(Request $request) {
        $product = Product::find($request->id);

        if(isset($product)) {
            Storage::delete('public/'. $product->image);
            $product->delete();

            // echo "<script>alert('Item Removed!')</script>";
        }

        return redirect()->back()->with('item_removed', 'Item Removed!');
    }

    public function detail(Request $request) {
        $product = Product::find($request->id);

        if(!$product) {
            return redirect()->back();
        }

        return view('product.detail')->with('product', $product);
    }
    
}
