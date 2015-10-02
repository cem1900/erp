<?php

// 货品类
//
class GoodsController extends BaseController {

    // 构造方法
    //
    public function __construct()
    {
        parent::__construct();
    }

    // 货品列表
    //
    public function getIndex()
    {
        return View::make('goods.index')->with('goods', Good::orderBy('store')->paginate())->with('count', Good::count());
    }

    // 添加货品
    //
    public function getAdd()
    {
        return View::make('goods.add');
    }

    // 添加货品处理
    //
    public function postAdd()
    {
        $rules            = array();
        $rules['name']    = 'required|min:2|unique:goods';
        $rules['barcode'] = 'min:2|unique:goods';
        $rules['unit']    = 'required|integer';

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/add')
                ->withErrors($validator)
                ->withInput();
        }

        $good              = new Good;
        $good->name        = Input::get('name');
        $good->barcode     = Input::get('barcode');
        $good->purchase    = 0;
        $good->sell        = 0;
        $good->store       = 0;
        $good->damage      = 0;
        $good->replacement = 0;
        $good->unit        = Input::get('unit');

        $good->save();

        // 日志
        //
        $this->__goodLog($good->id, 0, 'new');

        return Redirect::to('goods')->with('success', '货品添加成功！');
    }

    // 查看批次
    //
    public function getList($GoodId)
    {
        $admin_warehouse = '0';

        if (Auth::user()->grade == 6)
        {
            $admin_warehouse = Warehouse::getUserWarehouseId(Auth::user()->id);
        }

        return View::make('goods.list')->with('good', Good::find($GoodId))->with('products', Product::with('warehouse')->where('good_id', $GoodId)->orderBy('production_date', 'desc')->paginate())->with('count', Product::where('good_id', $GoodId)->count())->with('admin_warehouse', $admin_warehouse);
    }

    // 进货
    //
    public function getPurchase($GoodId)
    {
        return View::make('goods.purchase')->with('good', Good::find($GoodId));
    }

    // 进货处理
    //
    public function postPurchase($GoodId)
    {
        // 验证
        //
        Good::$rules['name']    = '';
        Good::$rules['barcode'] = '';
        Good::$rules['cost']    = '';
        Good::$rules['price']   = '';

        $validator = Validator::make(Input::all(), Good::$rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/purchase/' . $GoodId)
                ->withErrors($validator)
                ->withInput();
        }

        // 货品更新总库存
        //
        $good           = Good::find($GoodId);
        $good->purchase = $good->purchase + (Input::get('store') * Input::get('unit'));
        $good->store    = $good->store + (Input::get('store') * Input::get('unit'));
        $good->save();

        // 批次处理
        //
        $product_id = $this->_newProduct($good->id);

        // 日志
        //
        $this->__goodLog($good->id, $product_id, 'purchase');

        return Redirect::to('goods/list/' . $GoodId)->with('success', '进货成功！');

    }

    // 修改货品
    //
    public function getEdit($goodId)
    {
        return View::make('goods.edit')->with('good', Good::find($goodId));
    }

    // 修改货品处理
    //
    public function postEdit($goodId)
    {
        $rules['name']    = 'required|min:2|unique:goods,name,' . $goodId;
        $rules['barcode'] = 'min:2|unique:goods,barcode,' . $goodId;

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/edit/' . $goodId)
                ->withErrors($validator)
                ->withInput();
        }

        $good          = Good::find($goodId);
        $good->name    = Input::get('name');
        $good->barcode = Input::get('barcode');

        $good->save();

        // 日志
        //
        $this->__goodLog($good->id, 0, 'edit');

        return Redirect::to('goods')->with('success', '货品修改成功！');
    }

    // 货品批次新增
    //
    private function _newProduct($goodId)
    {
        // 货品批次
        //
        $product              = new Product();
        $product->good_id     = $goodId;
        $product->purchase    = Input::get('store') * Input::get('unit');
        $product->sell        = 0;
        $product->store       = Input::get('store') * Input::get('unit');
        $product->cost        = 0;
        $product->price       = 0;
        $product->damage      = 0;
        $product->replacement = 0;

        // 仓库
        //
        if (Auth::user()->grade == 1)
        {
            $product->warehouse_id = 1;
        }
        else
        {
            $warehouse = Warehouse::where('user_id', Auth::user()->id)->first();

            $product->warehouse_id = $warehouse->id;
        }

        $product->production_date = Input::get('production_date');
        $product->life            = Input::get('life');
        $product->cost_date       = $this->__time('now', 'Y-m-d');

        $product->life_date = date("Y-m-d", (strtotime(Input::get('production_date')) + Input::get('life') * 3600 * 24));

        $product->save();

        return $product->id;
    }

    // 修改进货数量
    //
    public function getPurchaseEdit($ProductId)
    {
        return View::make('goods.purchase-edit')->with('product', Product::find($ProductId));
    }

    // 修改进货数量处理
    //
    public function postPurchaseEdit($ProductId)
    {

        $rules['purchase-new'] = 'required|numeric';

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/price/' . $ProductId)
                ->withErrors($validator)
                ->withInput();
        }

        $product      = Product::find($ProductId);
        $good         = Good::find($product->good_id);
        $old_purchase = $product->purchase;

        $product->purchase = Input::get('purchase-new') * $good->unit;
        $product->store    = $product->purchase;
        $product->save();

        $good->purchase = $good->purchase - $old_purchase + $product->purchase;
        $good->store    = $good->store - $old_purchase + $product->purchase;
        $good->save();

        // 日志
        //
        $this->__goodLog($product->good_id, $product->id, 'edit');

        return Redirect::to('goods/list/' . $product->good_id)->with('success', '货品价格设置成功！');
    }

    // 价格
    //
    public function getPrice($ProductId)
    {
        return View::make('goods.price')->with('product', Product::find($ProductId));
    }

    // 价格处理
    //
    public function postPrice($ProductId)
    {
        $rules['cost']  = 'required|numeric';
        $rules['price'] = 'required|numeric';

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/price/' . $ProductId)
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($ProductId);

        $product->cost  = Input::get('cost');
        $product->price = Input::get('price');
        $product->save();

        // 日志
        //
        $this->__goodLog($product->good_id, $product->id, 'price');

        return Redirect::to('goods/list/' . $product->good_id)->with('success', '货品价格设置成功！');

    }


    // 报损
    //
    public function getDamage($goodId)
    {
        return View::make('goods.damage')->with('good', Good::find($goodId))->with('products', Product::where('good_id', $goodId)->orderBy('production_date', 'desc')->get());
    }

    // 报损处理
    //
    public function postDamage($goodId)
    {

        $rules['damage_num'] = 'required|integer';
        $rules['damage_bn']  = 'required';

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/damage/' . $goodId)
                ->withErrors($validator)
                ->withInput();
        }

        $good = Good::find($goodId);

        $product = Product::find(Input::get('product_id'));

        $damage_num = Input::get('damage_num');

        if ($damage_num < 1)
        {
            $damage_num = 1;
        }

        if ($damage_num > $product->store)
        {
            $damage_num = $product->store;
        }

        $good->store  = $good->store - $damage_num;
        $good->damage = $good->damage + $damage_num;

        $good->save();

        $product->store  = $product->store - $damage_num;
        $product->damage = $product->damage + $damage_num;

        $product->save();

        $damage = new GoodDamage();

        $damage->good_id     = $good->id;
        $damage->product_id  = $product->id;
        $damage->damage      = $damage_num;
        $damage->damage_bn   = Input::get('damage_bn');
        $damage->user_id     = Auth::user()->id;
        $damage->damage_time = $this->__time();
        $damage->save();

        // 日志
        //
        $this->__goodLog($good->id, $product->id, 'damage');

        return Redirect::to('goods/list/' . $good->id)->with('success', '货品报损成功！');
    }

    // 仓库列表
    //
    public function getWarehouseAll()
    {
        return View::make('goods.warehouse-all')->with('warehouse', Warehouse::all())->with('count', Warehouse::count());
    }

    // 添加仓库
    //
    public function getWarehouseAdd()
    {
        // 管理员
        //
        $users = User::where('grade', '6')->where('disable', '0')->get();

        return View::make('goods.warehouse-add')->with(compact('users'));
    }

    // 添加仓库处理
    //
    public function postWarehouseAdd()
    {
        $validator = Validator::make(Input::all(), Warehouse::$rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/warehouse-add')
                ->withErrors($validator)
                ->withInput();
        }

        $warehouse          = new Warehouse;
        $warehouse->name    = Input::get('name');
        $warehouse->user_id = Input::get('user_id');

        $warehouse->save();

        return Redirect::to('goods/warehouse-all')->with('success', '仓库添加成功！');
    }

    // 修改仓库
    //
    public function getWarehouseEdit($WarehouseId)
    {
        // 管理员
        //
        $users = User::where('grade', '6')->where('disable', '0')->get();

        return View::make('goods/warehouse-edit')->with('warehouse', Warehouse::find($WarehouseId))->with(compact('users'));
    }

    // 修改仓库处理
    //
    public function postWarehouseEdit($WarehouseId)
    {
        $rules = array(
            'name'    => 'required|min:2|unique:warehouse,name,' . $WarehouseId,
            'user_id' => 'unique:warehouse,user_id,' . $WarehouseId,
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/warehouse-edit/' . $WarehouseId)
                ->withErrors($validator)
                ->withInput();
        }

        $warehouse = Warehouse::find($WarehouseId);

        $warehouse->name    = Input::get('name');
        $warehouse->user_id = Input::get('user_id');

        $warehouse->save();

        return Redirect::to('goods/warehouse-all')->with('success', '仓库更新成功！');
    }

    // 调拨列表
    //
    public function getAllocationList()
    {
        $admin_warehouse = '0';

        if (Auth::user()->grade == 6)
        {
            $admin_warehouse = Warehouse::getUserWarehouseId(Auth::user()->id);
        }

        return View::make('goods.allocation-list')->with('allocation', Allocation::with('good', 'toProduct', 'fromProduct', 'toWarehouse', 'fromWarehouse')->orderBy('created_at', 'desc')->paginate())->with('count', Allocation::count())->with('admin_warehouse', $admin_warehouse);
    }

    // 调拨
    //
    public function getAllocation($ProductId)
    {

        $product = Product::find($ProductId);

        $warehouse = Warehouse::where('id', '<>', $product->warehouse_id)->get();

        return View::make('goods.allocation')->with('warehouse', $warehouse)->with('product', $product)->with('good', Good::find($product->good_id));
    }

    // 调拨处理
    //
    public function postAllocation($ProductId)
    {
        $rules = array(
            'num' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/allocation/' . $ProductId)
                ->withErrors($validator)
                ->withInput();
        }

        $form_product = Product::find($ProductId);

        $good = Good::find($form_product->good_id);
        $num  = $good->unit * Input::get('num');

        // 减库存
        //
        if ($num > $form_product->store)
        {
            return Redirect::to('goods/allocation/' . $ProductId)->with('error', '调拨数量，不能大于现有库存数量！');
        }

        // $form_product->store = $form_product->store - $num;
        // $form_product->save();

//        $to_product                  = new Product();
//        $to_product->good_id         = $good->id;
//        $to_product->purchase        = 0;
//        $to_product->sell            = 0;
//        $to_product->store           = $num;
//        $to_product->cost            = $form_product->cost;
//        $to_product->price           = $form_product->price;
//        $to_product->damage          = 0;
//        $to_product->replacement     = 0;
//        $to_product->warehouse_id    = Input::get('warehouse_id');
//        $to_product->production_date = $form_product->production_date;
//        $to_product->life            = $form_product->life;
//        $to_product->cost_date       = $form_product->cost_date;
//        $to_product->life_date       = $form_product->life_date;
//        $to_product->save();

        $allocation                    = new Allocation();
        $allocation->good_id           = $good->id;
        $allocation->to_product_id     = '0';
        $allocation->from_product_id   = $form_product->id;
        $allocation->to_warehouse_id   = Input::get('warehouse_id');
        $allocation->from_warehouse_id = $form_product->warehouse_id;
        $allocation->num               = $num;
        $allocation->allocation_status = '0';
        $allocation->save();

        // 日志
        //
        // $this->__goodLog($good->id, $form_product->id, 'allocation');

        return Redirect::to('goods/list/' . $good->id)->with('success', '调拨成功！');

    }

    // 调拨确认
    //
    public function getAllocationDone($AllocationId)
    {
        $allocation = Allocation::find($AllocationId);

        $form_product        = Product::find($allocation->from_product_id);
        $form_product->store = $form_product->store - $allocation->num;
        $form_product->save();

        $to_product                  = new Product();
        $to_product->good_id         = $allocation->good_id;
        $to_product->purchase        = 0;
        $to_product->sell            = 0;
        $to_product->store           = $allocation->num;
        $to_product->cost            = $form_product->cost;
        $to_product->price           = $form_product->price;
        $to_product->damage          = 0;
        $to_product->replacement     = 0;
        $to_product->warehouse_id    = $allocation->to_warehouse_id;
        $to_product->production_date = $form_product->production_date;
        $to_product->life            = $form_product->life;
        $to_product->cost_date       = $form_product->cost_date;
        $to_product->life_date       = $form_product->life_date;
        $to_product->save();

        $allocation->to_product_id     = $to_product->id;
        $allocation->allocation_status = '1';
        $allocation->save();

        $this->__goodLog($allocation->good_id, $form_product->id, 'allocation');

        return Redirect::to('goods/allocation-list')->with('success', '确认调拨！');
    }

    // 设置空瓶兑换量 2014.05.22
    //
    public function getEmpty($goodId)
    {
        return View::make('goods.empty')->with('good', Good::find($goodId));
    }

    // 设置空瓶兑换量处理 2014.05.22
    //
    public function postEmpty($goodId)
    {
        $rules['empty_unit'] = 'required|integer';

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/empty/' . $goodId)
                ->withErrors($validator)
                ->withInput();
        }

        $good             = Good::find($goodId);
        $good->empty_unit = Input::get('empty_unit');
        $good->save();

        return Redirect::to('goods')->with('success', '货品 ' . $good->name . ' 空瓶兑换量设置成功！');
    }

    // 设置瓶盖兑换 2014.06.09
    //
    public function getCapsule($goodId)
    {
        return View::make('goods.capsule')->with('good', Good::find($goodId));
    }

    // 设置瓶盖兑换处理 2014.06.09
    //
    public function postCapsule($goodId)
    {
        $rules['capsule_unit'] = 'required';

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('goods/capsule/' . $goodId)
                ->withErrors($validator)
                ->withInput();
        }

        $good               = Good::find($goodId);
        $good->capsule_unit = Input::get('capsule_unit');
        $good->save();

        return Redirect::to('goods')->with('success', '货品 ' . $good->name . ' 瓶盖兑换费用设置成功！');
    }

}
