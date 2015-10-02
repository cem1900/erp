@extends('layouts')

@section('title')
提醒列表 ::
@parent
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            提醒列表 <small>共 {{ $count }} 个提醒</small>
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li class="active">提醒列表</li>
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
                        <th>提醒内容</th>
                        <th>提醒时间</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($notice as $n)
                <tr
                @if ($n->read == 0)
                class="warning"
                @endif
                >
                    <td>
                        <i class="fa fa-comment fa-fw"></i>
                        <a href="{{ URL::to('notice/read/'.$n->id) }}">
                        {{ $n->content }}
                        </a>
                        @if ($n->read == 0)
                        <span class="small" style="color: red;">未读</span>
                        @endif
                    </td>
                    <td>{{ time_format($n->timeline) }}</td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        {{ $notice->links() }}

    </div>

</div>
@stop