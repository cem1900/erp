@extends('layouts')

@section('title')
出货单详情 ::
@parent
@stop

@section('styles_src')

@stop

@section('script_src')
<script src="{{{ asset('assets/js/jquery.PrintArea.js') }}}"></script>
@stop

@section('script')
@parent

<script type="text/javascript">
    $(function () {
        $("#btnPrint").click(function () {
            $("#printContent").printArea();
        });
    });
</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <span class="pull-right">

                <a href="{{ URL::to('branch/picking/'.$delivery->branch_id) }}">
                    <button type="button" class="btn btn-primary">出货单列表</button>
                </a>

            </span>
            出货单详情
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">出货单详情</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">


    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive">
                    <div id="printContent">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th class="text-center" colspan="4"><h1>出货单</h1></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td width="15%">收货单位：</td>
                                <td>{{ $delivery->ship_name }}</td>
                                <td width="15%">出货单号：</td>
                                <td>{{ $delivery->bn }}
                                    @if ($delivery->type == '1')
                                    <span class="label label-info">空瓶换酒</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="15%">单据日期：</td>
                                <td>{{ date("Y-m-d", strtotime($delivery->t_begin)) }}</td>
                                <td width="15%">手机号码：</td>
                                <td>{{ $delivery->ship_mobile }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>

                            <tr>
                                <th width="40%">货品</th>
                                <th width="20%">数量</th>
                                <th width="20%">赠送</th>
                                <th width="20%">单价</th>
                                <th width="20%">总价</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($delivery->items as $i)
                            <tr>
                                <td>{{ $i->good_name }}</td>
                                <td>{{ h_unit($i->number, $i->good->unit) }}</td>
                                <td>{{ h_unit($i->presentation, $i->good->unit) }}</td>
                                <td>￥{{ number_format($i->price, 2) }}</td>
                                <td>￥{{ number_format($i->money, 2) }}</td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table class="table table-condensed">
                            <tbody>
                            <tr>
                                <td width="15%">合计：</td>
                                <td colspan="3">￥{{ number_format($delivery->money, 2) }}</td>
                            </tr>

                            <tr>
                                <td width="15%">制单人：</td>
                                <td>{{ $user_info->username }}</td>
                                <td width="15%">手机号码：</td>
                                <td>{{ $user_info->mobile }}</td>
                            </tr>

                            <tr>
                                <td width="15%">收货人确认签字：</td>
                                <td colspan="3"></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <button type="button" id="btnPrint" class="btn btn-primary btn-lg btn-block">打印出货单</button>

            </div>
        </div>


    </div>


</div>
@stop