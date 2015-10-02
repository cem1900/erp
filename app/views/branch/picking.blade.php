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
            <span class="pull-right">

                <a href="{{ URL::to('picking/add/'.$branch->id) }}">
                    <button type="button" class="btn btn-primary">出货</button>
                </a>

            </span>

            出货单列表 <small>共 {{ $count }} 个出货记录</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">出货单列表</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info">
            <strong>网点：</strong>{{ $branch->name }} <br/>
            <strong>地址：</strong>{{ $branch->address }} <br/>
            <strong>手机：</strong>{{ $branch->mobile }}
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover" >
                <thead>
                    <tr>
                        <th>出货时间</th>
                        <th>出货单号</th>
                        <th>总价</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($delivery as $d)
                <tr>

                    <td>{{ $d->t_begin }}</td>
                    <td>{{ $d->bn }}</td>
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
                        <a href="{{ URL::to('picking/view/'.$d->id) }}" class="btn btn-xs btn-primary">查看出货单</a>

                        @if ($d->status == '1')
                        <a href="{{ URL::to('picking/confirm/'.$d->id) }}" class="btn btn-xs btn-danger">确认</a>
                        @elseif ($d->status == '2')
                        <a href="{{ URL::to('picking/done/'.$d->id) }}" class="btn btn-xs btn-warning">完成</a>
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