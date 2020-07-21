<div class="blog-masthead">
    <div class="container">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a class="blog-nav-item " href="/laraveldemo/posts">网站首页</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/laraveldemo/posts/create">文章创建</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/laraveldemo/notices">通知</a>
            </li>

        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <div>
                    @if(\Illuminate\Support\Facades\Auth::user())
                        <img src="/laraveldemo/public/{{\Illuminate\Support\Facades\Auth::user()->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 30px"/>
                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/laraveldemo/user/{{\Illuminate\Support\Facades\Auth::user()->id}}/show">我的主页</a></li>
                            <li><a href="/laraveldemo/user/me/setting">个人设置</a></li>
                            <li><a href="/laraveldemo/logout">登出</a></li>
                        </ul>
                    @else

                        <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><a href="/laraveldemo/login">请登录</a> <span class="caret"></span></a>
                    @endif

                </div>
            </li>
        </ul>
    </div>
</div>
