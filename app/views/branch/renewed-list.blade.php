@extends('layouts')

@section('title')
合同列表 ::
@parent
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
            <span class="pull-right">

                <a href="{{ URL::to('branch/renewed/'.$branch->id) }}">
                    <button type="button" class="btn btn-primary">合同</button>
                </a>

            </span>

            合同列表 <small>共 {{ $count }} 个合同记录</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">合同列表</li>
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
            <strong>手机：</strong>{{ $branch->mobile }} <br/>
            <strong>余量：</strong>{{ $branch->stock }}
        </div>

        <div class="table-responsive">
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
        </div>

        {{ $branchgood->links() }}

    </div>

</div>
@stop