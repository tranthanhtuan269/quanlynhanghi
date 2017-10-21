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
        $room_list = '';
        // get all user
        $users = DB::table('users')->select('id')->get();
        foreach ($users as $user) {
            // get all room of user 
            $rooms = DB::table('rooms')->select('id')->where('created_by', '=', $user->id)->get();

            // create string room
            foreach ($rooms as $room) {
                $room_list .= $room->id . ',';
            }
            $room_list = rtrim($room_list,",");

            // run sql count 
            $sql = "SELECT SUM(price_order) AS 'order_price', CAST(updated_at AS DATE) as order_date, created_by";
            $sql .= " FROM orders";
            $sql .= " WHERE room_id IN (";
            $sql .= $room_list;
            $sql .= ")";
            $sql .= " AND DATE(updated_at) = DATE(NOW() - INTERVAL 1 DAY) GROUP BY CAST(updated_at AS DATE), created_by";

            $total_order_yesterday = DB::select($sql);
            if(count($total_order_yesterday) > 0){
                $order_history = new Order_History;
                $order_history->order_total = $total_order_yesterday[0]->order_price;
                $order_history->created_at = $total_order_yesterday[0]->order_date;
                $order_history->created_by = $total_order_yesterday[0]->created_by;
                $order_history->save();
            }
        }
    }
}
