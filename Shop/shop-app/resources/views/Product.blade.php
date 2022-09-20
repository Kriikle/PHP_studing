@extends('layouts.app')

@section('content')


    <style>
        .vl {
            border-left: 6px solid green;
            height: 500px;
        }
    </style>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Product description') }}</div>

                    <div class="card-body">
                        <a href="/products">Back to list of goods</a>
                            <p>Product num: {{ $product->id }}   Product name: {{ $product->name }}
                                    Date added: {{$product->created_at}}</p>
                        <p> Categories:
                        @foreach ($categories as $category)
                                &nbsp; ||
                            <a href=" {{ url('api/Category/'.$category->id)  }}">{{ $category->name }}</a>
                                ||
                        @endforeach
                        </p>

                            <p>Prize: {{ $product->prize / 100 }}$</p>
                            <img src="{{ $product->img }}">
                        <p> Description: <br>
                            {{ $product->description }}
                        </p>
                            <hr>
                        @if (Auth::check())
                            <form method="post" >

                            </form>
                        <a href="{{ url('/makeOrder?OrderNum='. $product->id) }}"><button> Make order </button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

