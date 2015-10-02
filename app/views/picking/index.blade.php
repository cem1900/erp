@extends('layouts')

@section('title')
出货单列表 ::
@parent
@stop

@section('script_src')
<!-- <script src="{{{ asset('assets/js/plugins/dataTables/jquery.dataTables.js') }}}"></script>
<script src="{{{ asset('assets/js/plugins/dataTables/dataTables.bootstrap.js') }}}"></script> -->
@stop

@section('script')
@parent
<script>
    // $(document).ready(function() {
    //     $('#dataTables-example').dataTable();
    // });
</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">


            出货单列表 <small>共 {{ $count }} 个出货记录</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li class="active">出货单列表</li>
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
                        <th>仓库</th>
                        <th>类型</th>
                        <th>出货时间</th>
                        <th>网点</th>
                        <th>出货单号</th>
                        <th>纸质单号</th>

                        <th>总价</th>
                        <th>状态</th>
                        <th>支付</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($delivery as $d)
                <tr>
                    <td>{{ $d->warehouse->name }}</td>
                    <td>
                        @if ($d->type == '0')
                        <span class="label label-primary">普通</span>
                        @elseif ($d->type == '1')
                        <span class="label label-info">空瓶换酒</span>
                        @endif
                    </td>

                    <td>{{ $d->t_begin }}</td>
                    <td>{{ $d->branch->name }}</td>
                    <td>{{ $d->bn }}</td>
                    <td>{{ $d->real_bn }}</td>

                    <td>￥{{ number_format($d->money, 2) }}</td>
                    <td>
                        @if ($d->status == '1')
                        <span class="label label-primary">配货中</span>
                        @elseif ($d->status == '2')
                        <span class="label label-info">配送中</span>
                        @elseif ($d->status == '3')
                        <span class="label label-success">已完成</span>
                        @endif
                    </td>

                    <td>
                        @if ($d->pay_status == '0')
                        <span class="label label-primary">未支付</span>
                        @elseif ($d->pay_status == '1')
                        <span class="label label-info">已支付</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ URL::to('picking/view/'.$d->id) }}" class="btn btn-xs btn-primary">查看出货单</a>

                        @if ($d->status == '1')
                        @if (Auth::user()->grade == 1 || Auth::user()->grade == 6)
                        <a href="{{ URL::to('picking/confirm/'.$d->id) }}" class="btn btn-xs btn-danger">确认</a>
                        @endif
                        @elseif ($d->status == '2')
                        @if (Auth::user()->grade == 1 || Auth::user()->grade == 5)
                        <a href="{{ URL::to('picking/done/'.$d->id) }}" class="btn btn-xs btn-warning">完成</a>
                        @endif
                        @endif

                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $delivery->links() }}

    </div>

</div>
@stop