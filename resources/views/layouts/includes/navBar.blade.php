<a href="" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-outline rounded-pill"><i
        class="fa fa-list"> </i></a>

<a href="{{ route('users.index') }}" class="btn btn-outline rounded-pill"><i class="fa fa-user"> </i> Users</a>
<a href="{{route('products.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-box"> </i> Products</a>
<a href="{{route('orders.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-laptop"></i> Cashier</a>
<a href="{{route('orders.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-file"></i> Report</a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-money-bill"></i> Transactions</a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-chart"></i> Supplier</a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-users"></i>Customers</a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-chart"></i> Incoming </a>


<style>
    .btn-outline {
        border-color: #008B8B;
        color: #008B8B;
    }

    .btn-outline:hover {
        background: #008B8B;
        color: #fff;
    }

    .rounded-pill {
        margin: 0 2px;
    }
</style>
