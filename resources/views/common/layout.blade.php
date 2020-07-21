@include('common.head')
@include('common.nav')
<div class="container">
    <div class="blog-header"></div>
    <div class="row">
       @yield('content')

    </div>
</div><!-- /.row -->

@include('common.footer')


