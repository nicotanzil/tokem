<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request) {
        $id = Auth::user()->id;
        
        $cart = Cart::where('user_id', $id)->first();

        if(is_null($cart)){
            return view('cart/cart')
                ->with('cartProducts', collect([]))
                ->with('total', 0);
        }
        
        $cartProducts = DB::table('cart_products')
        ->join('products', 'cart_products.product_id', '=', 'products.id')
        ->where('cart_products.cart_id', $cart->id)
        ->select('cart_products.*', 'products.name', 'products.price', 'products.image')
        ->get();

        // dd($cartProducts);

        $total = 0;

        foreach ($cartProducts as $cartProduct) {
            $total += $cartProduct->price * $cartProduct->quantity;
        }

        return view('cart/cart')->with('cartProducts', $cartProducts)->with('total', $total);
    }

    public function updateCart(Request $request) {
        $id = Auth::user()->id;

        $cart = Cart::where('user_id', $id)->first();
        $product = Product::find($request->productId);

        $cartProduct = CartProduct::where('product_id', $request->productId)
        ->where('cart_id', $cart->id)
        ->first();

        if($request->quantity > $product->quantity) {
            // Error
            return redirect()->back()->withErrors(['quantity' => 'Quantity exceed product stock!']);
        }

        if($request->quantity <= 0) {
            // Delete
            $cartProduct->delete();
            return redirect()->back();
        }

        // Update 
        $cartProduct->quantity = $request->quantity;
        $cartProduct->save();
        
        return redirect()->back();
    }

    public function addCart(Request $request) {

        if(!Auth::check()) {
            // echo "<script>alert('Please sign in to add to cart')</script>";
            
            return redirect()->route('login')->with('cart_must_login', 'Please sign in to add to cart');
        }
        
        $id = Auth::user()->id;

        if($request->quantity < 1) {
            return redirect()->back()->withErrors(['quantity' => 'Quantity cannot be less than 1']);
        }

        $product = Product::find($request->productId);

        $cart = Cart::where('user_id', $id)->first();

        if(!$cart) {
            // Cart not exist for this user 
            // create a new one

            $cart = new Cart();
            $cart->user_id = $id;

            $cart->save();
        }

        // Get the cart product if exists
        $cartProduct = CartProduct::where('product_id', $request->productId)
        ->where('cart_id', $cart->id)
        ->first();
        
        // Validate whether the cart product already exists and its quantity is valid
        if(!$cartProduct && $request->quantity <= $product->quantity) {
            // Create new
            $cartProduct = new CartProduct();
            $cartProduct->cart_id = $cart->id;
            $cartProduct->product_id = $product->id;
            $cartProduct->quantity = $request->quantity;
        }
        // Add to existing cart
        else if($cartProduct->quantity + $request->quantity <= $product->quantity) {
            $cartProduct->quantity = $cartProduct->quantity + $request->quantity;
        }

        $cartProduct->save();

        // echo "<script>alert('Product added to cart!')</script>";
        
        return redirect()->back()->with('add_product', 'Product added to cart!');
        
    }
}
