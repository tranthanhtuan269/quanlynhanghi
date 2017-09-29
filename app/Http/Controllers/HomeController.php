<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $yesterday = date("Y-m-d", time() - 60 * 60 * 24);
        // step 1: get all user to get hotel
        $users = \DB::table('users')->where('id', 3)->get();

        // step 2: get all service of this hotel
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

                // step 3: save to database
                if(count($sqlRun) > 0){
                    $serviceOrder = new \App\Service_Order;
                    $serviceOrder->service_id = $service->id;
                    $serviceOrder->service_number = $sqlRun[0]->number;
                    $serviceOrder->created_date = $yesterday;
                    $serviceOrder->save();
                }
            }
        }

        return 'done';
    }
}
