@extends('layouts')

@section('title')
仓库列表 ::
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
                <a href="{{ URL::to('goods/warehouse-add') }}">
                    <button type="button" class="btn btn-primary">添加仓库</button>
                </a>
                @endif
            </span>

            仓库列表 <small>共 {{ $count }} 个仓库</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li class="active">仓库列表</li>
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
                        <th>管理员</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($warehouse as $w)
                <tr>

                <td>{{ $w->name }} </td>

                <td>{{ $w->user->username }} </td>
                    <td>
                        <a href="{{ URL::to('goods/warehouse-edit/'.$w->id) }}" class="btn btn-xs btn-primary">修改</a>
                    </td>

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>



    </div>

</div>
@stop