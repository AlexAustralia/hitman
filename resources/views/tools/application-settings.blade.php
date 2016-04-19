@extends('app')

@section('title') Application Settings | @parent @stop

@section('plugin-styles')
    <link href="{{ asset('theme/global/plugins/jquery-minicolors/jquery.minicolors.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('page-name') Application Settings @stop
@section('page-description') Manage Application Settings @stop
@section('breadcrumb')
    <li>
        <span>Tools</span>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Application Settings</span>
    </li>
@stop

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gears"></i>Application Settings
            </div>
        </div>

        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="{{ URL::to('tools/application-settings') }}" class="form-horizontal form-bordered" method="post" id="application_settings_form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="form-body">
                    @foreach($settings as $key => $setting)

                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ $setting->name }}</label>
                            <div class="col-md-3">
                                <input type="text" name="value[{{ $key }}]" class="form-control colors demo" value="#{{ $setting->value }}">
                            </div>
                        </div>
                    @endforeach

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">Submit</button>
                                <button type="button" class="btn btn-circle grey-salsa btn-outline" onclick="location.href='/'">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('theme/global/plugins/jquery-minicolors/jquery.minicolors.min.js') }}" type="text/javascript"></script>
@stop

@section('page-level-scripts')
    <script>
        $(document).ready(function(){
            $('.colors').minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom left',
                change: function(hex, opacity) {
                    if (!hex) return;
                    if (opacity) hex += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(hex);
                    }
                },
                theme: 'bootstrap'
            });
        })
    </script>
@stop