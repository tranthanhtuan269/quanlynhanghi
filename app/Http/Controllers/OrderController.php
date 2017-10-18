<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\City;
use App\Room_Type;
use App\Room;
use App\Order;
use App\Service;
use App\Order_Detail;

use DB;
use Response;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_id = Auth::user()->id;
        $rooms = DB::table('rooms')->select('id')->where('created_by', '=', $current_id)->get();
        // $dataid = [];
        $room_list = "";
        $order_list = array();

        // get before of date
        $order_history = DB::table('order_history')->select('order_total as order_price', 'created_at as order_date', 'created_by')->where('created_by', '=', $current_id)->orderBy('created_at','desc')->take(29)->get();
        // dd($order_history);
        if(count($rooms) > 0){
            foreach ($rooms as $room) {
                $room_list .= $room->id . ',';
            }

            $room_list = rtrim($room_list,",");

            $sql = "SELECT SUM(price_order) AS 'order_price', CAST(updated_at AS DATE) as order_date, created_by";
            $sql .= " FROM orders";
            $sql .= " WHERE room_id IN (";
            $sql .= $room_list;
            $sql .= ")";
            $sql .= " AND DATE(updated_at) = DATE(NOW()) GROUP BY CAST(updated_at AS DATE), created_by";

            $order_list = DB::select($sql);
            // dd($order_list);
        }
        
        return view('order.index2', [ 'order_list' => $order_list ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDataForChart(){

    }

    public function getDataForDate(){

    }
}
