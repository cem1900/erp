@extends('layouts')

@section('title')
管理首页 ::
@parent
@stop

@section('script_src')
@stop

@section('script')
@parent
<script>
</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">管理首页 <small>你好 , {{ Auth::user()->username }} ！</small></h1>

        @include('notifications')

    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bell fa-fw"></i>
                @if ($notice->count() >= 1)
                未读提醒 <span style="color: red">{{ $notice->count() }}</span> 条
                @else
                暂时没有未读提醒
                @endif
            </div>

            <div class="panel-body">
                <div class="list-group">
                    @foreach ($notice as $n)
                    <a href="{{ URL::to('notice/read/'.$n->id) }}" class="list-group-item">
                        <i class="fa fa-comment fa-fw"></i> {{ $n->content }}
                        <span class="small" style="color: red;">未读</span>
                        <span class="pull-right text-muted small"><em>{{ time_format($n->timeline) }}</em></span>
                    </a>
                    @endforeach
                </div>

                <a href="{{ URL::to('notice') }}" class="btn btn-default btn-block">查看所有提醒</a>
            </div>
        </div>

        <div class="panel panel-default">

            <div class="panel-heading">
                <i class="fa fa-sitemap fa-fw"></i> 网点

<!--                <div class="pull-right">-->
<!--                    <div class="btn-group">-->
<!--                        <a href="{{ URL::to('branch') }}" class="btn btn-default btn-outline btn-xs">-->
<!--                            网点列表-->
<!--                        </a>-->
<!---->
<!--                        @if (Auth::user()->grade == 1)-->
<!--                        <a href="{{ URL::to('branch/add') }}" class="btn btn-default btn-outline btn-xs">-->
<!--                            添加网点-->
<!--                        </a>-->
<!--                        <a href="{{ URL::to('branch/area') }}" class="btn btn-default btn-outline btn-xs">-->
<!--                            区域管理-->
<!--                        </a>-->
<!--                        <a href="{{ URL::to('branch/type') }}" class="btn btn-default btn-outline btn-xs">-->
<!--                            客户类型-->
<!--                        </a>-->
<!--                        <a href="{{ URL::to('branch/line') }}" class="btn btn-default btn-outline btn-xs">-->
<!--                            线路维护-->
<!--                        </a>-->
<!--                        @endif-->
<!--                    </div>-->
<!--                </div>-->
            </div>

            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover" >
                    <thead>
                    <tr>
                        <th>网点</th>
                        <th>网点编码</th>
                        <th>网点区域</th>
                        <th>客户类型</th>
                        <th>联系人</th>
                        <th>手机</th>
                        <th>业务员</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($branch as $b)
                    <tr>
                        <td><a href="{{ URL::to('branch/view/'.$b->id) }}">{{ $b->code }}</a></td>
                        <td><a href="{{ URL::to('branch/view/'.$b->id) }}">{{ $b->name }}</a></td>
                        <td>{{ $b->area->name }}</td>
                        <td>{{ $b->type->name }}</td>
                        <td>{{ $b->contact }}</td>
                        <td>{{ $b->mobile }}</td>
                        <td>{{ $b->user->username }}</td>

                        <td>
                            @if (Auth::user()->grade == 1 || Auth::user()->grade == 10 )
                            <a href="{{ URL::to('picking/warehouse-select/'.$b->id) }}" class="btn btn-xs btn-danger">出货</a>
                            <a href="{{ URL::to('branch/visit-add/'.$b->id) }}" class="btn btn-xs btn-success">回访</a>
                            @endif
                        </td>

                    </tr>
                    @endforeach


                    </tbody>
                </table>

                <a href="{{ URL::to('branch') }}" class="btn btn-default btn-block">查看所有网点</a>
            </div>

        </div>

        <div class="panel panel-default">

            <div class="panel-heading">
                <i class="fa fa-cogs fa-fw"></i> 库存不足货品

<!--                <div class="pull-right">-->
<!--                    <div class="btn-group">-->
<!--                        <a href="{{ URL::to('goods') }}" class="btn btn-default btn-outline btn-xs">-->
<!--                            货品列表-->
<!--                        </a>-->
<!---->
<!--                        @if (Auth::user()->grade == 1)-->
<!--                        <a href="{{ URL::to('goods/add') }}" class="btn btn-default btn-outline btn-xs">-->
<!--                            添加货品-->
<!--                        </a>-->
<!--                        @endif-->
<!--                    </div>-->
<!--                </div>-->
            </div>

            <div class="panel-body">
                <table class="table table-striped table-condensed table-hover" >
                    <thead>
                    <tr>
                        <th>货品</th>
                        <th>条码</th>
                        <th>进货数量</th>
                        <th>销售数量</th>
                        <th>当前库存</th>
                        <th>损耗数量</th>
                        <th>货品批次</th>
                        @if (Auth::user()->grade == 1)
                        <th>操作</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($goods as $g)
                    <tr
                    @if ($g->store == 0 )
                    class="danger"
                    @endif
                    >
                        <td>{{ $g->name }}</td>
                        <td>{{ $g->barcode }}</td>
                        <td>{{ h_unit($g->purchase, $g->unit) }}</td>
                        <td>{{ h_unit($g->sell, $g->unit) }}</td>
                        <td>{{ h_unit($g->store, $g->unit) }}</td>
                    <td>{{ h_unit($g->damage, $g->unit) }}</td>
                    <td>
                        <a href="{{ URL::to('goods/list/'.$g->id) }}" class="btn btn-xs btn-default">查看货品批次</a>
                    </td>

                        @if (Auth::user()->grade == 1 || Auth::user()->grade == 5 )
                        <td>
                            <a href="{{ URL::to('goods/purchase/'.$g->id) }}" class="btn btn-xs btn-danger">进货</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach

                    </tbody>
                </table>

                <a href="{{ URL::to('goods') }}" class="btn btn-default btn-block">查看所有货品</a>
            </div>
        </div>


    </div>

</div>

@stop
