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

       // dd($countProduct);
    }

    public function removeProduct($cartId)
    {
        $deleteCart = Cart::find($cartId);
        $deleteCart->delete();

        $this->message = 'Product removed from cart';

        $this->productInCart = $this->productInCart->except($cartId);
    }

    public function render()
    {
        return view('livewire.order');
    }
}
