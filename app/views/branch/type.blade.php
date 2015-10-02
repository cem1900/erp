@extends('layouts')

@section('title')
客户类型列表 ::
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
                @if (Auth::user()->grade < 10)
                <a href="{{ URL::to('branch/type-add') }}">
                    <button type="button" class="btn btn-primary">添加客户类型</button>
                </a>
                @endif
            </span>

            客户类型列表 <small>共 {{ $count }} 个类型</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">客户类型列表</li>
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

                        <th>客户类型</th>
                        <th>客户类型编码</th>
                        <th>回访提醒时间</th>
                        @if (Auth::user()->grade < 10)
                        <th>操作</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                @foreach ($type as $t)
                <tr>

                    <td>{{ $t->name }}</td>
                    <td>{{ $t->code }}</td>
                    <td>{{ $t->day }} 天</td>

                    <td>
                        <a href="{{ URL::to('branch/type-edit/'.$t->id) }}" class="btn btn-xs btn-primary">修改</a>
                    </td>

                </tr>
                @endforeach


                </tbody>
            </table>
        </div>

        {{ $type->links() }}

    </div>

</div>
@stop