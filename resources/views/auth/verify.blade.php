@extends('home.default')
@section('title', '验证邮箱')
@section('header')
    <header class="masthead" style="background-image: url('img/home-bg.jpg');">
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">验证你的邮箱</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            一封验证邮件已经发送到你的邮箱
                        </div>
                    @endif

                    请检查你的邮箱
                    如果没有收到请点击重新发送,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">点击重新发送</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
