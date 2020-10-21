@extends('home.default')
@section('title', '写文章')
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
                    <div class="card-header">写文章</div>

                    <div class="card-body">
                        <form action="">
                            {{--文章标题--}}
                            <div class="form-group row">
                                <label for="" class="col-form-label col-sm-2">文章标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            {{--文章分类--}}
                            <div class="form-group row">
                                <label for="" class="col-form-label col-sm-2">文章标题</label>
                                <div class="col-sm-10">
                                    <select name="" id="" class="custom-select">
                                        <option value="">1</option>
                                        <option value="">1</option>
                                        <option value="">1</option>
                                        <option value="">1</option>
                                        <option value="">1</option>
                                    </select>
                                </div>
                            </div>
                            {{--文章内容--}}
                            <div class="form-group row">
                                <label for="" class="col-form-label col-sm-2">文章内容</label>
                                <div class="col-sm-10">
{{--                                    <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>--}}
                                    <div id="div1"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ mix('js/wang.js') }}"></script>
{{--    <script>--}}
{{--        const editor = new Editor('#div1')--}}
{{--        editor.config.height = 500--}}
{{--        // 或者 const editor = new E( document.getElementById('div1') )--}}
{{--        editor.create()--}}
{{--    </script>--}}
    <script !src="">
        Editor
            .create( document.querySelector( '#div1' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
