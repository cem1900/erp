@extends('layouts')

@section('title')
回收空瓶记录 ::
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
            回收空瓶记录
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">回收空瓶记录</li>
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
                        <th>货品</th>
                        <th>时间</th>
                        <th>回收量</th>
                        <th>回收方式</th>
                        <th>详情</th>

                    </tr>
                </thead>
                <tbody>

                @foreach ($empty as $e)
                <tr>
                    <td>{{ $e->good->name }}</td>
                    <td>{{ $e->created_at }}</td>
                    <td>{{ h_unit($e->empty, $e->good->unit) }}</td>
                    <td>
                        @if ($e->mode == '1')
                        空瓶换酒
                        @elseif($e->mode == '2')
                        空瓶换钱
                        @elseif($e->mode == '3')
                        直接退瓶
                        @endif
                    </td>
                    <td>
                        @if ($e->mode == '1')
                        <a href="{{ URL::to('picking/view/'.$e->delivery_id) }}">查看出货单</a>
                        @elseif($e->mode == '2')
                        退换总额： ￥{{ number_format($e->money, 2) }}
                        @elseif($e->mode == '3')

                        @endif
                    </td>

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $empty->links() }}

    </div>

</div>
@stop