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
            Add Slider
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slider</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{ url('/save-slider') }}" method="post"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="control-group text-center">
                            <label class="control-label">Slider Image</label>
                            <div class="controls">
                                <input type="file" name="slider_image">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="status">Publication Status</label>
                            <div class="controls">
                                <input type="checkbox" class="input-xlarge" name="publication_status" id="status"
                                       value="1" checked>
                            </div>
                        </div>
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-primary">Add Slider</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>View Sliders</h2>
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
                        <th>Preview</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    @foreach($all_slider_info as $view_slider)
                        <tbody>
                        <tr>
                            <td>{{ $view_slider->slider_id }}</td>
                            <td class="center"><img src="{{ $view_slider->slider_image }}" height="100px"
                                                    width="200px">
                            </td>
                            <td class="center">
                                @if($view_slider->publication_status == 1)
                                    <span class="label label-success">Published</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="center">
                                @if($view_slider->publication_status == 1)
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{URL::to
                                ('/inactive-slider/'
                                .$view_slider->slider_id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="{{URL::to
                                ('/active-slider/'.$view_slider->slider_id)}}">
                                        <i class="halflings-icon white thumbs-up"></i>
                                    </a>
                                @endif
                                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{URL::to
                            ('/delete-slider/'.$view_slider->slider_id)
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

@stop