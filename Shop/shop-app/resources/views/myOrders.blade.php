@extends('layouts.app')

@section('content')
<style>

</style>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('My orders list') }}</div>
                    <div class="card-body">

                        <table style="width: 100%;min-width: 300px">
                            <tr>
                                <td>id
                                </td>
                                <td>Name product
                                </td>
                                <td>prize
                                </td>
                                <td>Date ordered
                                </td>
                                <td>Status
                                </td>
                                <td>
                                </td>
                            </tr>
                            @foreach($orders as $order)
                            <tr>
                                <?php $product = \App\Models\Product::find($order->product_id); ?>
                                <td>{{ $order->id }}
                                </td>
                                <td>{{ $product->name }}
                                </td>
                                <td>{{ $order->prize/100 }}$
                                </td>
                                <td>{{ $order->created_at }}
                                </td>
                                <td>{{ $order->status }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <form action="{{ url('/cancelOrder') }}"  method="post"  style="padding-top: 20px;text-align: left">
                                        @csrf <!-- {{ csrf_field() }} -->
                                        <input type="submit" value="Cancel order {{ $order->id }}">
                                        <input type="text" value="{{ $order->id }}" name="id_order" hidden="true"><br>
                                    </form>
                                    <hr>
                                </td>
                            </tr>

                        @endforeach
                        </table>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

