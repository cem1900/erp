<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DeliveryItemsNoticeCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'notice:deliveryitems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delivery Items Notice!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->info('Search Delivery Items Life Time');

        // 六十天提醒
        //
        $N_Time = date("Y-m-d", time());

        $L_Time = date("Y-m-d", (time() + (60 * 3600 * 24)));

        // 获取满足条件的货品
        //
        $Items = DeliveryItems::where('life_date', '>', $N_Time)->where('life_date', '<', $L_Time)->orderBy('delivery_id', 'desc')->get();

        // 初始化
        //
        $branch_ids   = array();
        $delivery_ids = array();

        foreach ($Items as $Item)
        {
            // 条件过滤
            //
            if (!in_array($Item->delivery_id, $delivery_ids) && in_array($Item->branch_id, $branch_ids))
            {
                continue;
            }
            else
            {
                if (!in_array($Item->delivery_id, $delivery_ids))
                {
                    $delivery_ids[] = $Item->delivery_id;
                }

                if (!in_array($Item->branch_id, $branch_ids))
                {
                    $branch_ids[] = $Item->branch_id;
                }

                $branch   = Branch::find($Item->branch_id);
                $delivery = Delivery::find($Item->delivery_id);

                if ($branch && $delivery)
                {
                    $notice           = New Notice();
                    $notice->user_id  = $branch->user_id;
                    $notice->type     = '5';
                    $notice->content  = '客户（' . $branch->name . '）的出货单（' . $delivery->bn . '）中商品（' . $Item->good_name . '）' . date("Y-m-d", strtotime($Item->life_date)) . ' 过期！';
                    $notice->data     = json_encode(array(
                        'branch_id'   => $Item->branch_id,
                        'delivery_id' => $Item->delivery_id
                    ));
                    $notice->read     = '0';
                    $notice->timeline = date("Y-m-d H:i:s", time());

                    $notice->save();

                    $this->info($notice->content);
                }
            }
        }

        $this->info('Done!');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array( //array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array( //array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}
