<div class="col-md-12">

    <div class="row">
        <div class="col-md-8">
            <div class="card">


                <div class="card-header"><h4 style="float: left">Order Products</h4> <a style="float: right"
                                                                                        class="btn btn-dark"
                                                                                        data-toggle="modal"
                                                                                        data-target="#addproduct"
                                                                                        href="#">
                        <i class="fa fa-plus"> </i> Add New Products</a></div>


                <div class="card-body">

                    <div class="my-2">

                        <form wire:submit.prevent="insertToCart">
                            <input type="text" name="" wire:model="product_code"
                                   id="" class="form-control" placeholder="Enter Product code">
                        </form>
                    </div>
                    @if($message)
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif

                    @if(session()->has('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif


                    <table class="table table-bordered table-left cart-table">
                        @if($productInCart)
                            <thead>
                            <tr>
                                <th></th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Dis(%)</th>
                                <th>Total</th>
                                <th><a href="#" class="btn btn-sm btn-success add_more rounded-circle"><i
                                            class="fa fa-plus"></i></a></th>

                            </tr>
                            </thead>
                        @endif
                        <tbody class="addMoreProduct">

                        @foreach($productInCart as $key=> $cart )

                            <tr>
                                <td class="no">{{ $key+1 }}</td>
                                <td width="25%">
                                    <input type="text" class="form-control" value="{{$cart->product->product_name}}">
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <button wire:click.prevent="decrement_qty({{ $cart->id }})"
                                                    class="btn btn-sm btn-danger"> -
                                            </button>
                                        </div>


                                        <div class="col-md-1">
                                            <label for="">{{ $cart->product_qty }}</label>
                                        </div>

                                        <div class="col-md-2">
                                            <button wire:click.prevent="increment_qty({{ $cart->id }})"
                                                    class="btn btn-sm btn-success"> +
                                            </button>
                                        </div>


                                    </div>
                                </td>

                                <td>
                                    <input type="number" value="{{$cart->product->price}}" class="form-control ">
                                </td>

                                <td>
                                    <input type="number" id="discount" class="form-control ">
                                </td>

                                <td>
                                    <input type="number" value="{{ $cart->product_qty * $cart->product->price  }}"
                                           class="form-control ">
                                </td>

                                <td>
                                    <a href="#" class="btn btn-sm btn-danger delete rounded-circle"><i
                                            class="fa fa-times" wire:click="removeProduct({{ $cart->id  }})"></i> </a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        {{--Total--}}


        <div class="col-md-4">
            <form action="{{route('orders.store')}}" method="POST">
                @csrf
                @foreach($productInCart as $key=> $cart )




                    <input type="hidden" class="form-control" name="product_id[]"
                           value="{{$cart->product->id}}">

                    <div class="col-md-1">
                        <input type="hidden" name="quantity[]" value="{{ $cart->product_qty }}">
                    </div>

                    <input type="hidden" name="price[]" value="{{$cart->product->price}}" class="form-control ">

                    <input type="hidden" name="discount[]" class="form-control discount ">

                    <input type="hidden" name="total_amount[]" value="{{ $cart->product_qty * $cart->product->price  }}"
                           class="form-control ">

                @endforeach

                <div class="card">
                    <div class="card-header"><h4> Total <b class="total"
                                                           name="total_amount">{{ $productInCart->sum('product_price') }}</b>
                        </h4></div>
                    <div class="card-body">
                        <div class="btn-group">
                            <button type="button" onclick="printReceipt('print')"
                                    class="btn btn-dark"><i class="fa fa-print"></i> Print
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" onclick="printReceipt('print')"
                                    class="btn btn-primary"><i class="fa fa-print"></i> History
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" onclick="printReceipt('print')"
                                    class="btn btn-danger"><i class="fa fa-print"></i> Report
                            </button>
                        </div>

                        <div class="panel">
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <td>
                                            <label for="">Customer Name</label>

                                            <input type="text" name="customer_name" id="" class="form-control">


                                        </td>
                                        <td>
                                            <label for="">Customer Phone</label>

                                            <input type="number" name="customer_phone" id="" class="form-control">


                                        </td>
                                    </tr>
                                </table>
                                {{--Payment Area--}}


                                <td>
                                    <div style="display: inline-block; width: 100%"> Payment Method</div>
                                    <br>
                                    <span class="radio-item">
                                         <input type="radio" name="payment_method" id="payment_method"
                                                class="true" value="cash" checked="checked">
                                         <label for="payment_method"><i class="fa fa-money-bill text-success"> </i>Cash</label>
                                     </span>

                                    <span class="radio-item">
                                         <input type="radio" name="payment_method" id="payment_method"
                                                class="true" value="bank transfer">
                                         <label for="payment_method"><i class="fa fa-money-university text-danger"> </i>Bank Transfer</label>
                                      </span>

                                    <span class="radio-item">
                                         <input type="radio" name="payment_method" id="payment_method"
                                                class="true" value="credit Card">
                                         <label for="d"><i class="fa fa-credit-card text-info"> </i>Credit Card</label>
                                      </span>

                                </td>
                                <br>


                                <div style="display: inline-block; width: 100%">
                                    <td>
                                        Payment
                                        <input type="number" name="paid amount" id="paid_amount" class="form-control">
                                    </td>

                                    <td>
                                        Returning Change
                                        <input type="number" readonly name="balance" id="balance" class="form-control">
                                    </td>


                                    <button class="btn-primary btn-lg btn-block mt-3">Save</button>
                                    <button class="btn-danger btn-lg btn-block mt-2">Calculator</button>

                                    <div class="text-center">
                                        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> </a>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>


    </div>

</div>


{{-- Modal of adding new Product --}}

<!-- Modal -->
<div class="modal right fade" id="addproduct" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="" class="form-control">

                    </div>


                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Alert Stock</label>
                        <input type="number" name="alert_stock" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
                    </div>


                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">Save Product</button>
                    </div>


                </form>

            </div>

        </div>
    </div>
</div>
