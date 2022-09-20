@extends('layouts.app')

@section('content')



    @vite(['resources/css/Catalog.css'])



<div class="container">
    <div class="">
    @foreach ($products as $product)
        <div class="product-item">
            <a href="/products/{{ $product->id }}"><img src="{{ asset('storage/images/' . $product->img) }}"></a>
            <!-- <a href="/products/{{ $product->id }}"><img src="{{ $product->img }}"></a> -->
            <div class="product-list">
                <h3>{{ $product->name }}</h3>
                <span class="price">{{ $product->prize/100 }}$</span>
                <a href="/products/{{ $product->id }}"  class="button"> Description</a>
                &nbsp;
                &nbsp;
                @if(Auth::check())
                    <a href="{{ url('/makeOrder?OrderNum='. $product->id) }}" class="button">Make order</a>
                @else
                    <a href="{{ url('/login') }}" class="button">Login to order</a>
                @endif
            </div>
        </div>
    @endforeach
    </div>

</div>

@endsection

