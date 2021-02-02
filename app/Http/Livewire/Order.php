<?php

namespace App\Http\Livewire;

use App\Cart;
use App\Product;
use Livewire\Component;

class Order extends Component
{
    public $orders, $products = [], $product_code, $message='', $productInCart;

    public function mount()
    {
        $this->products = Product::all();
        $this->productInCart = Cart::all();
    }

    /**
     * Insert items to cart
     * @return string
     */
    public function insertToCart(){
        $countProduct = Product::where('id', $this->product_code)->first();
        if(!$countProduct){
            return $this->message= 'Product Not Found';
        }

        $countCartProduct = Cart::where('product_id', $this->product_code)->count();

        if($countCartProduct > 0){
            return $this->message = $countProduct->product_name .' already exist in cart ';
        }

        $add_to_cart = new Cart;
        $add_to_cart-> product_id = $countProduct->id;
        $add_to_cart-> product_qty = 1;
        $add_to_cart-> product_price = $countProduct->price;
        $add_to_cart-> user_id = auth()->user()->id;
        $add_to_cart->save();

        $this->productInCart->prepend($add_to_cart);
        $this->product_code = '';

        return $this->message = 'Product Added Successfully!';
    }

    /**
     * Increment quantity from cart
     * @param $cartId
     */
    public function increment_qty($cartId)
    {
        $carts = Cart::find($cartId);
        $carts->increment('product_qty', 1);
        $update_price = $carts->product_qty * $carts->product->price;

        $carts->update(['product_price' => $update_price]);

    }

    /**
     * Decrement quantity from cart
     * @param $cartId
     */
    public function decrement_qty($cartId)
    {
        $carts = Cart::find($cartId);
        if($carts->product_qty == 1){
            return session()->flash('info', ''.$carts->product->product_name . ' Quantity can not be less than 1  ');
        }
        $carts->decrement('product_qty', 1);
        $update_price = $carts->product_qty * $carts->product->price;
        $carts->update(['product_price' =>$update_price]);
    }

    /**
     * Remove a product from cart
     * @param $cartId
     */
    public function removeProduct($cartId)
    {
        $deleteCart = Cart::find($cartId);
        $deleteCart->delete();

        $this->message = 'Product removed from cart';

        $this->productInCart = $this->productInCart->except($cartId);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.order');
    }
}
