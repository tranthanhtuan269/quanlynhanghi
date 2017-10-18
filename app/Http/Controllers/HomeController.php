<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_History;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function countServiceSellInDay(){
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

            $order_history = new Order_History;
            $order_history->order_total = $total_order_yesterday[0]->order_price;
            $order_history->created_at = $total_order_yesterday[0]->order_date;
            $order_history->created_by = $total_order_yesterday[0]->created_by;
            $order_history->save();
        }
    }

    public function backup(){
        $yesterday = date("Y-m-d", time() - 60 * 60 * 24);
        // step 1.1: get all user to get user
        $users = \DB::table('users')->get();

        // step 1.2: get all service of this user
        foreach ($users as $user) {
            $services = \DB::table('services')->where('created_by', $user->id)->get();
            foreach ($services as $service) {
                $checkServiceOrder = \App\Service_Order::where('service_id', $service->id)
                            ->where('created_date', $yesterday)
                            ->get();
                if(count($checkServiceOrder) > 0) continue;

                $sql = "SELECT ";
                $sql .= "    CAST(created_at AS DATE) AS 'order_date',";
                $sql .= "    Sum(number_count) AS number ";
                $sql .= "FROM order_detail ";
                $sql .= "WHERE service_id = " . $service->id ;
                $sql .= " AND CAST(created_at AS DATE) = '" . $yesterday . "' ";
                $sql .= "GROUP BY CAST(created_at AS DATE)";
                $sqlRun = \DB::select($sql);

                // step 1.3: save to database
                if(count($sqlRun) > 0){
                    $serviceOrder = new \App\Service_Order;
                    $serviceOrder->service_id = $service->id;
                    $serviceOrder->service_number = $sqlRun[0]->number;
                    $serviceOrder->created_date = $yesterday;
                    $serviceOrder->save();
                }
            }

            // step 2 Save history total order of motel in a day

            $rooms = DB::table('rooms')->select('id')->where('created_by', '=', $user->id)->get();
            $room_list = "";
            $order_list = array();
            if(count($rooms) > 0){

                foreach ($rooms as $room) {
                    $room_list .= $room->id . ',';
                }

                $room_list = rtrim($room_list,",");
                // step 2.1
                $sql2 = "SELECT SUM(price_order) AS 'order_price', CAST(updated_at AS DATE) as order_date, created_by";
                    $sql2 .= " FROM orders ";
                    $sql2 .= " WHERE room_id IN (" . $room_list . ") ";
                    $sql2 .= " AND DATE(updated_at) = DATE(NOW() - INTERVAL 1 DAY) GROUP BY CAST(updated_at AS DATE), created_by";
                $sql2Run = \DB::select($sql2);

                // step 2.3: save to database
                if(count($sql2Run) > 0){
                    $orderHistory = new \App\Order_History;
                    $orderHistory->order_total = $sql2Run[0]->order_price;
                    $orderHistory->created_by = $sql2Run[0]->created_by;
                    $orderHistory->created_at = $sql2Run[0]->order_date;
                    $orderHistory->save();
                }
            }
        }
    }
}
