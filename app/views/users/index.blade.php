@extends('layouts')

@section('title')
员工列表 ::
@parent
@stop

@section('styles_src')

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
                @if (Auth::user()->grade == 1)
                <a href="{{ URL::to('users/newaccount') }}">
                    <button type="button" class="btn btn-primary">添加员工</button>
                </a>
                @endif
            </span>

            员工列表 <small>共 {{ $count }} 个员工</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li class="active">员工列表</li>
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
                        <th>姓名</th>
                        <th>手机号码</th>
                        <th>最近登录时间</th>
                        <th>权限</th>
                        @if (Auth::user()->grade == 1)
                        <th>操作</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                @foreach ($users as $u)
                <tr>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->mobile }}</td>
                    <td>{{ $u->last_signin_at }}</td>
                    <td>
                        @if ($u->grade == 1)
                        <span class="label label-danger">管理员</span>
                        @elseif ($u->grade == 5)
                        <span class="label label-warning">财务管理员</span>
                        @elseif ($u->grade == 6)
                        <span class="label label-success">仓库管理员</span>
                        @elseif ($u->grade == 7)
                        <span class="label label-primary">审核管理员</span>
                        @else
                        <span class="label label-info">业务员</span>
                        @endif
                    </td>

                    @if (Auth::user()->grade == 1)
                    <td>
                        <a href="{{ URL::to('users/edit/'. $u->id) }}" class="btn btn-xs btn-primary">修改</a>
                    </td>
                    @endif

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>
@stop
