<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/layui/lib/layui-v2.5.5/css/layui.css" media="all">
    <link rel="stylesheet" href="/layui/css/public.css" media="all">
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <form class="layui-form layui-form-pane" action="" lay-filter="form">
{{--            @csrf--}}
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">分类名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" autocomplete="off" class="layui-input" placeholder="请输入用户名" lay-verify="required|username">
                    </div>
                </div>
{{--                <div class="layui-inline">--}}
{{--                    <label class="layui-form-label">上级分类</label>--}}
{{--                    <div class="layui-input-inline">--}}
{{--                        <select name="parent_id" lay-verify="">--}}
{{--                            <option value="">顶级分类</option>--}}
{{--                            @foreach($categories as $category)--}}
{{--                                @if($category->depth == 2)--}}
{{--                                    @continue--}}
{{--                                @endif--}}
{{--                            <option value="{{ $category->id }}">--}}
{{--                                @if($category->depth>0)--}}
{{--                                    |--}}
{{--                                @endif--}}
{{--                                {{ str_repeat("——",$category->depth).$category->name }}--}}
{{--                            </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="layui-inline">
                    <label class="layui-form-label">上级分类</label>
                    <div class="layui-input-inline">
                        <select name="parent_id" lay-verify="">
                            <option value="">顶级分类</option>
                            @foreach($categories as $category1)

                                <option value="{{ $category1->id }}">
                                    |——{{ $category1->name }}
                                </option>
                                @foreach($category1->children as $category2)
                                    <option value="{{ $category2->id }}">
                                        |————{{ $category2->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">跳转式提交</button>
            </div>
        </form>
    </div>
</div>

<script src="/layui/lib/layui-v2.5.5/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
layui.use(['form', 'layedit', 'laydate'], function () {
    var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate
            , $ = layui.$;
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                'Authorization': "Bearer " + layui.data('token').access_token
            }
        });
        //日期
        laydate.render({
            elem: '#date'
        });
        laydate.render({
            elem: '#date1'
        });

        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');

        //自定义验证规则
        form.verify({
            username: function (value) {
                if (value.length < 3) {
                    return '用户名至少得3个字符啊';
                }
                if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                    return '用户名不能有特殊字符';
                }
                if(/(^\_)|(\__)|(\_+$)/.test(value)){
                    return '用户名首尾不能出现下划线\'_\'';
                }
                if(/^\d+\d+\d$/.test(value)){
                    return '用户名不能全为数字';
                }
            }
            , pass: [
                /^[\S]{6,12}$/
                , '密码必须6到12位，且不能出现空格'
            ]
            , pass_confirm: function (value) {
                if(value != $('input[name=password]').val()) {
                    return '密码不一致'
                }
            }
            , content: function (value) {
        layedit.sync(editIndex);
    }
        });

        //监听指定开关
        form.on('switch(switchTest)', function (data) {
            layer.msg('开关checked：' + (this.checked ? 'true' : 'false'), {
                offset: '6px'
            });
            layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
        });

        //监听提交
        form.on('submit(demo1)', function (data) {
            $.ajax({
                url: "{{ route('api.admin.users.store') }}",
                data: data.field,
                type: "post",
                success: (getData)=> {
                    layer.alert(getData.message, {
                        icon: 1,
                        time:2000
                    })
                },
                error: (getData)=>{
                    console.log(getData.responseJSON.errors)
                    $.each(getData.responseJSON.errors, function(index, element) {
                        console.log(element)
                        layer.alert(element[0], {
                            icon: 2,
                            time:2000
                        })
                        return false
                    })
                    // layer.alert(getData.responseJSON.message, {
                    //     icon: 2,
                    //     time:2000
                    // })
                }
            })
            // layer.alert(JSON.stringify(data.field), {
            //     title: '最终的提交信息'
            // })
            return false;
        });

        //表单初始赋值
        form.val('form', {
            "name": "王小明"
            , "email": "wangxiaoming@qq.com"
            , "password": "123456"
            , "password_confirmation": "123456"
        })


    });
</script>

</body>
</html>
