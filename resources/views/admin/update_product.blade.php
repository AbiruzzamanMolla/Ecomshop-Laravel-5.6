@extends('admin_layout')
@section('dashboard_content')



    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/dashboard')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            Update Product
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{ url('/update-product', $product_info->product_id) }}"
                      method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="productName">Product Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_name" id="productName" value="{{ $product_info->product_name }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectCategory">Select Category</label>
                            <div class="controls">
                                <select id="selectCategory" name="category_id">
                                    @php
                                        $current_category = DB::table('tbl_category')->where('category_id',
                                        $product_info->category_id)->first();
                                            $all_category_info = DB::table('tbl_category')->get();
                                    @endphp
                                    <option value="{{ $current_category->category_id }}">{{
                                    $current_category->category_name }}</option>
                                    @foreach($all_category_info as $cat_info)
                                    <option value="{{ $cat_info->category_id }}">{{ $cat_info->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError">Select Manufecture</label>
                            <div class="controls">
                                <select id="selectError" data-rel="chosen" name="manufecture_id">
                                    @php
                                    $current_menufecture = DB::table('tbl_manufecture')->where('manufecture_id',
                                    $product_info->manufecture_id)->first();
                                        $all_manufecture_info = DB::table('tbl_manufecture')->get();
                                    @endphp
                                    <option value="{{ $current_menufecture->manufecture_id }}">{{
                                    $current_menufecture->manufecture_name }}</option>
                                    @foreach($all_manufecture_info as $man_info)
                                        <option value="{{ $man_info->manufecture_id }}">{{
                                        $man_info->manufecture_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="product_short_description">Short Description</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_short_description" id="product_short_description" value="{{ $product_info->product_short_description }}">
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="Description">Long Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="product_long_description" id="Description"
                                          rows="3">{{ $product_info->product_long_description }}</textarea>
                            </div>
                        </div>
{{--                        <div class="control-group">--}}
{{--                            <label class="control-label">Preview</label>--}}
{{--                            <div class="controls">--}}
{{--                                <input type="file" name="product_image">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="control-group">
                            <label class="control-label" for="product_price">Product Price</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_price" id="product_price" value="{{ $product_info->product_price }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="product_size">Product Size</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_size" id="product_size" value="{{ $product_info->product_size }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="product_color">Product Color</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_color" id="product_color" value="{{ $product_info->product_color }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="product_qty">Product Quantity</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_qty" id="product_qty" value="{{ $product_info->product_qty }}">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Product Details</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->


@stop