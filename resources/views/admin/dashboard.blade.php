{{-- <div class="float-right page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div>  --}}
{{-- @extends('admin.auth.layouts.admin_app') --}}

{{-- @section('content') --}}

    <a class="dropdown-item" href="{{ route('admin.logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
            class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>






{{--
 @endsection --}}
