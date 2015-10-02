@extends('layouts')

@section('title')
续签合同 ::
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
            续签合同
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">续签合同</li>
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
                <label for="name" class="col-sm-3 control-label">网点</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="网点" name="name" id="name" value="{{{ Input::old('name', $branch->name) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('name') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('stock') ? 'has-error' : '' }}}">
                <label for="stock" class="col-sm-3 control-label">合同销量</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="签订合同客户填写合同销量" name="stock" id="stock" value="{{{ Input::old('stock') }}}" />

                    <span class="help-block">{{{ $errors->first('stock') }}}</span>
                </div>
            </div>



            <div class="form-group clearfix {{{ $errors->has('memo') ? 'has-error' : '' }}}">
                <label for="memo" class="col-sm-3 control-label">客户备注</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="5" placeholder="合同备注！" name="memo" id="memo">{{{ Input::old('memo') }}}</textarea>

                    <span class="help-block">{{{ $errors->first('memo') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">续签</button>
                    <a href="{{ URL::to('branch') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>

    </div>

</div>
@stop