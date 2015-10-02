@extends('layouts')

@section('title')
货品列表 ::
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
        <h1 class="page-header">
            <span class="pull-right">
                @if (Auth::user()->grade == 1 || Auth::user()->grade == 6)
                <a href="{{ URL::to('goods/add') }}">
                    <button type="button" class="btn btn-primary">添加货品</button>
                </a>
                @endif
            </span>

            货品列表 <small>共 {{ $count }} 个货品</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li class="active">货品列表</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover" >
                <thead>
                    <tr>
                        <th>货品</th>
                        <th>条码</th>
                        <th>每箱</th>
                        <th>进货数量</th>
                        <th>销售数量</th>
                        <th>当前库存</th>
                        <th>损耗数量</th>
                        <th>兑换数量</th>
                        <th>货品批次</th>

                        @if (Auth::user()->grade == 1 || Auth::user()->grade == 6)
                        <th>操作</th>
                        @endif

                        @if (Auth::user()->grade == 1 || Auth::user()->grade == 5)
                        <th>回收设置</th>
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
                    <td>{{ $g->unit }} 瓶</td>
                    <td>{{ h_unit($g->purchase, $g->unit) }}</td>
                    <td>{{ h_unit($g->sell, $g->unit) }}</td>
                    <td>{{ h_unit($g->store, $g->unit) }}</td>
                    <td>{{ h_unit($g->damage, $g->unit) }}</td>
                    <td>{{ h_unit($g->empty, $g->unit) }}</td>
                    <td>
                        <a href="{{ URL::to('goods/list/'.$g->id) }}" class="btn btn-xs btn-default">查看货品批次</a>
                    </td>

                    @if (Auth::user()->grade == 1 || Auth::user()->grade == 6)
                    <td>
                        <a href="{{ URL::to('goods/edit/'.$g->id) }}" class="btn btn-xs btn-primary">修改</a>
                        <a href="{{ URL::to('goods/purchase/'.$g->id) }}" class="btn btn-xs btn-danger">进货</a>
                        @if ($g->store)
                        <a href="{{ URL::to('goods/damage/'.$g->id) }}" class="btn btn-xs btn-warning">报损</a>
                        @endif
                    </td>
                    @endif

                @if (Auth::user()->grade == 1 || Auth::user()->grade == 5)
                <td>
                    <a href="{{ URL::to('goods/empty/'.$g->id) }}" class="btn btn-xs btn-primary">空瓶</a>
                    <a href="{{ URL::to('goods/capsule/'.$g->id) }}" class="btn btn-xs btn-primary">瓶盖</a>
                </td>
                @endif

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $goods->links() }}

    </div>

</div>
@stop