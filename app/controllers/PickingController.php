<?php

// 配送类
//
class PickingController extends BaseController {

    // 首页
    //
    public function getIndex()
    {
        // 管理员
        //
        if (Auth::user()->grade == 10)
        {
            $delivery = Delivery::where('user_id', Auth::user()->id)->orderBy('t_begin', 'desc')->paginate();
            $count    = Delivery::where('user_id', Auth::user()->id)->count();
        }
        else
        {
            if (Auth::user()->grade == 6)
            {
                $w = Warehouse::where('user_id', Auth::user()->id)->lists('id');

                $delivery = Delivery::whereIn('warehouse_id', $w)->orderBy('t_begin', 'desc')->paginate();

                $count = Delivery::whereIn('warehouse_id', $w)->count();

            }
            else
            {
                $delivery = Delivery::orderBy('t_begin', 'desc')->paginate();
                $count    = Delivery::count();
            }
        }

        return View::make('picking.index')->with('delivery', $delivery)->with(compact('count'));
    }

    // 出货
    //
    public function getAdd($BranchId)
    {
        if (!Input::get('warehouse_id'))
        {
            return Redirect::to('picking/warehouse-select/' . $BranchId)->with('error', '请先选择仓库！');
        }

        // 网点信息
        //
        $branch = Branch::find($BranchId);

        // 判断是否存在 配货单编号
        //
        if (Session::has('picking') && array_key_exists($BranchId, Session::get('picking')))
        {
            $picking  = Session::get('picking');
            $order_id = $picking[$BranchId]['order_id'];
            $items    = $picking[$BranchId]['items'];

            // 货品总价
            $items_price = 0;
            foreach ($items as $item)
            {
                $items_price += $item['num'] * $item['price'];
            }
        }
        else
        {
            // 配货单编号
            //
            $order_id = date("YmdHis", time()) . $this->random(4, 1);
            Session::put('picking.' . $BranchId . '.order_id', $order_id);
            $items       = array();
            $items_price = 0;
            Session::put('picking.' . $BranchId . '.items', $items);
        }

        // 仓库
        $warehouse = Warehouse::find(Input::get('warehouse_id'));

        // 获取商品列表
        //
        // $goods = Good::all();
        $products = Product::where('store', '>', 0)->where('price', '>', 0)->where('warehouse_id', $warehouse->id)->orderBy('good_id', 'desc')->get();

        return View::make('picking.add')->with(compact('products'))->with(compact('items'))->with(compact('order_id'))->with(compact('branch'))->with(compact('items_price'))->with(compact('warehouse'));
    }

    // 配货商品
    //
    public function postAddItem()
    {
        $picking = Session::get('picking');

        $branch_id = Input::get('branch_id');
        // $order_id  = Input::get('order_id');
        $item_id          = Input::get('item_id');
        $item_num         = Input::get('item_num') ? Input::get('item_num') : 1;
        $presentation_num = Input::get('presentation_num') ? Input::get('presentation_num') : 0;
        $item             = Product::find($item_id);
        $items            = $picking[$branch_id]['items'];

        $good = Good::find($item['good_id']);

        if (($item_num * $good->unit) > $item->store)
        {
            $item_num = floor($item->store / $good->unit);
        }

        if (array_key_exists($item_id, $items))
        {

            $items[$item_id]['num'] += $item_num;
            $items[$item_id]['presentation_num'] += $presentation_num;

            if ($items[$item_id]['num'] <= 0)
            {
                unset($items[$item_id]);
            }
        }
        else
        {
            $items[$item_id]['id']               = $item->id;
            $items[$item_id]['num']              = $item_num;
            $items[$item_id]['presentation_num'] = $presentation_num;
            $items[$item_id]['good_id']          = $item->good_id;
            $items[$item_id]['name']             = $item->good->name . '-' . date("Ymd", strtotime($item->production_date));
            $items[$item_id]['price']            = Input::get('item_price') ? Input::get('item_price') : $item->price;
        }

        Session::put('picking.' . $branch_id . '.items', $items);

        return Redirect::to('picking/add/' . $branch_id . '?warehouse_id=' . Input::get('warehouse_id'));
    }

    // 清空配货清单
    //
    public function postEmpty()
    {
        $branch_id = Input::get('branch_id');
        Session::forget('picking.' . $branch_id);

        return Redirect::to('picking/add/' . $branch_id . '?warehouse_id=' . Input::get('warehouse_id'))->with('success', '货品出货清单已清空！');
    }

    // 生成配货单
    //
    public function postCreate()
    {
        $branch_id = Input::get('branch_id');
        $picking   = Session::get('picking');

        if (array_key_exists($branch_id, $picking))
        {
            $branch_picking = $picking[$branch_id];

            if (count($branch_picking['items']) == 0)
            {
                return Redirect::to('picking/add/' . $branch_id)->with('error', '出货清单为空，请添加货品清单再生成出货单！');
            }
            else
            {
                $branch  = Branch::find($branch_id);
                $user_id = (int)Auth::user()->id;

                // 发货单
                //
                $delivery     = new Delivery();
                $delivery->bn = $branch_picking['order_id'];

                $delivery->ship_name   = $branch->name;
                $delivery->ship_addr   = $branch->address;
                $delivery->ship_mobile = $branch->mobile;

                $delivery->t_begin = $this->__time();

                $delivery->branch_id = $branch_id;
                $delivery->user_id   = $user_id;

                $delivery->money = Input::get('items_price');

                $delivery->status     = '1';
                $delivery->pay_status = '0';

                $delivery->warehouse_id = Input::get('warehouse_id');

                $delivery->save();

                $item_num = 0;

                // 发货单货品
                //
                foreach ($branch_picking['items'] as $item)
                {
                    $item_num += $item['num'] + $item['presentation_num']; // 统计发货数量

                    $good_info        = Good::find($item['good_id']);
                    $good_info->sell  = $good_info->sell + (($item['num'] + $item['presentation_num']) * $good_info->unit);
                    $good_info->store = $good_info->store - (($item['num'] + $item['presentation_num']) * $good_info->unit);
                    $good_info->save();

                    $product_info        = Product::find($item['id']);
                    $product_info->sell  = $product_info->sell + (($item['num'] + $item['presentation_num']) * $good_info->unit);
                    $product_info->store = $product_info->store - (($item['num'] + $item['presentation_num']) * $good_info->unit);
                    $product_info->save();

                    $delivery_item               = new DeliveryItems();
                    $delivery_item->delivery_id  = $delivery->id;
                    $delivery_item->branch_id    = $branch->id;
                    $delivery_item->good_id      = $item['good_id'];
                    $delivery_item->product_id   = $item['id'];
                    $delivery_item->good_name    = $item['name'];
                    $delivery_item->spec_info    = '';
                    $delivery_item->number       = $item['num'] * $good_info->unit;
                    $delivery_item->presentation = $item['presentation_num'] * $good_info->unit;
                    $delivery_item->price        = $item['price'];
                    $delivery_item->money        = $item['price'] * $item['num'];
                    $delivery_item->life_date    = $product_info->life_date;
                    $delivery_item->warehouse_id = $product_info->warehouse_id;
                    $delivery_item->save();

                    // 日志
                    //
                    $this->__goodLog($item['good_id'], $item['id'], 'picking');
                }

                // 清空出货清单
                //
                Session::forget('picking.' . $branch_id);

                // 重置最后发货、回访时间
                //
                $branch->last_visit_at = $branch->last_ship_at = $this->__time();

                // 合同存量
                //
                if ($branch->stock)
                {
                    if ($branch->stock > $item_num)
                    {
                        $branch->stock = $branch->stock - $item_num;
                    }
                    else
                    {
                        $branch->stock = 0;
                    }
                }

                $branch->save();

                return Redirect::to('picking/view/' . $delivery->id)->with('success', '出货单生成成功！');

            }
        }
    }

    // 查看出货单
    //
    public function getView($PickingID)
    {
        $delivery = Delivery::find($PickingID);

        $user_info = User::find($delivery->user_id);

        return View::make('picking.view')->with(compact('delivery'))->with(compact('user_info'));
    }

    // 出货确认
    //
    public function getConfirm($PickingID)
    {
        $delivery         = Delivery::find($PickingID);
        $delivery->status = '2';
        $delivery->t_send = $this->__time();
        $delivery->save();

        return Redirect::to('picking')->with('success', '出货单（' . $delivery->bn . '）已确认！');
    }

    // 完成出货
    //
    public function getDone($PickingID)
    {
        $delivery = Delivery::find($PickingID);

        //$user_info = User::find($delivery->user_id);

        return View::make('picking.done')->with(compact('delivery'));
    }

    // 完成处理
    //
    public function postDone($PickingID)
    {
        $rules = array(
            'real_bn' => 'required|unique:delivery'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('picking/done/' . $PickingID)
                ->withErrors($validator)
                ->withInput();
        }

        $delivery             = Delivery::find($PickingID);
        $delivery->status     = '3';
        $delivery->real_bn    = Input::get('real_bn');
        $delivery->pay_status = Input::get('pay_status');
        $delivery->t_confirm  = $this->__time();
        $delivery->save();

        // 增加销售记录 用于退换回收 2014.05.21
        $delivery_items = DeliveryItems::where('delivery_id', $delivery->id)->get();

        foreach ($delivery_items as $item)
        {
            $g = BranchGoodItems::where('good_id', $item->good_id)->where('branch_id', $item->branch_id)->first();

            if ($g)
            {
                $i       = BranchGoodItems::find($g->id);
                $i->sell = $i->sell + $item->number;
                $i->save();
            }
            else
            {
                $i            = new BranchGoodItems;
                $i->good_id   = $item->good_id;
                $i->branch_id = $item->branch_id;
                $i->sell      = $item->number;
                $i->save();
            }
        }

        return Redirect::to('picking')->with('success', '出货单（' . $delivery->bn . '）已完成！');
    }

    // 选择仓库
    //
    public function getWarehouseSelect($BranchId)
    {
        $branch = Branch::find($BranchId);

        $warehouse = Warehouse::all();

        return View::make('picking.warehouse-select')->with(compact('warehouse'))->with(compact('branch'));
    }

    // 批量打印 2014.06.29
    //
    public function getPrint()
    {
        $warehouse      = Warehouse::all();
        $users          = User::where('grade', '10')->where('disable', '0')->get();
        $warehouse_name = '';
        $user_name      = '';

        $prints       = array();
        $count_prints = 0;

        $warehouse_id = Input::get('warehouse_id');
        $user_id      = Input::get('user_id');

        if ($warehouse_id === '0' || $user_id === '0')
        {
            return Redirect::to('picking/print')->with('error', '仓库和业务员都需要选择！');
        }

        if ($warehouse_id && $user_id)
        {
            $warehouse_name = Warehouse::find($warehouse_id)->pluck('name');
            $user           = User::find($user_id);
            $user_name      = $user->username;
            $prints         = Delivery::where('warehouse_id', $warehouse_id)->where('status', '2')->where('user_id', $user_id)->with('items', 'user')->get();
            $count_prints   = count($prints);
        }

        return View::make('picking.print')->with(compact('warehouse'))->with(compact('users'))->with(compact('prints'))->with(compact('warehouse_name'))->with(compact('user_name'))->with(compact('count_prints'));
    }


}
