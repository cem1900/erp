@extends('layouts')

@section('title')
批量打印 ::
@parent
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

    $(function () {
        $url = "{{ URL::to('picking/print') }}";

        $('#print_search').click(function () {
            $warehouse_id = $('#warehouse_id').val();
            $user_id = $('#user_id').val();
            $href = '?warehouse_id=' + $warehouse_id + '&user_id=' + $user_id;
            $('#print_search').attr("href", $href);
        });

    });
</script>

@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            批量打印
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li class="active">批量打印</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">


        <div class="table-responsive">

            <table class="table table-condensed">
                <tbody>
                <tr>
                    <td>
                        <select name="warehouse_id" id="warehouse_id" class="form-control">
                            <option value="0">选择仓库</option>
                            @foreach ($warehouse as $w)
                            <option value="{{ $w->id }}"
                            @if ($w->id == Input::get('warehouse_id'))
                            selected
                            @endif
                            >{{ $w->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="0">选择业务员</option>
                            @foreach ($users as $u)
                            <option value="{{ $u->id }}"
                            @if ($u->id == Input::get('user_id'))
                            selected
                            @endif
                            >{{ $u->username }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <a href="{{ URL::to('picking/print') }}" id="print_search">
                            <button type="button" class="btn btn-info btn-block">搜索</button>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>

            <hr/>

            @if ($count_prints)
            <div id="printContent">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th colspan="2">仓库 : {{ $warehouse_name }}</th>
                        <th colspan="2">业务员 : {{ $user_name }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($prints as $p)
                    <tr>
                        <td>网点 : {{ $p->ship_name }}</td>
                        <td>时间 : {{ date("Y-m-d", strtotime($p->t_begin)) }}</td>
                        <td>手机 : {{ $p->ship_mobile }}</td>
                        <td>地址 : {{ $p->ship_addr }}</td>
                    </tr>

                    @foreach ($p->items as $i)
                    <tr>
                        <td>货品 : {{ $i->good_name }}</td>
                        <td>数量 : {{ h_unit($i->number, $i->good->unit) }}</td>
                        <td>赠送 : {{ h_unit($i->presentation, $i->good->unit) }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <button type="button" id="btnPrint" class="btn btn-primary btn-lg btn-block">打印</button>

            @else

            <div class="alert alert-warning">
                <strong>提示!</strong> 没有可打印的数据，请选择对应的选项进行搜索！
            </div>

            @endif
        </div>


    </div>

</div>
@stop