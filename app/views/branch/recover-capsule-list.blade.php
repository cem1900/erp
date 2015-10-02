@extends('layouts')

@section('title')
回收瓶盖记录 ::
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
            回收瓶盖记录
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">回收瓶盖记录</li>
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
                        <th>回收单价</th>
                        <th>回收总价</th>

                    </tr>
                </thead>
                <tbody>

                @foreach ($capsule as $c)
                <tr>
                    <td>{{ $c->good->name }}</td>
                    <td>{{ $c->created_at }}</td>
                    <td>{{ $c->capsule }} 个</td>
                    <td>
                        ￥{{ number_format($c->price, 2) }}
                    </td>
                    <td>

                        ￥{{ number_format($c->money, 2) }}

                    </td>

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $capsule->links() }}

    </div>

</div>
@stop