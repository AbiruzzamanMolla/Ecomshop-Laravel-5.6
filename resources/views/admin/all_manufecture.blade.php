@extends('admin_layout')
@section('dashboard_content')


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>Manufecture</li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>View Manufecture</h2>
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
                        <th>Manufecture ID</th>
                        <th>Manufecture Name</th>
                        <th>Manufecture Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    @foreach($all_manufecture_info as $view_manufecture)
                        <tbody>
                        <tr>
                            <td>{{ $view_manufecture->manufecture_id }}</td>
                            <td class="center">{{ $view_manufecture->manufecture_name }}</td>
                            <td class="center">{{ $view_manufecture->manufecture_description }}</td>
                            <td class="center">
                                @if($view_manufecture->publication_status == 1)
                                    <span class="label label-success">Published</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="center">
                                @if($view_manufecture->publication_status == 1)
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{URL::to('/inactive-manufecture/'
                                .$view_manufecture->manufecture_id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="{{URL::to('/active-manufecture/'.$view_manufecture->manufecture_id)}}">
                                        <i class="halflings-icon white thumbs-up"></i>
                                    </a>
                                @endif
                                <a class="btn btn-info" href="{{URL::to('/update-manufecture/'.$view_manufecture->manufecture_id)}}">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{URL::to('/delete-manufecture/'.$view_manufecture->manufecture_id)
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