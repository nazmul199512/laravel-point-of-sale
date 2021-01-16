@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="background: #008B8B; color: #fff"><marquee behavior="" direction="">
                       <h2>WELCOME TO POS MANAGEMENT SYSTEM</h2>  </marquee></div>
                <div class="card-body">

                        <div class="card-body">
                            @if(session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status')}}
                                </div>
                             @endif
                        </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">   {{__('Dashboard')}}</div>
                    <div class="card-body"></div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
