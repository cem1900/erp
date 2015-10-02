@extends('layouts')

@section('title')
编辑客户类型 ::
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
            编辑客户类型
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li><a href="{{ URL::to('branch/type') }}">客户类型列表</a></li>
            <li class="active">编辑客户类型</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <form class="col-sm-6" role="form" method="post">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}" />

            <div class="form-group clearfix {{{ $errors->has('name') ? 'has-error' : '' }}}">
                <label for="name" class="col-sm-3 control-label">客户类型</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="客户类型" name="name" id="name" value="{{{ Input::old('name', $type->name) }}}" />

                    <span class="help-block">{{{ $errors->first('name') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('code') ? 'has-error' : '' }}}">
                <label for="code" class="col-sm-3 control-label">客户编码</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="编码" name="code" id="code" value="{{{ Input::old('code', $type->code) }}}" />

                    <span class="help-block">{{{ $errors->first('code') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('day') ? 'has-error' : '' }}}">
                <label for="day" class="col-sm-3 control-label">提醒周期</label>
                <div class="col-sm-9">
                    <select name="day" id="day" class="form-control">

                        <option value="2"
                        @if ($type->day == 2)
                        selected
                        @endif
                            >2天</option>
                        <option value="3"
                        @if ($type->day == 3)
                        selected
                        @endif
                            >3天</option>
                        <option value="4"
                        @if ($type->day == 4)
                        selected
                        @endif
                            >4天</option>
                        <option value="5"
                        @if ($type->day == 5)
                        selected
                        @endif
                            >5天</option>
                        <option value="6"
                        @if ($type->day == 6)
                        selected
                        @endif
                            >6天</option>
                        <option value="7"
                        @if ($type->day == 7)
                        selected
                        @endif
                            >7天</option>
                        <option value="8"
                        @if ($type->day == 8)
                        selected
                        @endif
                            >8天</option>
                        <option value="9"
                        @if ($type->day == 9)
                        selected
                        @endif
                            >9天</option>
                        <option value="10"
                        @if ($type->day == 10)
                        selected
                        @endif
                            >10天</option>
                        <option value="11"
                        @if ($type->day == 11)
                        selected
                        @endif
                            >11天</option>
                        <option value="12"
                        @if ($type->day == 12)
                        selected
                        @endif
                            >12天</option>
                        <option value="13"
                        @if ($type->day == 13)
                        selected
                        @endif
                            >13天</option>
                        <option value="14"
                        @if ($type->day == 14)
                        selected
                        @endif
                            >14天</option>
                        <option value="15"
                        @if ($type->day == 15)
                        selected
                        @endif
                            >15天</option>
                        <option value="16"
                        @if ($type->day == 16)
                        selected
                        @endif
                            >16天</option>
                        <option value="17"
                        @if ($type->day == 17)
                        selected
                        @endif
                            >17天</option>
                        <option value="18"
                        @if ($type->day == 18)
                        selected
                        @endif
                            >18天</option>
                        <option value="19"
                        @if ($type->day == 19)
                        selected
                        @endif
                            >19天</option>
                        <option value="20"
                        @if ($type->day == 20)
                        selected
                        @endif
                            >20天</option>
                        <option value="21"
                        @if ($type->day == 21)
                        selected
                        @endif
                            >21天</option>
                        <option value="22"
                        @if ($type->day == 22)
                        selected
                        @endif
                            >22天</option>
                        <option value="23"
                        @if ($type->day == 23)
                        selected
                        @endif
                            >23天</option>
                        <option value="24"
                        @if ($type->day == 24)
                        selected
                        @endif
                            >24天</option>
                        <option value="25"
                        @if ($type->day == 25)
                        selected
                        @endif
                            >25天</option>
                        <option value="26"
                        @if ($type->day == 26)
                        selected
                        @endif
                            >26天</option>
                        <option value="27"
                        @if ($type->day == 27)
                        selected
                        @endif
                            >27天</option>
                        <option value="28"
                        @if ($type->day == 28)
                        selected
                        @endif
                            >28天</option>
                        <option value="29"
                        @if ($type->day == 29)
                        selected
                        @endif
                            >29天</option>
                        <option value="30"
                        @if ($type->day == 30)
                        selected
                        @endif
                            >30天</option>


                    </select>

                    <span class="help-block">{{{ $errors->first('day') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">更新</button>
                    <a href="{{ URL::to('branch/type') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>
    </div>

</div>
@stop