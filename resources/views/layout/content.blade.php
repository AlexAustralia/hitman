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
            @yield('actions')
        </div>
        <!-- END PAGE HEADER-->

        @include('partials.flash')

        @yield('content')

    </div>
    <!-- END CONTENT BODY -->
</div>