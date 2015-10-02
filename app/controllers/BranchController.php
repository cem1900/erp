<?php

// 网点类
//
class BranchController extends BaseController {

    // 构造方法
    //
    public function __construct()
    {
        parent::__construct();
    }

    // 网店列表
    //
    public function getIndex()
    {
        // 区域
        //
        $area = Area::all();

        // 线路
        //
        $line = Line::all();

        // 客户类型
        //
        $type = Type::all();

        $whereRaw = ' 1=1 ';

        $type_id = Input::get('type_id');
        $area_id = Input::get('area_id');
        $line_id = Input::get('line_id');

        $name    = Input::get('name');
        $code    = Input::get('code');
        $contact = Input::get('contact');

        if ($type_id)
        {
            $whereRaw .= "and type_id = $type_id ";
        }

        if ($area_id)
        {
            $whereRaw .= "and area_id = $area_id ";
        }

        if ($line_id)
        {
            $whereRaw .= "and line_id = $line_id ";
        }

        if ($name)
        {
            $whereRaw .= "and name like '%{$name}%' ";
        }

        if ($code)
        {
            $whereRaw .= "and code like '%{$code}%' ";
        }

        if ($contact)
        {
            $whereRaw .= "and contact like '%{$contact}%' ";
        }

        // 管理员
        //
        if (Auth::user()->grade == 10)
        {
            $branch = Branch::where('user_id', Auth::user()->id)->whereRaw($whereRaw)->paginate();
            $count  = Branch::where('user_id', Auth::user()->id)->whereRaw($whereRaw)->count();
        }
        else
        {
            $branch = Branch::whereRaw($whereRaw)->paginate();
            $count  = Branch::whereRaw($whereRaw)->count();
        }

        return View::make('branch.index')->with(compact('area'))->with(compact('line'))->with(compact('type'))->with('branch', $branch)->with(compact('count'));
    }

    // 查看网点信息
    //
    public function getView($BranchId)
    {
        return View::make('branch.view')->with('branch', Branch::find($BranchId))->with('branchgood', BranchGood::where('branch_id', '=', $BranchId)->orderBy('created_at', 'desc')->paginate())->with('last_branch_good', BranchGood::where('branch_id', '=', $BranchId)->orderBy('created_at', 'desc')->first());
    }

    // 添加网店
    //
    public function getAdd()
    {
        // 区域
        //
        $area = Area::all();

        // 线路
        //
        $line = Line::all();

        // 客户类型
        //
        $type = Type::all();

        // 业务员
        //
        $users = User::where('grade', '10')->where('disable', '0')->get();

        return View::make('branch.add')->with(compact('area'))->with(compact('line'))->with(compact('type'))->with(compact('users'));
    }

    // 添加网点处理
    //
    public function postAdd()
    {

        $validator = Validator::make(Input::all(), Branch::$rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/add')
                ->withErrors($validator)
                ->withInput();
        }

        $branch          = new Branch;
        $branch->name    = Input::get('name');
        $branch->type_id = Input::get('type_id');
        $branch->area_id = Input::get('area_id');
        $branch->line_id = Input::get('line_id');
        $branch->user_id = Input::get('user_id');
        $branch->contact = Input::get('contact');
        $branch->mobile  = Input::get('mobile');

        $type = Type::find(Input::get('type_id'));
        $area = Area::find(Input::get('area_id'));
        $line = Line::find(Input::get('line_id'));

        $branch->day = $type->day;

        $sourceNumber = DB::table('branch')->max('id');
        $newNumber    = $this->__codeNumber($sourceNumber);

        if (Input::get('stock') > 0)
        {
            $branch->stock = Input::get('stock');
        }

        $branch->code          = $type->code . $area->code . $line->code . $newNumber;
        $branch->address       = $area->name . $line->name . Input::get('address');
        $branch->last_visit_at = $branch->last_ship_at = $this->__time();

        $branch->check = '1';

        $branch->save();

//        if (Input::get('stock') > 0)
//        {
//            $branch_good             = new BranchGood();
//            $branch_good->branch_id  = $branch->id;
//            $branch_good->pay_status = '0';
//            $branch_good->stock      = Input::get('stock');
//            $branch_good->memo       = Input::get('memo');
//            $branch_good->save();
//        }

        return Redirect::to('branch')->with('success', '网点添加成功！');
    }

    // 编辑网点
    //
    public function getEdit($BranchId)
    {
        // 区域
        //
        $area = Area::all();

        // 线路
        //
        $line = Line::all();

        // 客户类型
        //
        $type = Type::all();

        // 业务员
        //
        $users = User::where('grade', '10')->where('disable', '0')->get();

        return View::make('branch.edit')->with('branch', Branch::find($BranchId))->with(compact('area'))->with(compact('line'))->with(compact('type'))->with(compact('users'));
    }

    // 编辑网点处理
    //
    public function postEdit($BranchId)
    {
        Branch::$rules['name'] = 'required|min:2|unique:branch,name,' . $BranchId;
        $validator             = Validator::make(Input::all(), Branch::$rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/edit/' . $BranchId)
                ->withErrors($validator)
                ->withInput();
        }

        $branch          = Branch::find($BranchId);
        $branch->name    = Input::get('name');
        $branch->type_id = Input::get('type_id');
        $branch->area_id = Input::get('area_id');
        $branch->line_id = Input::get('line_id');
        $branch->user_id = Input::get('user_id');
        $branch->contact = Input::get('contact');
        $branch->mobile  = Input::get('mobile');

        $type = Type::find(Input::get('type_id'));
        $area = Area::find(Input::get('area_id'));
        $line = Line::find(Input::get('line_id'));

        $branch->day = $type->day;

        $newNumber = $this->__codeNumber($BranchId - 1);

        $branch->code    = $type->code . $area->code . $line->code . $newNumber;
        $branch->address = Input::get('address');
        $branch->save();

        return Redirect::to('branch')->with('success', '网点更新成功！');
    }

    // 区域列表
    //
    public function getArea()
    {
        return View::make('branch.area')->with('area', Area::paginate())->with('count', Area::count());
    }

    // 添加区域
    //
    public function getAreaAdd()
    {
        return View::make('branch.area-add');
    }

    // 添加区域处理
    //
    public function postAreaAdd()
    {
        $validator = Validator::make(Input::all(), Area::$rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/area-add')
                ->withErrors($validator)
                ->withInput();
        }

        $area       = new Area;
        $area->name = Input::get('name');
        $area->code = Input::get('code');
        $area->save();

        return Redirect::to('branch/area')
            ->with('success', '区域添加成功！');
    }

    // 客户区域编辑
    //
    public function getAreaEdit($AreaId)
    {
        return View::make('branch.area-edit')->with('area', Area::find($AreaId));
    }

    // 客户区域编辑处理
    //
    public function postAreaEdit($AreaId)
    {
        $rules = array(
            'name' => 'required|min:2|unique:area,name,' . $AreaId,
            'code' => 'required|unique:area,code,' . $AreaId
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/area-edit/' . $AreaId)
                ->withErrors($validator)
                ->withInput();
        }

        $area       = Area::find($AreaId);
        $area->name = Input::get('name');
        $area->code = Input::get('code');
        $area->save();

        return Redirect::to('branch/area')->with('success', '区域更新成功！');
    }

    // 客户类型列表
    //
    public function getType()
    {
        return View::make('branch.type')->with('type', Type::paginate())->with('count', Type::count());
    }

    // 添加客户类型
    //
    public function getTypeAdd()
    {
        return View::make('branch.type-add');
    }

    // 添加客户类型处理
    //
    public function postTypeAdd()
    {
        $validator = Validator::make(Input::all(), Type::$rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/type-add')
                ->withErrors($validator)
                ->withInput();
        }

        $type       = new Type;
        $type->name = Input::get('name');
        $type->code = Input::get('code');
        $type->day  = Input::get('day');
        $type->save();

        return Redirect::to('branch/type')->with('success', '客户类型添加成功！');
    }

    // 客户类型编辑
    //
    public function getTypeEdit($TypeId)
    {
        return View::make('branch.type-edit')->with('type', Type::find($TypeId));
    }

    // 可以类型编辑处理
    //
    public function postTypeEdit($TypeId)
    {
        $rules = array(
            'name' => 'required|min:2|unique:type,name,' . $TypeId,
            'code' => 'required|unique:type,code,' . $TypeId
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/type-edit/' . $TypeId)
                ->withErrors($validator)
                ->withInput();
        }

        $type       = Type::find($TypeId);
        $type->name = Input::get('name');
        $type->code = Input::get('code');
        $type->day  = Input::get('day');
        $type->save();

        return Redirect::to('branch/type')->with('success', '客户类型更新成功！');
    }

    // 线路列表
    //
    public function getLine()
    {
        return View::make('branch.line')->with('line', Line::paginate())->with('count', Line::count());
    }

    // 添加线路
    //
    public function getLineAdd()
    {
        return View::make('branch.line-add');
    }

    // 添加线路
    //
    public function postLineAdd()
    {
        $validator = Validator::make(Input::all(), Line::$rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/line-add')
                ->withErrors($validator)
                ->withInput();
        }

        $line       = new Line;
        $line->name = Input::get('name');
        $line->code = Input::get('code');
        $line->save();

        return Redirect::to('branch/line')->with('success', '线路添加成功！');
    }

    // 线路编辑
    //
    public function getLineEdit($LineId)
    {
        return View::make('branch.line-edit')->with('line', Line::find($LineId));
    }

    // 线路编辑处理
    //
    public function postLineEdit($LineId)
    {
        $rules = array(
            'name' => 'required|min:2|unique:line,name,' . $LineId,
            'code' => 'required|unique:line,code,' . $LineId
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/line-edit/' . $LineId)
                ->withErrors($validator)
                ->withInput();
        }

        $line       = Line::find($LineId);
        $line->name = Input::get('name');
        $line->code = Input::get('code');
        $line->save();

        return Redirect::to('branch/line')->with('success', '线路更新成功！');
    }

    // 添加回访
    //
    public function getVisitAdd($BranchId)
    {
        // 网点信息
        //
        $branch = Branch::find($BranchId);

        return View::make('branch.visit-add')->with(compact('branch'));
    }

    // 添加回访处理
    //
    public function postVisitAdd()
    {
        $branch_id = Input::get('branch_id');
        $branch    = Branch::find($branch_id);

        $validator = Validator::make(Input::all(), Visit::$rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/visit-add/' . $branch_id)
                ->withErrors($validator)
                ->withInput();
        }

        $visit            = new Visit();
        $visit->branch_id = $branch_id;
        $visit->user_id   = $branch->user_id;
        $visit->comment   = Input::get('comment');
        $visit->visit_at  = $this->__time();
        $visit->check     = '0';
        $visit->save();

        // 重置最后回访时间
        //
        $branch->last_visit_at = $visit->visit_at;
        $branch->save();

        return Redirect::to('branch')->with('success', '回访添加成功！');

    }

    // 全部回访记录
    //
    public function getVisitAll()
    {
        // 管理员
        //
        if (Auth::user()->grade == 10)
        {
            $visit = Visit::where('user_id', Auth::user()->id)->orderBy('visit_at', 'desc')->paginate();
            $count = Visit::where('user_id', Auth::user()->id)->orderBy('visit_at', 'desc')->count();
        }
        else
        {
            $visit = Visit::orderBy('visit_at', 'desc')->paginate();
            $count = Visit::orderBy('visit_at', 'desc')->count();

        }

        return View::make('branch.visit-all')->with('visit', $visit)->with(compact('count'));
    }

    // 回访记录
    //
    public function getVisit($BranchId)
    {
        return View::make('branch.visit')->with('branch', Branch::find($BranchId))->with('visit', Visit::where('branch_id', '=', $BranchId)->orderBy('visit_at', 'desc')->paginate())->with('count', Visit::where('branch_id', '=', $BranchId)->count());
    }

    // 审核回访
    //
    public function getVisitCheck($VisitId)
    {
        $visit        = Visit::find($VisitId);
        $visit->check = '1';
        $visit->save();

        return Redirect::to('branch/visit-all')->with('success', '回访审核成功！');
    }

    // 出货记录
    //
    public function getPicking($BranchId)
    {
        return View::make('branch.picking')->with('branch', Branch::find($BranchId))->with('delivery', Delivery::where('branch_id', '=', $BranchId)->orderBy('t_begin', 'desc')->paginate())->with('count', Delivery::where('branch_id', '=', $BranchId)->count());
    }

    // 合同列表
    //
    public function getRenewedList($BranchId)
    {
        return View::make('branch.renewed-list')->with('branch', Branch::find($BranchId))->with('branchgood', BranchGood::where('branch_id', '=', $BranchId)->orderBy('created_at', 'desc')->paginate())->with('last_branch_good', BranchGood::where('branch_id', '=', $BranchId)->orderBy('created_at', 'desc')->first())->with('count', BranchGood::where('branch_id', '=', $BranchId)->count());
    }

    // 续签合同，增加合同量
    //
    public function getRenewed($BranchId)
    {
        return View::make('branch.renewed')->with('branch', Branch::find($BranchId));
    }

    // 续签合同处理
    //
    public function postRenewed($BranchId)
    {
        $rules = array(
            'stock' => 'required|integer',
            'memo'  => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/renewed/' . $BranchId)
                ->withErrors($validator)
                ->withInput();
        }

        $branch        = Branch::find($BranchId);
        $branch->stock = $branch->stock + Input::get('stock');
        $branch->save();

        $branch_good             = new BranchGood();
        $branch_good->branch_id  = $branch->id;
        $branch_good->pay_status = '0';
        $branch_good->stock      = Input::get('stock');
        $branch_good->memo       = Input::get('memo');
        $branch_good->save();

        return Redirect::to('branch')->with('success', '创建合同成功！');
    }

    // 修改合同量
    //
    public function getRenewedEdit($BranchGoodId)
    {
        $branchgood = BranchGood::find($BranchGoodId);

        return View::make('branch.renewed-edit')->with('branch', Branch::find($branchgood->branch_id))->with('branchgood', $branchgood);
    }

    // 修改合同量 处理
    //
    public function postRenewedEdit($BranchGoodId)
    {
        $rules = array(
            'stock' => 'required|integer',
            'memo'  => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/renewed-edit/' . $BranchGoodId)
                ->withErrors($validator)
                ->withInput();
        }

        $branch_good        = BranchGood::find($BranchGoodId);
        $old_stock          = $branch_good->stock;
        $branch_good->stock = Input::get('stock');
        $branch_good->memo  = Input::get('memo');
        $branch_good->save();

        $branch        = Branch::find($branch_good->branch_id);
        $branch->stock = $branch->stock - $old_stock + Input::get('stock');
        $branch->save();

        return Redirect::to('branch')->with('success', '修改合同成功！');
    }

    // 回收统计
    //
    public function getRecover($BranchId)
    {
        return View::make('branch.recover')->with('branch_good_items', BranchGoodItems::where('branch_id', '=', $BranchId)->with('good')->paginate())->with('branch', Branch::find($BranchId));
    }

    // 回收空瓶记录 2014.05.26
    //
    public function getRecoverEmptyList($BranchId, $GoodId)
    {
        $empty = GoodEmpty::where('branch_id', $BranchId)->where('good_id', $GoodId)->orderBy('created_at', 'desc')->paginate();

        return View::make('branch.recover-empty-list')->with('branch', Branch::find($BranchId))->with('empty', $empty);
    }


    // 回收空瓶 2014.05.24
    //
    public function getRecoverEmpty($recoverId)
    {
        $recover = BranchGoodItems::find($recoverId);

        return View::make('branch.recover-empty')->with('branch', Branch::find($recover->branch_id))->with('recover', $recover);
    }

    // 空瓶处理
    //
    public function postRecoverEmpty($recoverId)
    {
        $rules = array(
            'num' => 'required|integer'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/recover-empty/' . $recoverId)
                ->withErrors($validator)
                ->withInput();
        }

        $recover = BranchGoodItems::find($recoverId);
        $good    = Good::find($recover->good_id);
        $num     = Input::get('num') * $good->unit;

        if ($num > ($recover->sell - $recover->empty))
        {
            return Redirect::to('branch/recover-empty/' . $recoverId)->with('error', '兑换数量不能大于销售数量！');
        }

        if (Input::get('mode') == 1 && (Input::get('num') < $good->empty_unit))
        {
            return Redirect::to('branch/recover-empty/' . $recoverId)->with('error', '兑换数量基数不够，兑不到一箱酒！！');
        }

        $recover->empty = $recover->empty + $num;
        $recover->save();

        $good_empty            = new GoodEmpty();
        $good_empty->good_id   = $recover->good_id;
        $good_empty->branch_id = $recover->branch_id;
        $good_empty->empty     = $num;
        $good_empty->mode      = Input::get('mode');

        if (Input::get('mode') == 2)
        {
            $good_empty->money = $num * 3;
        }

        $good_empty->save();

        if (Input::get('mode') == 1)
        {
            return Redirect::to('branch/recover-empty-warehouse/' . $good_empty->id)->with('success', '选择仓库进行兑换！');
        }

        return Redirect::to('branch/recover/' . $recoverId)->with('success', '兑换成功！');
    }

    // 回收选择仓库 2014.05.24
    //
    public function getRecoverEmptyWarehouse($goodEmptyId)
    {
        $good_empty = GoodEmpty::find($goodEmptyId);
        $branch     = Branch::find($good_empty->branch_id);
        $warehouse  = Warehouse::all();

        return View::make('branch.recover-empty-warehouse')->with(compact('warehouse'))->with(compact('branch'))->with(compact('good_empty'));
    }

    // 选择批次
    //
    public function getRecoverEmptyGood($goodEmptyId)
    {
        $good_empty = GoodEmpty::find($goodEmptyId);
        $branch     = Branch::find($good_empty->branch_id);
        $warehouse  = Warehouse::find(Input::get('warehouse_id'));
        $products   = Product::where('store', '>', 0)->where('price', '>', 0)->where('warehouse_id', $warehouse->id)->where('good_id', '=', $good_empty->good_id)->get();

        return View::make('branch.recover-empty-good')->with(compact('products'))->with(compact('branch'))->with(compact('warehouse'));
    }

    // 批次生成发货单 2014.05.24
    //
    public function postRecoverEmptyGood($goodEmptyId)
    {
        $good_empty = GoodEmpty::find($goodEmptyId);
        $branch     = Branch::find($good_empty->branch_id);

        $delivery               = new Delivery();
        $delivery->bn           = date("YmdHis", time()) . $this->random(4, 1);
        $delivery->ship_name    = $branch->name;
        $delivery->ship_addr    = $branch->address;
        $delivery->ship_mobile  = $branch->mobile;
        $delivery->t_begin      = $this->__time();
        $delivery->branch_id    = $branch->id;
        $delivery->user_id      = Auth::user()->id;
        $delivery->money        = '0';
        $delivery->status       = '1';
        $delivery->pay_status   = '0';
        $delivery->warehouse_id = Input::get('warehouse_id');
        $delivery->type         = '1';
        $delivery->save();

        $good_info = Good::find($good_empty->good_id);

        // 计算实际兑换量
        //
        $empty_num = floor(($good_empty->empty / $good_info->unit) / $good_info->empty_unit);
        $empty     = $empty_num * $good_info->unit;

        $good_info->empty = $good_info->empty + $empty;
        $good_info->store = $good_info->store - $empty;
        $good_info->save();

        $product_info        = Product::find(Input::get('item_id'));
        $product_info->empty = $product_info->empty + $empty;
        $product_info->store = $product_info->store - $empty;
        $product_info->save();

        $delivery_item               = new DeliveryItems();
        $delivery_item->delivery_id  = $delivery->id;
        $delivery_item->branch_id    = $branch->id;
        $delivery_item->good_id      = $good_info->id;
        $delivery_item->product_id   = $product_info->id;
        $delivery_item->good_name    = $good_info->name;
        $delivery_item->spec_info    = '';
        $delivery_item->number       = $empty;
        $delivery_item->presentation = 0;
        $delivery_item->price        = 0;
        $delivery_item->money        = 0;
        $delivery_item->life_date    = $product_info->life_date;
        $delivery_item->warehouse_id = $product_info->warehouse_id;
        $delivery_item->save();

        // 日志
        //
        $this->__goodLog($good_info->id, $product_info->id, 'empty');

        $branch->last_visit_at = $branch->last_ship_at = $this->__time();
        $branch->save();

        $good_empty->delivery_id = $delivery->id;
        $good_empty->save();

        return Redirect::to('picking/view/' . $delivery->id)->with('success', '兑换成功！');
    }


    // 回收瓶盖 2014.06.10
    //
    public function getRecoverCapsule($recoverId)
    {
        $recover = BranchGoodItems::find($recoverId);

        $capsule_unit = $recover->good->capsule_unit;

        $capsule = explode('|', $capsule_unit);

        return View::make('branch.recover-capsule')->with('branch', Branch::find($recover->branch_id))->with('recover', $recover)->with('capsule', $capsule);
    }

    // 回收瓶盖 2014.06.10
    //
    public function postRecoverCapsule($recoverId)
    {

        $rules = array(
            'num' => 'required|integer'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('branch/recover-capsule/' . $recoverId)
                ->withErrors($validator)
                ->withInput();
        }

        $recover = BranchGoodItems::find($recoverId);
        $num     = Input::get('num');

        if ($num > ($recover->sell - $recover->capsule))
        {
            return Redirect::to('branch/recover-capsule/' . $recoverId)->with('error', '回收数量不能大于销售数量！');
        }

        $price = Input::get('price');

        if ($price == 'z')
        {
            $custom_price = Input::get('custom_price');

            if (empty($custom_price))
            {
                return Redirect::to('branch/recover-capsule/' . $recoverId)->with('error', '请输入自定义价格！');
            }

            $price = $custom_price;
        }

        $recover->capsule = $recover->capsule + $num;
        $recover->save();

        $good_capsule            = new GoodCapsule();
        $good_capsule->good_id   = $recover->good_id;
        $good_capsule->branch_id = $recover->branch_id;
        $good_capsule->capsule   = $num;
        $good_capsule->price     = $price;
        $good_capsule->money     = $price * $num;
        $good_capsule->save();

        return Redirect::to('branch/recover/' . $recoverId)->with('success', '回收成功！');
    }

    // 回收瓶盖记录 2014.06.10
    //
    public function getRecoverCapsuleList($BranchId, $GoodId)
    {
        $capsule = GoodCapsule::where('branch_id', $BranchId)->where('good_id', $GoodId)->orderBy('created_at', 'desc')->paginate();

        return View::make('branch.recover-capsule-list')->with('branch', Branch::find($BranchId))->with('capsule', $capsule);
    }

    // 获取数值位数
    //
    private function __codeNumber($sourceNumber)
    {
        return substr(strval($sourceNumber + 10001), 1, 4);
    }

}
