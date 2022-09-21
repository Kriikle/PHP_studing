@extends('layouts.app')

@section('content')


    @vite(['resources/css/admin.css','resources/js/admin.js',])


@if(\App\Models\User::isAdmin(Auth::id()))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="width: 100%">
                <div class="card">
            <div class="card-header">{{ __('Admin info') }}</div>
            <div class="card-body">
                Your email {{ Auth::user() -> email }} <br>
                Verifeid at {{ Auth::user() -> email_verified_at }}
                <form method="post" action="{{ url('admin/updateEmail' )}}">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="email" name="email">
                    <button type="submit">Change</button>
                </form>
                <datalist id="user_mails">
                @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                @endforeach
                </datalist>
                Add admin by mail
                <form action="{{ url('/admin/addAdmin') }}"  method="post" >
                    @csrf <!-- {{ csrf_field() }} -->
                    <input list="user_mails" name="admin_id">
                    <input type="submit" value="addAdmin">
                </form>
                <p>
                    Admins list:
                </p>
                <p>
                @foreach(\App\Models\Admin::all() as $admin)
                    <p>{{ \App\Models\User::find($admin->user_id)->email }}
                    &nbsp;&nbsp;&nbsp;
                <form action="{{ url('/admin/deleteAdmin') }}"  method="post"  style="padding-top: 20px;text-align: left">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="submit" value="Delete admin rights {{ $admin->id }}">
                    <input type="text" value="{{ $admin->id }}" name="admin_id" hidden="true"><br>
                </form>
                    </p>
                @endforeach
                </p>
            </div>
        </div>
            </div>
        </div>

            <div class="col-md-8" style="width: 100%;margin-top: 50px">
                <div class="card">
                    <div class="card-header">{{ __('Orders list') }}</div>
                    <button class="accordion" style="text-align: right">Open section</button>
                    <div class="panel">
                    <div class="card-body">

                        <table style="width: 100%;min-width: 300px">
                            <tr>
                                <td>id
                                </td>
                                <td>Name product
                                </td>
                                <td>prize
                                </td>
                                <td>Status
                                </td>
                                <td>Date ordered
                                </td>
                                <td>
                                    User email
                                </td>
                                <td>
                                </td>
                            </tr>
                            @foreach($orders as $order)

                                <tr>
                                    <td>{{ $order->id }}
                                    </td>
                                    <td>{{ \App\Models\Product::find($order->product_id)->name }}
                                    </td>
                                    <td>{{ $order->prize/100 }}$
                                    </td>
                                    <td>
                                        <form method="Post" action="{{ url('/admin/updateOrder') }}">
                                            @csrf <!-- {{ csrf_field() }} -->
                                            <input type="text" value="{{ $order->id }}" name="id_order" hidden="true">
                                            <input value="{{ $order->status }}" name="status">
                                            <input type="submit" value="Update order status {{ $order->id }}">
                                        </form>
                                    </td>
                                    <td>{{ $order->created_at }}
                                    </td>
                                    <td>
                                        {{ \App\Models\User::find($order->user_id)->email }}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">

                                    <td>

                                    <td colspan="3">
                                        <form action="{{ url('/admin/deleteOrder') }}"  method="post"  style="padding-top: 20px;text-align: left">
                                            @csrf <!-- {{ csrf_field() }} -->
                                            <input type="submit" value="Delete order {{ $order->id }}">
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

                <div class="card" style="margin-top: 50px">
                    <div class="card-header">{{ __('Products list') }}
                        </div>
                    <button class="accordion" style="text-align: right">Open section</button>
                    <div class="panel">
                    <div class="card-body">

                        <table style="width: 100%;min-width: 300px">
                            <tr>
                                <td>id:#
                                </td>
                                <td>
                                    <form method="post" action="{{ url('admin/createProduct') }}" enctype="multipart/form-data" >
                                        @csrf <!-- {{ csrf_field() }} -->
                                        Name product:
                                        <input value="" name="name" >
                                        prize(cent):
                                        <input value="" name="prize" >
                                        Descrition:
                                        <input type="text" value="" name="description" >
                                        Изображение:
                                        <input type="file" name="img"><br>
                                        <input type="submit" value="Add product" >
                                    </form>
                                </td>
                            </tr>
                            <tr><td><br></td>
                            </tr>
                            @foreach($products as $product)
                                    <tr>
                                        <td>id: {{ $product->id }}
                                        </td>
                                        <td>
                                            <form method="post" action="{{ url('admin/updateProduct') }}" enctype="multipart/form-data" >
                                                @csrf <!-- {{ csrf_field() }} -->
                                                 Name product:
                                                <input value="{{ $product->name }}" name="name">
                                                 prize(cent):
                                                <input value="{{ $product->prize }}" name="prize">
                                                 Descrition:
                                                <input type="text" value="{{ $product->description }}" name="description">
                                                NEW_ING:<input type="file" name="img"><br>
                                                <input type="submit" value="Update product {{ $product->id }}" >
                                                <input type="text" value="{{ $product->id }}" name="id_product" hidden="true"><br>
                                            </form>
                                    </td>
                                    <tr>
                                <td colspan="5">
                                    <form action="{{ url('admin/deleteProduct') }}"  method="post"  style="padding-top: 20px;text-align: right">
                                        @csrf <!-- {{ csrf_field() }} -->
                                        <input type="submit" value="Delete product {{ $product->id }}">
                                        <input type="text" value="{{ $product->id }}" name="id_product" hidden="true"><br>
                                    </form>
                                    <hr>
                                </td>
                                </tr>

                            @endforeach
                        </table>

                    </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 50px">
                <div class="card-header">{{ __('Category list') }}
                    </div>
                    <button class="accordion" style="text-align: right">Open section</button>
                    <div class="panel">
                <div class="card-body">
                    <table style="width: 100%;min-width: 300px">
                        <tr>
                            <td>id:#
                            </td>
                            <td>
                                <form method="Get" action="{{ url('admin/createCategory') }}" >
                                    Name product:
                                    <input value="" name="name" >
                                    Descrition:
                                    <input type="text" value="" name="description" >
                                    <input type="submit" value="Add Category" >
                                </form>
                            </td>
                        </tr>
                        <tr><td><br></td>
                        </tr>
                        @foreach($categories as $category)
                            <tr>
                                <td>id: {{ $category->id }}
                                </td>
                                <td>
                                    <form method="Get" action="{{ url('admin/updateCategory') }}" >
                                        Name product:
                                        <input value="{{ $category->name }}" name="name">
                                        Descrition:
                                        <input type="text" value="{{ $category->description }}" name="description">

                                        <input type="submit" value="Update category {{ $category->id }}" >
                                        <input type="text" value="{{ $category->id }}" name="id_category" hidden="true"><br>
                                    </form>
                                </td>
                            <tr>
                                <td colspan="2">
                                    <form action="{{ url('/admin/deleteCategory') }}"  method="post"  style="padding-top: 20px;text-align: left">
                                        @csrf <!-- {{ csrf_field() }} -->
                                        <input type="submit" value="Delete category {{ $category->id }}">
                                        <input type="text" value="{{ $category->id }}" name="id_category" hidden="true"><br>
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

        <div class="card" style="width: 100%;margin-top: 50px">
            <div class="card-header">{{ __('Category-product connector') }}
                </div>
            <button class="accordion" style="text-align: right">Open section</button>
            <div class="panel">
            <div class="card-body">

                <datalist id="categories">
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </datalist>
                <datalist id="products">
                    @foreach(\App\Models\Product::all() as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </datalist>
                Add new category-product relation
                <form action="{{ url('/admin/addRelationProductCategory') }}"  method="Get" >
                    <input list="categories" name="category_id">
                    <input list="products" name="product_id">
                    <input type="submit" value="addRelation">
                </form>

            </div>
        </div>

    </div>
        </div>

    </div>
@endif
@endsection

