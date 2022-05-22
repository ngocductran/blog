@yield('home')
<!-- Content Row -->

<div class="row">

<!-- Area Chart -->
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            @yield('add_path')
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</div>
