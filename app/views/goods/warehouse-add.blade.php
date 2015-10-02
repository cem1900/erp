@extends('layouts')

@section('title')
添加仓库 ::
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
            添加仓库
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods/warehouse-all') }}">仓库列表</a></li>
            <li class="active">添加仓库</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        @if ($users->count() >= 1)

        <form class="col-sm-6" role="form" method="post">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}" />

            <div class="form-group clearfix {{{ $errors->has('name') ? 'has-error' : '' }}}">
                <label for="name" class="col-sm-3 control-label">仓库名称</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="仓库名称" name="name" id="name" value="{{{ Input::old('name') }}}" />

                    <span class="help-block">{{{ $errors->first('name') }}}</span>
                </div>
            </div>


            <div class="form-group clearfix {{{ $errors->has('user_id') ? 'has-error' : '' }}}">
                <label for="user_id" class="col-sm-3 control-label">管理员</label>
                <div class="col-sm-9">

                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($users as $u)
                        <option value="{{ $u->id }}" >{{ $u->username }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ $errors->first('user_id') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">创建</button>
                    <a href="{{ URL::to('goods/warehouse-all') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>
        @else
        <div class="alert alert-warning">
            <strong>提示!</strong> 请先 <a href="{{ URL::to('users/newaccount') }}" class="alert-link">请先添加仓库管理员</a>.
        </div>
        @endif
    </div>

</div>
@stop