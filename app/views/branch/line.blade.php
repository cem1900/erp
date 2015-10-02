@extends('layouts')

@section('title')
线路列表 ::
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
                @if (Auth::user()->grade < 10)
                <a href="{{ URL::to('branch/line-add') }}">
                    <button type="button" class="btn btn-primary">添加线路</button>
                </a>
                @endif
            </span>

            线路列表 <small>共 {{ $count }} 条线路</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">添加线路</li>
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

                        <th>线路</th>
                        <th>线路编码</th>
                        @if (Auth::user()->grade < 10)
                        <th>操作</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                @foreach ($line as $l)
                <tr>

                    <td>{{ $l->name }}</td>
                    <td>{{ $l->code }}</td>

                    <td>
                        <a href="{{ URL::to('branch/line-edit/'.$l->id) }}" class="btn btn-xs btn-primary">修改</a>
                    </td>

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $line->links() }}

    </div>

</div>
@stop