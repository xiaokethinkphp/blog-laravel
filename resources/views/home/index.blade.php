@extends('home.default')
@section('title', '首页')
@section('header')
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
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
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach($articles as $article)
                <div class="post-preview">
                    <a href="{{ route('article.show', $article->id) }}">
                        <h2 class="post-title">
                            {{ $article->title }}
                        </h2>
                        <h3 class="post-subtitle">
                            {{ $article->cate['name'] }}
                        </h3>
                    </a>
                    <p class="post-meta">Posted by
                        <a href="#">{{ $article->user['name'] }}</a>
                        {{ $article->created_at->format('F j, y') }}</p>
                </div>
                <hr>
                @endforeach
                <!-- Pager -->
                <div class="clearfix">
                    {{ $articles->links('home.page') }}
{{--                    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>--}}
                </div>
            </div>
        </div>
    </div>
    <hr>

@endsection
