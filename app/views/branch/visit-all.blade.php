@extends('layouts')

@section('title')
回访列表 ::
@parent
@stop


@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            回访列表 <small>共 {{ $count }} 个回访记录</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li class="active">回访列表</li>
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
                        <th>回访网点</th>
                        <th>回访时间</th>
                        <th>回访内容</th>
                        <th>回访人</th>
                        <th>状态</th>
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

                    <td>{{ $v->branch->name }}</td>

                    <td>{{ $v->visit_at }}</td>

                    <td>{{ $v->comment }}</td>

                    <td>{{ $v->user->username }}</td>


                    <td>
                        @if ($v->check == '0')
                        <span class="label label-danger">未审核</span>

                        @if (Auth::user()->grade == 1 || Auth::user()->grade == 7)
                        <a href="{{ URL::to('branch/visit-check/'.$v->id) }}" class="btn btn-xs btn-primary">审核</a>
                        @endif

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