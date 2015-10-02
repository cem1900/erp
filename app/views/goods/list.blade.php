@extends('layouts')

@section('title')
货品批次列表 ::
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
                <a href="{{ URL::to('goods/purchase/'.$good->id) }}">
                    <button type="button" class="btn btn-primary">进货</button>
                </a>
                @endif
            </span>

            货品批次列表 <small>共 {{ $count }} 个货品批次</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品列表</a></li>
            <li class="active">货品批次列表</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info">
            <strong>货品：</strong>{{ $good->name }} <br/>
            <strong>每箱：</strong>{{ $good->unit }}瓶 <br/>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover" >
                <thead>
                    <tr>

                        <th>仓库</th>
                        <th>生产日期</th>
                        <th>保质期</th>
                        <th>进货日期</th>
                        <th>过期日期</th>
                        <th>进货</th>
                        <th>销售</th>
                        <th>库存</th>
                        <th>损耗</th>
                        <th>兑换</th>
                        <th>进货价格</th>
                        <th>销售价格</th>
                        @if (Auth::user()->grade == 1 || Auth::user()->grade == 5 )
                        <th>设置</th>
                        @endif
                        @if (Auth::user()->grade == 1 || Auth::user()->grade == 6 )
                        <th>修改</th>
                        <th>调拨</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                @foreach ($products as $p)
                <tr
                    @if ($p->store == 0 )
                class="danger"
                    @endif
                >

                <td>{{ $p->warehouse->name }}</td>
                <td>{{ date("Y-m-d", strtotime($p->production_date)) }}</td>
                <td>{{ $p->life }} 天</td>
                <td>{{ date("Y-m-d", strtotime($p->cost_date)) }}</td>
                <td>{{ date("Y-m-d", strtotime($p->life_date)) }}</td>
                    <td>
                        @if ($p->purchase == 0)
                        <span class="label label-warning">调</span>
                        @else
                        {{ h_unit($p->purchase, $good->unit) }}
                        @endif
                    </td>
                    <td>{{ h_unit($p->sell, $good->unit) }}</td>
                    <td>{{ h_unit($p->store, $good->unit) }}
                    </td>
                    <td>{{ h_unit($p->damage, $good->unit) }}</td>
                    <td>{{ h_unit($p->empty, $good->unit) }}</td>
                    <td>￥{{ number_format($p->cost, 2) }} 每箱</td>
                    <td>￥{{ number_format($p->price, 2) }} 每箱</td>
                @if (Auth::user()->grade == 1 || Auth::user()->grade == 5 )
                    <td>
                        <a href="{{ URL::to('goods/price/'.$p->id) }}" class="btn btn-xs btn-danger">价格</a>
                    </td>
                @endif

                @if (Auth::user()->grade == 1 || Auth::user()->grade == 6 )
                <td>
                    @if ($p->sell == 0 && $p->damage == 0 && $p->purchase > 0)
                    @if (Auth::user()->grade == 1 || ( Auth::user()->grade == 6 && $p->warehouse_id ==
                    $admin_warehouse ))
                    <a href="{{ URL::to('goods/purchase-edit/'.$p->id) }}" class="btn btn-xs btn-danger">数量</a>
                    @endif
                    @endif
                </td>

                <td>
                    @if ($p->store > 0 && $p->purchase > 0)
                    @if (Auth::user()->grade == 1 || ( Auth::user()->grade == 6 && $p->warehouse_id ==
                    $admin_warehouse ))
                    <a href="{{ URL::to('goods/allocation/'.$p->id) }}" class="btn btn-xs btn-danger">调拨</a>
                    @endif
                    @endif
                </td>
                @endif

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $products->links() }}

    </div>

</div>
@stop