@extends('layouts')

@section('title')
添加网点 ::
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
            添加网点
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">添加网点</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        @if (($type->count() >= 1) && ($area->count() >= 1) && ($line->count() >= 1) && ($users->count() >= 1))
        <form class="col-sm-6" role="form" method="post">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}" />

            <div class="form-group clearfix {{{ $errors->has('name') ? 'has-error' : '' }}}">
                <label for="name" class="col-sm-3 control-label">网点</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="网点" name="name" id="name" value="{{{ Input::old('name') }}}" />

                    <span class="help-block">{{{ $errors->first('name') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('type_id') ? 'has-error' : '' }}}">
                <label for="type_id" class="col-sm-3 control-label">客户类型</label>
                <div class="col-sm-9">

                    <select name="type_id" id="type_id" class="form-control">
                        @foreach ($type as $t)
                        <option value="{{ $t->id }}" >{{ $t->name }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ $errors->first('type_id') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('area_id') ? 'has-error' : '' }}}">
                <label for="area_id" class="col-sm-3 control-label">区域</label>
                <div class="col-sm-9">

                    <select name="area_id" id="area_id" class="form-control">
                        @foreach ($area as $a)
                        <option value="{{ $a->id }}" >{{ $a->name }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ $errors->first('area_id') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('line_id') ? 'has-error' : '' }}}">
                <label for="line_id" class="col-sm-3 control-label">线路</label>
                <div class="col-sm-9">

                    <select name="line_id" id="line_id" class="form-control">
                        @foreach ($line as $l)
                        <option value="{{ $l->id }}" >{{ $l->name }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ $errors->first('line_id') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('user_id') ? 'has-error' : '' }}}">
                <label for="user_id" class="col-sm-3 control-label">业务员</label>
                <div class="col-sm-9">

                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($users as $u)
                        <option value="{{ $u->id }}" >{{ $u->username }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ $errors->first('user_id') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('contact') ? 'has-error' : '' }}}">
                <label for="contact" class="col-sm-3 control-label">联系人</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="联系人" name="contact" id="contact" value="{{{ Input::old('contact') }}}" />

                    <span class="help-block">{{{ $errors->first('contact') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('mobile') ? 'has-error' : '' }}}">
                <label for="mobile" class="col-sm-3 control-label">手机</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="手机" name="mobile" id="mobile" value="{{{ Input::old('mobile') }}}" />

                    <span class="help-block">{{{ $errors->first('mobile') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('address') ? 'has-error' : '' }}}">
                <label for="address" class="col-sm-3 control-label">地址</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="地址" name="address" id="address" value="{{{ Input::old('address') }}}" />

                    <span class="help-block">{{{ $errors->first('address') }}}</span>
                </div>
            </div>

<!--            <div class="form-group clearfix {{{ $errors->has('stock') ? 'has-error' : '' }}}">-->
<!--                <label for="stock" class="col-sm-3 control-label">合同销量</label>-->
<!--                <div class="col-sm-9">-->
<!--                    <input type="text" class="form-control" placeholder="签订合同客户填写合同销量" name="stock" id="stock" value="{{{ Input::old('stock') }}}" />-->
<!---->
<!--                    <span class="help-block">{{{ $errors->first('stock') }}}</span>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!---->
<!---->
<!--            <div class="form-group clearfix {{{ $errors->has('memo') ? 'has-error' : '' }}}">-->
<!--                <label for="memo" class="col-sm-3 control-label">客户备注</label>-->
<!--                <div class="col-sm-9">-->
<!---->
<!--                    <textarea class="form-control" rows="5" placeholder="客户备注！" name="memo" id="memo">{{{ Input::old('memo') }}}</textarea>-->
<!--                    <span class="help-block">{{{ $errors->first('memo') }}}</span>-->
<!--                </div>-->
<!--            </div>-->

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">创建</button>
                    <a href="{{ URL::to('branch') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>
        @else

        @if ($type->count() < 1)
        <div class="alert alert-warning">
            <strong>提示!</strong> 请先 <a href="{{ URL::to('branch/type-add') }}" class="alert-link">添加客户类型</a>.
        </div>
        @endif

        @if ($area->count() < 1)
        <div class="alert alert-warning">
            <strong>提示!</strong> 请先 <a href="{{ URL::to('branch/area-add') }}" class="alert-link">请先添加区域</a>.
        </div>
        @endif

        @if ($line->count() < 1)
        <div class="alert alert-warning">
            <strong>提示!</strong> 请先 <a href="{{ URL::to('branch/line-add') }}" class="alert-link">请先添加线路</a>.
        </div>
        @endif

        @if ($users->count() < 1)
        <div class="alert alert-warning">
            <strong>提示!</strong> 请先 <a href="{{ URL::to('users/newaccount') }}" class="alert-link">请先添加业务员</a>.
        </div>
        @endif

        @endif
    </div>

</div>
@stop