@extends('layouts')

@section('title')
网点出货 ::
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
            网点出货
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li><a href="{{ URL::to('picking/warehouse-select/'.$branch->id) }}">选择仓库</a></li>
            <li class="active">网点出货</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    @if ($products->count() >= 1)

    <div class="col-lg-12">

        <div class="alert alert-info">
            <strong>网点：</strong>{{ $branch->name }} <br/>
            <strong>地址：</strong>{{ $branch->address }} <br/>
            <strong>手机：</strong>{{ $branch->mobile }} <br/>
            <strong>仓库：</strong>{{ $warehouse->name }}
            <hr/>
            <strong>操作：</strong> 选择货品 -> 加入出货清单 -> <span style="color: red;" >确认货品清单</span> -> 生成出货单
        </div>

        <div class="panel panel-default ">

            <div class="panel-body">

        <form  role="form" method="post" action="{{ URL::to('picking/add-item') }}">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}"/>

            <div class="form-group clearfix {{{ $errors->has('item_id') ? 'has-error' : '' }}}">
                <label for="item_id" class="col-sm-2 control-label">货品选择</label>

                <div class="col-sm-10">

                    <select name="item_id" id="item_id" class="form-control">
                        @foreach ($products as $p)
                        <option value="{{ $p->id }}">{{ $p->good->name }} 生产日期:{{ date("Y-m-d", strtotime($p->production_date)) }}, 存库:{{ h_unit($p->store, $p->good->unit) }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ $errors->first('item_id') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('item_num') ? 'has-error' : '' }}}">
                <label for="item_num" class="col-sm-2 control-label">出货数量</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="不填默认为1,不能大于现有库存数量！ 单位：箱！" name="item_num" id="item_num"
                           value="{{{ Input::old('item_num') }}}"/>

                    <span class="help-block">{{{ $errors->first('item_num') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('presentation_num') ? 'has-error' : '' }}}">
                <label for="presentation_num" class="col-sm-2 control-label">赠送数量</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="单位：箱！" name="presentation_num" id="presentation_num"
                           value="{{{ Input::old('presentation_num') }}}"/>

                    <span class="help-block">{{{ $errors->first('presentation_num') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('item_price') ? 'has-error' : '' }}}">
                <label for="item_price" class="col-sm-2 control-label">出货价格</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="出货价格,不填默认为商品销售价格。每箱单价！" name="item_price" id="item_price"
                           value="{{{ Input::old('item_price') }}}"/>

                    <span class="help-block">{{{ $errors->first('item_price') }}}</span>
                </div>
            </div>

            <input type="hidden" name="order_id" value="{{{ $order_id }}}"/>
            <input type="hidden" name="branch_id" value="{{{ $branch->id }}}"/>

            <input type="hidden" name="warehouse_id" value="{{{ $warehouse->id }}}"/>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">加入出货清单</button>
                    <hr/>
                    <a href="{{ URL::to('branch') }}">
                        <button type="button" class="btn btn-default btn-lg btn-block">取消出货</button>
                    </a>
                </div>
            </div>

        </form>


            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-default ">
            <div class="panel-heading">
                出货清单 （总价：￥{{ number_format($items_price, 2) }}）
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>货品</th>
                            <th>数量</th>
                            <th>赠送</th>
                            <th>单价</th>
                            <th>总价</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($items as $i)
                        <tr>
                            <td>{{ $i['name'] }}</td>
                            <td>{{ $i['num'] }} 箱</td>
                            <td>{{ $i['presentation_num'] }} 箱</td>
                            <td>￥{{ number_format($i['price'], 2) }}</td>
                            <td>￥{{ number_format($i['price'] * $i['num'], 2) }}</td>

                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

                <form role="form" method="post" action="{{ URL::to('picking/create') }}">

                    <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}"/>

                    <input type="hidden" name="branch_id" value="{{{ $branch->id }}}"/>

                    <input type="hidden" name="items_price" value="{{{ $items_price }}}"/>

                    <input type="hidden" name="warehouse_id" value="{{{ $warehouse->id }}}"/>

                    <button type="submit" class="btn btn-success btn-lg btn-block" onclick="{if(confirm('确认出货清单后，确定生成出货单吗?')){this.document.formname.submit();return true;}return false;}">生成出货单</button>
                </form>

                <hr/>

                <form role="form" method="post" action="{{ URL::to('picking/empty') }}">

                    <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}"/>
                    <input type="hidden" name="branch_id" value="{{{ $branch->id }}}"/>

                    <input type="hidden" name="warehouse_id" value="{{{ $warehouse->id }}}"/>

                    <button type="submit" class="btn btn-default btn-lg btn-block">清空出货清单</button>
                </form>


            </div>
        </div>


    </div>
    @else
    <div class="col-lg-12">
    <div class="alert alert-warning">
        <strong>提示!</strong> 没有可以用的货品，请联系仓库管理员 <a href="{{ URL::to('goods') }}" class="alert-link">添加货品</a> ，或者补充货品库存！
    </div>
    </div>
    @endif

</div>
@stop