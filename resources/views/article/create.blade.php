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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">写文章</div>

                    <div class="card-body">
                        <form action="{{ route('article.store') }}" method="post">
                            {{ csrf_field() }}
                            {{--文章标题--}}
                            <div class="form-group row">
                                <label for="" class="col-form-label col-sm-2">文章标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                </div>
                            </div>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{--文章分类--}}
                            <div class="form-group row">
                                <label for="" class="col-form-label col-sm-2">文章标题</label>
                                <div class="col-sm-10">
                                    <select name="cate_id" id="" class="custom-select">
                                        <option value="">——请选择分类——</option>
                                        @foreach($cates as $cate)
                                            <option value="{{ $cate->id }}" {{ old('cate_id')==$cate->id? "selected":"" }}>{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('cate_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{--文章内容--}}
                            <div class="form-group row">
                                <label for="" class="col-form-label col-sm-2">文章内容</label>
                                <div class="col-sm-10">
                                    <textarea name="contents" id="text1" cols="30" rows="10" class="form-control" style="display: none">
                                        {!! old('contents') !!}
                                    </textarea>
                                    <div id="div1" name="contents">
{{--                                        {!! old('contents') !!}--}}
                                    </div>
                                </div>
                            </div>
                            @error('contents')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn-primary">提交</button>
                        </form>
                    </div>
                </div>
            </div>
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
