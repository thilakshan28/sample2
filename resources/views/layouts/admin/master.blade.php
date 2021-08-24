<!DOCTYPE html>
<html lang="en">

<head>
@include('layouts.admin._meta')
@include('layouts.admin._style')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @switch(Auth::user()->role->name)
            @case('Admin')
                @include('layouts.admin.sidebar._adminsidebar')
                @break
            @case('Publisher')
                @include('layouts.admin.sidebar._publishersidebar')
                @break
            @case('Writer')
                @include('layouts.admin.sidebar._writersidebar')
                @break
        @endswitch
    <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
            <div id="content">
                @include('layouts.admin._header')
                <div class="container-fluid">
                    @yield('header')
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @include('layouts.admin._footer')
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary"  href="{{ route('logout') }}"
                onclick= "event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>Logout</a>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin._script')
    @yield('js')
</body>

</html>
