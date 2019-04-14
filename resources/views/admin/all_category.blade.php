@extends('admin_layout')
@section('dashboard_content')


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>Categories</li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>View Category</h2>
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
                        <th>Category ID</th>
                        <th>Cateory Name</th>
                        <th>Cateory Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    @foreach($all_category_info as $view_category)
                    <tbody>
                    <tr>
                        <td>{{ $view_category->category_id }}</td>
                        <td class="center">{{ $view_category->category_name }}</td>
                        <td class="center">{{ $view_category->category_description }}</td>
                        <td class="center">
                            @if($view_category->publication_status == 1)
                                <span class="label label-success">Published</span>
                            @else
                                <span class="label label-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="center">
                            @if($view_category->publication_status == 1)
                                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{URL::to('/inactive-category/'
                                .$view_category->category_id)}}">
                                    <i class="halflings-icon white thumbs-down"></i>
                                </a>
                            @else
                                <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="{{URL::to('/active-category/'.$view_category->category_id)}}">
                                    <i class="halflings-icon white thumbs-up"></i>
                                </a>
                            @endif
                            <a class="btn btn-info" href="{{URL::to('/update-category/'.$view_category->category_id)}}">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a class="btn btn-danger" href="#">
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