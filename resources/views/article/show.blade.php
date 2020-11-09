@extends('home.default')
@section('title', '首页')
@section('header')
<header class="masthead" style="background-image: url('/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1>{{ $article->title }}</h1>
                    <h2 class="subheading">{{ $article->cate['name'] }}</h2>
                    <span class="meta">Posted by
                        @if($article->user){{ $article->user['name'] }}@endif
              on {{ $article->created_at->format('F j, Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection
@section('container')
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! $article->contents !!}
                </div>
            </div>
        </div>
    </article>

    <hr>

@endsection
