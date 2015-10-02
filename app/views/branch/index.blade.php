@extends('layouts')

@section('title')
网点列表 ::
@parent
@stop

@section('styles_src')
<!--<link href="{{{ asset('assets/css/plugins/dataTables/dataTables.bootstrap.css') }}}" rel="stylesheet">-->
@stop

@section('script_src')
<!--<script src="{{{ asset('assets/js/plugins/dataTables/jquery.dataTables.js') }}}"></script>-->
<!--<script src="{{{ asset('assets/js/plugins/dataTables/dataTables.bootstrap.js') }}}"></script>-->
@stop

@section('script')
@parent
<script type="text/javascript">
    $(function() {

        $url = "{{ URL::to('branch') }}";

        $('#branch_search').click(function(){

            $type_id = $('#type_id').val();
            $area_id = $('#area_id').val();
            $line_id = $('#line_id').val();

            $href = '?type_id='+ $type_id + '&area_id='+ $area_id + '&line_id='+ $line_id;
            $name = $('#name').val();

            if($name){
                $href += "&name=" + $name;
            }

            $code = $('#code').val();

            if($code){
                $href += "&code=" + $code;
            }

            $contact = $('#contact').val();

            if($contact){
                $href += "&contact=" + $contact;
            }


            $('#branch_search').attr("href", $href);
        });

    });
</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <span class="pull-right">
                @if (Auth::user()->grade == 1)
                <a href="{{ URL::to('branch/add') }}">
                    <button type="button" class="btn btn-primary">添加网点</button>
                </a>
                @endif
            </span>

            网点列表 <small>共 {{ $count }} 个网点</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li class="active">网点列表</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="table-responsive">
            <table class="table table-condensed">
                <tbody>
                <tr>
                    <td>
                        <select name="type_id" id="type_id" class="form-control">
                            <option value="0">选择客户类型</option>
                            @foreach ($type as $t)
                            <option value="{{ $t->id }}"
                            @if ($t->id == Input::get('type_id'))
                            selected
                            @endif
                                >{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select name="area_id" id="area_id" class="form-control">
                            <option value="0">选择区域</option>
                            @foreach ($area as $a)
                            <option value="{{ $a->id }}"
                            @if ($a->id == Input::get('area_id'))
                            selected
                            @endif
                                >{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select name="line_id" id="line_id" class="form-control">
                            <option value="0">选择线路</option>
                            @foreach ($line as $l)
                            <option value="{{ $l->id }}"
                            @if ($l->id == Input::get('line_id'))
                            selected
                            @endif
                                >{{ $l->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td></td>
                    </tr><tr>
                    <td>
                        <input type="text" class="form-control" placeholder="网点" name="name" id="name" value="{{{ Input::get('name') }}}" />
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="网点编码" name="code" id="code" value="{{{ Input::get('code') }}}" />

                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="联系人" name="contact" id="contact" value="{{{ Input::get('contact') }}}" />

                    </td>

                    <td>
                        <a href="{{ URL::to('branch') }}" id="branch_search">
                            <button type="button" class="btn btn-info btn-block">搜索</button>
                        </a>
                    </td>

                </tr>
                </tbody>
                </table>

            <hr/>

            <table class="table table-striped table-condensed table-hover"  >
                <thead>
                    <tr>
                        <th>网点编码</th>
                        <th>网点</th>
                        <th>客户类型</th>


                        <th>网点区域</th>
                        <th>客户线路</th>

                        <th>合同余量</th>
                        <th>业务员</th>


                        <th>操作</th>

                        <th>记录</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($branch as $b)
                <tr>
                    <td><a href="{{ URL::to('branch/view/'.$b->id) }}">{{ $b->code }}</a></td>
                    <td><a href="{{ URL::to('branch/view/'.$b->id) }}">{{ $b->name }}</a></td>
                    <td>{{ $b->type->name }}</td>
                    <td>{{ $b->area->name }}</td>
                    <td>{{ $b->line->name }}</td>

                    <td>{{ $b->stock }} 箱</td>
                    <td>{{ $b->user->username }}</td>
                    <td>
                        @if (Auth::user()->grade == 1)
                        <a href="{{ URL::to('branch/edit/'.$b->id) }}" class="btn btn-xs btn-primary">修改</a>
                        <a href="{{ URL::to('branch/renewed/'.$b->id) }}" class="btn btn-xs btn-info">合同</a>
                        @endif

                        @if (Auth::user()->grade == 1 || Auth::user()->grade == 10 )
                        <a href="{{ URL::to('picking/warehouse-select/'.$b->id) }}" class="btn btn-xs btn-danger">出货</a>
                        <a href="{{ URL::to('branch/visit-add/'.$b->id) }}" class="btn btn-xs btn-success">回访</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ URL::to('branch/renewed-list/'.$b->id) }}" class="btn btn-xs btn-default">合同</a>
                        <a href="{{ URL::to('branch/visit/'.$b->id) }}" class="btn btn-xs btn-default">回访</a>
                        <a href="{{ URL::to('branch/picking/'.$b->id) }}" class="btn btn-xs btn-default">出货</a>
                        <a href="{{ URL::to('branch/recover/'.$b->id) }}" class="btn btn-xs btn-default">回收</a>
                    </td>

                </tr>
                <tr class="success">
                    <td></td>
                    <th><span>联系人</span> </th>
                    <td>{{ $b->contact }}</td>
                    <th><span>手机</span></th>
                    <td>{{ $b->mobile }}</td>
                    <th><span>地址</span></th>
                    <td colspan="3">{{ $b->address }}</td>
                </tr>
                @endforeach


                </tbody>
            </table>
        </div>

        {{ $branch->appends( array('type_id' => Input::get('type_id'), 'area_id' => Input::get('area_id'), 'line_id' => Input::get('line_id')))->links() }}

    </div>

</div>
@stop