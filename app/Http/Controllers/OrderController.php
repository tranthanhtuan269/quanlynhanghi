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
        if (\Auth::check()) {
            $current_id = Auth::user()->id;
            $rooms = DB::table('rooms')->select('id')->where('created_by', '=', $current_id)->get();
            $room_list = "";
            $order_list = array();
            $number_day = 30;
            if(count($rooms) > 0){
                foreach ($rooms as $room) {
                    $room_list .= $room->id . ',';
                }

                $room_list = rtrim($room_list,",");

                $order_list = DB::select("
                                        SELECT CAST(updated_at AS DATE) AS 'order_date', SUM(price_order) AS 'order_price' 
                                        FROM orders 
                                        WHERE room_id IN (" . $room_list . ") 
                                        GROUP BY CAST(updated_at AS DATE)
                                    ");

                $XList = array();
                $YList = array();
                for($i = 0; $i < $number_day; $i++){
                    $XList[] = date("d/m/Y", time() - 60 * 60 * 24 * $i);
                    $YList[] = null;
                }

                foreach($order_list as $order){
                    $time=date("Y-m-d", time());
                    $date1=date_create($time);
                    $date2=date_create($order->order_date);
                    $diff=date_diff($date1,$date2);
                    $YList[$diff->format("%a")] = $order->order_price;
                }

                $XList = array_reverse($XList);
                $YList = array_reverse($YList);
            }
            
            return view('order.index2', ['XList' => $XList, 'YList' => $YList]);
        }
        return redirect('/');
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

    public function getDetailByDate(Request $request){
        if (\Auth::check()) {
            $current_id = Auth::user()->id;
            if(isset($request) && isset($request["date_selected"])){
                $date_selected = $request["date_selected"];
                if(strlen($date_selected) >= 8 && strlen($date_selected) <= 10){
                    $date_find = explode("/",$date_selected);
                    $date_processed = $date_find[2].'-'.$date_find[1].'-'.$date_find[0];
                    $sql = 'SELECT created_at, room_name, price_order FROM orders where created_by = '. $current_id .' and (created_at >= "'.$date_processed.' 00:00:00" AND created_at <= "'.$date_processed.' 23:59:59")';
                    
                    $order_list = DB::select($sql);
                    return Response::json(array('code' => '200', 'message' => 'success', 'order_list' => $order_list));
                }
            }
        }
        return Response::json(array('code' => '404', 'message' => 'unsuccess'));
    }
}
