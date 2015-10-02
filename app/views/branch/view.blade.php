@extends('layouts')

@section('title')
网点详情 ::
@parent
@stop

@section('styles_src')

@stop

@section('script_src')

@stop

@section('script')
@parent

@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">

            网点详情
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点列表</a></li>
            <li class="active">网点详情</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="table-responsive">

            <table class="table table-striped table-condensed table-hover"  >
                <tbody>
                <tr>
                    <th>网点编码</th>
                    <td>{{ $branch->code }}</td>
                    <th>网点</th>
                    <td>{{ $branch->name }}</td>
                </tr>
                <tr>
                    <th>客户类型</th>
                    <td>{{ $branch->type->name }}</td>
                    <th>网点区域</th>
                    <td>{{ $branch->area->name }}</td>
                </tr>
                <tr>
                    <th>客户线路</th>
                    <td>{{ $branch->line->name }}</td>
                    <th>合同余量</th>
                    <td>{{ $branch->stock }} 箱</td>
                </tr>
                <tr>
                    <th>业务员</th>
                    <td colspan="3">{{ $branch->user->username }}</td>
                </tr>

                <tr>
                    <th><span>联系人</span></th>
                    <td>{{ $branch->contact }}</td>
                    <th><span>手机</span></th>
                    <td>{{ $branch->mobile }}</td>
                </tr>
                <tr>
                    <th><span>地址</span></th>
                    <td colspan="3">{{ $branch->address }}</td>
                </tr>

                </tbody>
            </table>


            <hr />

            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th>合同量</th>
                    <th>合同备注</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($branchgood as $b)
                <tr>
                    <td>{{ $b->stock }}</td>
                    <td>{{ $b->memo }}</td>
                    <td>{{ $b->created_at }}</td>
                    <td>
                        @if ($last_branch_good->id == $b->id)

                        <a href="{{ URL::to('branch/renewed-edit/'.$b->id) }}" class="btn btn-xs btn-primary">修改合同量</a>
                        @endif
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>

            <a href="{{ URL::to('branch/renewed-list/'.$branch->id) }}" class="btn btn-default btn-block">查看所有合同列表</a>

            <a href="{{ URL::to('branch/picking/'.$branch->id) }}" class="btn btn-default btn-block">查看所有出货记录</a>

            <a href="{{ URL::to('branch/visit/'.$branch->id) }}" class="btn btn-default btn-block">查看所有回访记录</a>

        </div>

    </div>

</div>
@stop