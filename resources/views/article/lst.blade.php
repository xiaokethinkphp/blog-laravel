@extends('home.default')
@section('title', '写文章')
@section('header')
    <header class="masthead" style="background-image: url('{{ asset('img/home-bg.jpg')}}') ;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading" style="padding: 50px 0 50px 0;">
                        <h1>Clean Blog</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">写文章</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">标题</th>
                                <th scope="col">分类</th>
                                <th scope="col">作者</th>
                                <th scope="col">发布时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <th scope="row">{{ $article->id }}</th>
                                    <td><a href="">{{ $article->title }}</a></td>
                                    <td>{{ $article->cate['name'] }}</td>
                                    <td>{{ auth()->user()->name }}</td>
                                    <td>{{ $article->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>{{ $articles->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/wang.js') }}"></script>
    <script>
        const editor = new Editor('#div1')
        editor.config.uploadImgHeaders = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        editor.config.uploadImgServer = "{{ route('article.upload') }}"
        const $text1 = $('#text1')
        editor.config.onchange = function (html) {
            // 第二步，监控变化，同步更新到 textarea
            $text1.val(html)
        }
        // 或者 const editor = new E( document.getElementById('div1') )
        editor.create()
        editor.txt.html("{!! old('contents') !!}")
    </script>
{{--    <script !src="">--}}
{{--        Editor--}}
{{--            .create( document.querySelector( '#div1' ) )--}}
{{--            .then( editor => {--}}
{{--                console.log( editor );--}}
{{--            } )--}}
{{--            .catch( error => {--}}
{{--                console.error( error );--}}
{{--            } );--}}
{{--    </script>--}}
@endsection
