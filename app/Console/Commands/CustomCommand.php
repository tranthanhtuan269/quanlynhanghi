<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Order_History;

class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $order = new Order_History;
        $order->order_total = 1;
        $order->created_by = 1;
        $order->created_at = date("Y-m-d H:i:s");
        $order->save();
    }
}
