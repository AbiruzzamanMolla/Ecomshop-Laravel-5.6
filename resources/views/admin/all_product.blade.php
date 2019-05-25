@extends('admin_layout')
@section('dashboard_content')


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>Products</li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>View Products</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="text-center text-danger color-red red">
                <?php
                $msg = Session::get('msg');
                if($msg){
                    echo $msg;
                    Session::put('msg', NULL);
                }
                ?>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Manucecture Name</th>
                        <th>Preview</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    @foreach($all_product_info as $view_product)
                    <tbody>
                    <tr>
                        <td>{{ $view_product->product_id }}</td>
                        <td class="center">{{ $view_product->product_name }}</td>
                        <td class="center">{{ $view_product->category_name }}</td>
                        <td class="center">{{ $view_product->manufecture_name }}</td>
                        <td class="center"><img src="{{ $view_product->product_image }}" height="100px" width="100px">
                        </td>
                        <td class="center">{{ $view_product->product_price }}</td>
                        <td class="center">{{ $view_product->product_size }}</td>
                        <td class="center">{{ $view_product->product_color }}</td>
                        <td class="center">{{ $view_product->product_qty }}</td>


                        <td class="center">
                            @if($view_product->publication_status == 1)
                                <span class="label label-success">Published</span>
                            @else
                                <span class="label label-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="center">
                            @if($view_product->publication_status == 1)
                                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{URL::to
                                ('/inactive-product/'
                                .$view_product->product_id)}}">
                                    <i class="halflings-icon white thumbs-down"></i>
                                </a>
                            @else
                                <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="{{URL::to
                                ('/active-product/'.$view_product->product_id)}}">
                                    <i class="halflings-icon white thumbs-up"></i>
                                </a>
                            @endif
                            <a class="btn btn-info" href="{{URL::to('/update-product/'.$view_product->product_id)}}">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{URL::to
                            ('/delete-product/'.$view_product->product_id)
                            }}">
                                <i class="halflings-icon white trash"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                        @endforeach
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->


@endsection