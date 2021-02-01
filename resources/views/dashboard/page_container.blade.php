<div class="page-container">

    <!-- HEADER DESKTOP-->
@include('dashboard.header_desktop')
<!-- HEADER DESKTOP-->

    <!-- MAIN CONTENT-->
    {{--@include('dashboard.main_content')--}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

</div>
