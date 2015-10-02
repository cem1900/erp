@extends('layouts')

@section('title')
回收统计 ::
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
            回收统计
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">回收统计</li>
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
                        <th>销售量</th>
                        <th>空瓶回收</th>
                        <th>瓶盖回收</th>
                        <th>回收操作</th>
                        <th>回收记录</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($branch_good_items as $b)
                <tr>
                    <td>{{ $b->good->name }}</td>
                    <td>{{ h_unit($b->sell, $b->good->unit) }}</td>
                    <td>{{ h_unit($b->empty, $b->good->unit) }}</td>
                    <td>{{ $b->capsule }} 个</td>
                    <td>
                        <a href="{{ URL::to('branch/recover-empty/'.$b->id) }}" class="btn btn-xs btn-primary">空瓶</a>
                        <a href="{{ URL::to('branch/recover-capsule/'.$b->id) }}" class="btn btn-xs btn-success">瓶盖</a>
                    </td>

                    <td>
                        <a href="{{ URL::to('branch/recover-empty-list/'.$b->branch_id.'/'.$b->branch_id) }}" class="btn btn-xs btn-default">空瓶</a>
                        <a href="{{ URL::to('branch/recover-capsule-list/'.$b->branch_id.'/'.$b->branch_id) }}" class="btn btn-xs btn-default">瓶盖</a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $branch_good_items->links() }}

    </div>

</div>
@stop