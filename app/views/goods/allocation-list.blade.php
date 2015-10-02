@extends('layouts')

@section('title')
调拨列表 ::
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
            调拨列表
            <small>共 {{ $count }} 次调拨</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品管理</a></li>
            <li class="active">调拨列表</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>货品</th>
                    <th>批次</th>
                    <th>新仓</th>
                    <th>原始仓</th>
                    <th>调拨数量</th>
                    <th>调拨时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($allocation as $a)
                <tr>
                    <td>{{ $a->good->name }}</td>
                    <td>
                        {{ date("Y-m-d", strtotime($a->fromProduct->production_date)) }}
                    </td>
                    <td>{{ $a->toWarehouse->name }}</td>
                    <td>{{ $a->fromWarehouse->name }}</td>
                    <td>
                        {{ h_unit($a->num , $a->good->unit) }}
                    </td>
                    <td>{{ $a->created_at }}</td>
                    <td>
                        @if ($a->allocation_status == '0')
                        <span class="label label-primary">未确认</span>a
                        @elseif ($a->allocation_status == '1')
                        <span class="label label-info">已确认</span>
                        @endif
                    </td>
                    <td>
                        @if ($a->allocation_status == '0')
                        @if (Auth::user()->grade == 1 || ( Auth::user()->grade == 6 && $a->to_warehouse_id ==
                        $admin_warehouse ))
                        <a href="{{ URL::to('goods/allocation-done/'.$a->id) }}" class="btn btn-xs btn-primary">确认</a>
                        @endif
                        @endif
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $allocation->links() }}

    </div>

</div>
@stop