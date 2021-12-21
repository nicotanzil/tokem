<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Collection;


class CheckoutController extends Controller
{
    public function index(){
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

        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $code = substr(str_shuffle(str_repeat($pool, 5)), 0, 6);

        // config(['global.unique_code' => $code]);
        session()->put('unique_code', $code);

        return view('checkout.checkout')
            ->with('cartProducts', $cartProducts)
            ->with('total', $total)
            ->with('address', Auth::user()->address)
            ->with('code', $code);
    }

    public function store(Request $request){
        // dd(session()->get('unique_code'));
        
        $stored_code = session()->get('unique_code');
        $code = $request->code;

        if($code != session()->get('unique_code')){
            // dd("FAILED TO CHECKOUT", $code, $stored_code);
            return redirect('/checkout')->with('error-message', 'Passcode does not match')->withInput();
        }

        // Get All Product in Cart

        $id = Auth::user()->id;
        
        $cart = Cart::where('user_id', $id)->first();

        $cartProducts = DB::table('cart_products')
        ->join('products', 'cart_products.product_id', '=', 'products.id')
        ->where('cart_products.cart_id', $cart->id)
        ->select('cart_products.*', 'products.name', 'products.price', 'products.image', 'products.id')
        ->get();

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->date = now();
        $transaction->save();

        // dd($cartProducts);
        
        foreach($cartProducts as $product){
            $transaction_detail = new TransactionDetail(); 
            $transaction_detail->transaction_id = $transaction->id;
            $transaction_detail->product_id = $product->product_id;
            $transaction_detail->quantity = $product->quantity;
            $transaction_detail->save();
        }

        $cart = Cart::where('user_id', $id)->firstOrFail()->delete();

        return redirect('/')->with(['transaction_success' => "Transaction success! You will receive our products soon! Thank you for shopping with us!"]);
    }


    public function viewTransactions(){
        $id = Auth::user()->id;

        // $transactions = Transaction::where('user_id', $id)->get();
        $transactions = Transaction::get()->where('user_id', $id);
        // $transactions = Transaction::with(["transactions", "transaction_details" => function($q) use($id){
        //     $q->where('transactions.user_id', '=', $id);
        // }]);

        // dd($transactions);

        $list_transaction_id = new Collection();
        $list_transaction_date = new Collection();

        foreach($transactions as $transaction){
            // echo($transaction->id);
            $list_transaction_id->push($transaction->id);
            $list_transaction_date->push($transaction->date);
        }

        $list_products_per_transaction = new Collection(); 

        for($i = 0 ; $i < count($list_transaction_id) ; $i++){
            $products_in_transaction = DB::table('transaction_details')
                ->join('products', 'transaction_details.product_id', '=', 'products.id')
                // ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
                ->where('transaction_details.transaction_id', $list_transaction_id[$i])
                ->select('transaction_details.*', 'products.name', 'products.price','products.image', 'products.id')
                ->get();
            
            $total = 0 ;
            foreach($products_in_transaction as $product){
                $total += $product->price * $product->quantity;
            }
            $products_in_transaction['total'] = number_format($total, 2, '.', ',');
            $products_in_transaction['date'] = $list_transaction_date[$i];
            $list_products_per_transaction->push($products_in_transaction);
        }

        // dd($list_products_per_transaction);

        return view('transaction.transaction',[
            'list_products' => $list_products_per_transaction
        ]);
    }
}
