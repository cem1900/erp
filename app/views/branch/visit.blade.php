@extends('layouts')

@section('title')
回访列表 ::
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

                <a href="{{ URL::to('branch/visit-add/'.$branch->id) }}">
                    <button type="button" class="btn btn-primary">添加回访</button>
                </a>

            </span>

            回访列表 <small>共 {{ $count }} 个回访记录</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">回访列表</li>
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
                        <th>回访时间</th>
                        <th>回访内容</th>
                        <th>回访状态</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($visit as $v)
                <tr
                @if ($v->check == '0')
                class="danger"

                @elseif ($v->check == '1')
                class="success"
                @endif
                >

                    <td>{{ $v->visit_at }}</td>
                    <td>{{ $v->comment }}</td>
                    <td>
                        @if ($v->check == '0')
                        <span class="label label-danger">未审核</span>

                        @elseif ($v->check == '1')
                        <span class="label label-info">已审核</span>
                        @endif
                    </td>

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $visit->links() }}

    </div>

</div>
@stop