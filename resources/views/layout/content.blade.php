<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">@section('page-name') Blank Page Layout @show
            <small>@section('page-description') blank page layout @show</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="index.html">Calendar</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                @section('breadcrumb')
                <li>
                    <a href="#">Blank Page</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>Page Layouts</span>
                </li>
                @show
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        @section('actions')
                            <li>
                                <a href="#">
                                    <i class="icon-bell"></i> Action</a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-shield"></i> Another action</a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-user"></i> Something else here</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="#">
                                    <i class="icon-bag"></i> Separated link</a>
                            </li>
                        @show
                    </ul>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER-->

        @include('partials.flash')

        @yield('content')

    </div>
    <!-- END CONTENT BODY -->
</div>