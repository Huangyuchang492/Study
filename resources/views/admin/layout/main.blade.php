<!DOCTYPE html>
<html>
@include('admin.layout.head')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('admin.layout.nav')
    @include('admin.layout.menu')

    <div class="content-wrapper">
    @yield('content')
    </div>
    <div class="control-sidebar-bg"></div>
</div>
@include('admin.layout.foot')
</body>
</html>

