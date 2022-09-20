@extends('layouts.app')

@section('content')





    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('My orders list') }}</div>
                    <div class="card-body">
                        @if(is_array($orders))
                        @foreach($orders as $order)

                        @endforeach
                        @elseif(isset($orders->id_user))\

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

