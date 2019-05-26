@extends('layout')
@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Features Items</h2>
            @foreach($all_published_product as $v_product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ URL::to($v_product->product_image) }}" height="300px" alt=""/>
                                <h2>{{ $v_product->product_price }} Taka</h2>
                                <p>{{ $v_product->product_name }}</p>
                                <form action="{{URL::to('/add-to-cart')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="qty" value="1"/>
                                    <input type="hidden" name="product_id" value="{{ $v_product->product_id }}"/>
                                    <button type="submit" class="btn btn-default add-to-cart"><i class="fa
                                    fa-shopping-cart"></i>Add to cart</button>
                                </form>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="{{URL::to('manufecture/'.$v_product->manufecture_id)}}"><i
                                                class="fa fa-eye"></i>{{ $v_product->manufecture_name }}</a></li>
                                <li><a href="{{URL::to('product/'.$v_product->product_id) }}"><i class="fa
                                fa-eye-slash"></i>Product
                                        Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!--features_items-->
    </div>
@endsection
