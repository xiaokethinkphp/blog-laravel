<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/layui/lib/layui-v2.5.5/css/layui.css" media="all">
    <link rel="stylesheet" href="/layui/css/public.css" media="all">
</head>
<body>
@routes<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">用户姓名</label>
                            <div class="layui-input-inline">
                                <input type="text" name="name" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">用户邮箱</label>
                            <div class="layui-input-inline">
                                <input type="text" name="email" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>

        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container">
                <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加 </button>
                <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> 删除 </button>
            </div>
        </script>

        <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

        <script type="text/html" id="currentTableBar">
            <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
            <a class="layui-btn layui-btn-xs data-count-delete" lay-event="up">
                <i class="layui-icon">&#xe619;</i>
            </a>
            <a class="layui-btn layui-btn-xs layui-btn-warm data-count-delete" lay-event="down">
                <i class="layui-icon">&#xe61a;</i>
            </a>
            @verbatim
            {{#  if(d.deleted_at){ }}
            <a class="layui-btn layui-btn-xs layui-btn-success data-count-delete" lay-event="restore">恢复</a>
            {{#  } }}
            @endverbatim
        </script>

    </div>
</div>
<script src="/layui/lib/layui-v2.5.5/layui.js" charset="utf-8"></script>
<script>

    layui.use(['form', 'table'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                'Authorization': "Bearer " + layui.data('token').access_token
            }
        });
        table.render({
            elem: '#currentTableId',
            url: '{{ route('admin.categories.info') }}',
            toolbar: '#toolbarDemo',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[
                {type: "checkbox", width: 50},
                {field: 'id', width: 80, title: 'ID', sort: true},
                {field: 'name', width: 150, title: '名称', sort: true, templet:"#nameTpl"},
                {field: 'created_at', width: 120, title: '创建时间', sort: true, templet:"<div>@{{layui.util.toDateString(d.created_at,'yyyy-MM-dd')}}</div>"},
                {field: 'updated_at', width: 120, title: '修改时间', sort: true, templet:"<div>@{{layui.util.toDateString(d.updated_at,'yyyy-MM-dd')}}</div>"},
                {field: 'deleted_at', width: 120, title: '删除时间', sort: true, templet:"#deletedTpl"},
                {title: '操作', minWidth: 150, toolbar: '#currentTableBar', align: "center"}
            ]],
            limits: [10, 15, 20, 25, 50, 100],
            limit: 15,
            page: false,
            skin: 'line',
        });

        // 监听搜索操作
        form.on('submit(data-search-btn)', function (data) {
            var result = JSON.stringify(data.field);
            // layer.alert(result, {
            //     title: '最终的搜索信息'
            // });

            //执行搜索重载
            table.reload('currentTableId', {
                page: {
                    curr: 1
                }
                , where: {
                    searchParams: result
                }
            }, 'data');

            return false;
        });

        /**
         * toolbar监听事件
         */
        table.on('toolbar(currentTableFilter)', function (obj) {
            if (obj.event === 'add') {  // 监听添加操作
                var index = layer.open({
                    title: '添加分类',
                    type: 2,
                    shade: 0.2,
                    maxmin:true,
                    shadeClose: true,
                    area: ['100%', '100%'],
                    content: '{{ route('admin.categories.create') }}',
                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
            } else if (obj.event === 'delete') {  // 监听删除操作
                var checkStatus = table.checkStatus('currentTableId')
                    , data = checkStatus.data;
                let ids = {}
                data.map(function(v,i) {
                    ids[i] = v.id
                })
                // layer.alert(JSON.stringify(data));
                $.ajax({
                    url: "{{ route('api.admin.users.deletes') }}",
                    data: {ids:ids},
                    type: "post",
                    success:function(getData){
                        if (getData.status == 1) {
                            layer.alert(getData.msg, function(){
                                window.location.reload();
                            })
                        }
                    }
                })
                console.log(ids)
            }
        });

        //监听表格复选框选择
        table.on('checkbox(currentTableFilter)', function (obj) {
            console.log(obj)
        });

        table.on('tool(currentTableFilter)', function (obj) {
            const data = obj.data;
            if (obj.event === 'edit') {
                var index = layer.open({
                    title: '编辑用户',
                    type: 2,
                    shade: 0.2,
                    maxmin:true,
                    shadeClose: true,
                    area: ['100%', '100%'],
                    content: '/admin/categories/'+data.id+'/edit',
                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            } else if (obj.event === 'delete') {
                layer.confirm('真的删除行么，已经删除的会被彻底删除', function (index) {

                    $.ajax({
                        url: "/api/admin/users/"+data.id,
                        type: "delete",
                        success:function(getData){
                            if (getData.status == 1) {
                                layer.alert(getData.msg, function(){
                                    window.location.reload();
                                })
                            }
                        }
                    })
                    layer.close(index);
                });
            } else if (obj.event === 'up') {
                layer.confirm('确认上移么', function (index) {
                    $.ajax({
                        url:"/admin/categories/"+data.id+"/change/up",
                        success:function(getData){
                            if (getData.status == 1) {
                                layer.alert(getData.msg, function(){
                                    window.location.reload();
                                })
                            }
                        }
                    })
                    layer.close(index);
                });
            }else if (obj.event === 'down') {
                layer.confirm('确认下移么', function (index) {
                    $.ajax({
                        url:"/admin/categories/"+data.id+"/change/down",
                        success:function(getData){
                            if (getData.status == 1) {
                                layer.alert(getData.msg, function(){
                                    window.location.reload();
                                })
                            }
                        }
                    })
                    layer.close(index);
                });
            }
        });

    });
</script>
<script type="text/html" id="emailTpl">
    @verbatim
    {{#  if(d.email_verified_at){ }}
    是
    {{#  } else { }}
    否
    {{#  } }}
    @endverbatim
</script>
<script type="text/html" id="deletedTpl">
    @verbatim
        {{#  if(d.deleted_at){ }}
        {{layui.util.toDateString(d.deleted_at,'yyyy-MM-dd')}}
        {{#  } else { }}

        {{#  } }}
    @endverbatim
</script>
<script type="text/html" id="nameTpl">
    @verbatim
        {{#  if(d.depth>0){ }}
        {{#
            const fn = function(num) {
                return new Array(num+1).join('——');
            };
        }}
        {{ "|"+fn(d.depth)+d.name }}
        {{#  } else { }}
        {{d.name}}
        {{#  } }}

    @endverbatim
</script>
</body>
</html>
