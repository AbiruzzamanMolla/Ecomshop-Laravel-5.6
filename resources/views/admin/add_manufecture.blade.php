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
            Add Manufecture
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Manufecture</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{ url('/save-manufecture') }}" method="post">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="manufectureName">Manufecture Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="manufecture_name" id="manufectureName" value=""
                                       placeholder="Enter Manufecture Name">
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="Description">Manufecture Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="manufecture_description" id="Description"
                                          rows="3"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="status">Publication Status</label>
                            <div class="controls">
                                <input type="checkbox" class="input-xlarge" name="publication_status" id="status"
                                       value="1" checked>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->


@stop