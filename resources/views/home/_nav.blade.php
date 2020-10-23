<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">首页</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="post.html">Sample Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
                @if(Route::has('login'))
                    @auth
                    <div class="dropdown">
                        <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" onclick="logout();return false;">登出</a>
                            <a class="dropdown-item" href="{{ route('password.request') }}">修改密码</a>
                            <a class="dropdown-item" href="{{ route('article.create') }}">写文章</a>
                            <a class="dropdown-item" href="{{ route('article.lst', ['user'=>auth()->id()]) }}">文章列表</a>
                        </div>
                    </div>
                    @else
                        @if(Route::has('register'))
                        <li class="nav-item" onclick="logout">
{{--                            <a class="nav-link" href="{{ route('register') }}">注册</a>--}}
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">登录</a>
                        </li>
                    @endauth
                @endif

            </ul>
        </div>
    </div>
</nav>
<script !src="">
    function logout() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('logout') }}",
            type: "post",
            success: function() {
                window.location.href = "{{ route('index') }}"
            }
        })
    }
</script>
