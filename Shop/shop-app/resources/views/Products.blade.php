@extends('layouts.app')

@section('content')





<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Goods list') }}</div>
                <div class="card-body">

                    @foreach ($products as $product)
                        <p>Product num: {{ $product->id }}, Product name: {{ $product->name }}</p>
                        <p>Prize: {{ $product->prize / 100 }}$</p>
                        <img src="{{ $product->img }}" style="height: 127px;width: 200px">
                        <p><a href="/products/{{ $product->id  }}">Description</a></p>
                        <hr>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

