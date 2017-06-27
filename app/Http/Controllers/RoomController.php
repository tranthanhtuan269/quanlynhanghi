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


class RoomController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_id = Auth::user()->id;
        $rooms = DB::table('rooms')->select('*')->where('created_by', '=', $current_id)->get();
        $room_types = DB::table('room_type')->where('created_by', $current_id)->pluck('name', 'id');
        $room_type_first = DB::table('room_type')->where('created_by', $current_id)->first();
        $services = DB::table('services')->select('*')->where('created_by', '=', $current_id)->get();
        return view('room.index', [ 'rooms' => $rooms, 'room_types' => $room_types, 'services' => $services, 'room_type_first' => $room_type_first]);
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
        $input = $request->all();
        $current_id = Auth::user()->id;

        // store
        $room = new Room;
        $room->name         = $input['room_name'];
        $room->room_type    = $input['room_type'];
        $room->state = 0;
        $room->id_hotel     = $current_id;
        $room->created_by   = $current_id;
        if($room->save()){
            return Response::json(array('code' => '200', 'message' => 'success'));
        }
        return Response::json(array('code' => '404', 'message' => 'unsuccess'));
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

    public function getRoomInfo()
    {
        if(isset($_GET) && isset($_GET['id'])){
            $id = $_GET['id'];
            $room = Room::find($id);
            if($room){
                $room_type = DB::table('room_type')->select('*')->where('id', '=', $room->room_type)->first();
                $hotel = DB::table('rooms')->select('id_hotel')->where('id', '=', $id)->first();
                $order = DB::table('orders')->select('*')->where([['room_id', '=', $id], ['state', '=', '1']])->first();
                if($order){
                    $order_details = DB::table('order_detail')
                                    ->leftJoin('services', 'services.id', '=', 'order_detail.service_id')
                                    ->where('order_detail.order_id', '=', $order->id)
                                    ->where('services.id_hotel', '=', $hotel->id_hotel)
                                    ->get();
                    return Response::json(array('code' => '200', 'message' => 'success', 'room' => $room, 'room_type' => $room_type, 'order' => $order, 'order_details' => $order_details));
                }
                return Response::json(array('code' => '200', 'message' => 'success', 'room' => $room, 'room_type' => $room_type, 'order' => null, 'order_details' => null));
            }
        }
        return Response::json(array('code' => '404', 'message' => 'unsuccess', 'orders' => null));
    }

    public function addOrder(Request $request)
    {
        $input = $request->all();
        $current_id = Auth::user()->id;
        // var_dump($input);die;

        if($input['room_id']){
            // store order
            $order              = new Order;
            $order->room_id     = $input['room_id'];
            $order->customer_id = null;
            $order->created_by  = $current_id;
            $order->created_at  = date("Y-m-d H:i:s");
            $order->state       = 1;
            $order->updated_at  = date("Y-m-d H:i:s");
            
            if($order->save()){
                $room = Room::find($input['room_id']);
                if($room){
                    $room->created_at   = date("Y-m-d H:i:s");
                    $room->updated_at   = date("Y-m-d H:i:s");
                    $room->order_type   = $input['type_order'];
                    $room->state        = 1;
                    $room->save();
                }

                // store order_detail
                $data_list = json_decode('['.$input['room_services'].']');
                if(count($data_list) > 0){
                    foreach ($data_list as $data) {
                        $order_detail = new Order_Detail;
                        $order_detail->service_id       = $data->service_id;
                        $order_detail->order_id         = $order->id;
                        $order_detail->number_count     = $data->service_number;
                        $order_detail->created_by       = $current_id;
                        $order_detail->created_at       = date("Y-m-d H:i:s");
                        $order_detail->save();
                    }
                }
                return Response::json(array('code' => '200', 'message' => 'success'));
            }else{
                return Response::json(array('code' => '404', 'message' => 'unsuccess'));    
            }
        }
        return Response::json(array('code' => '404', 'message' => 'unsuccess'));
    }

    public function editOrder(Request $request)
    {
        $input = $request->all();
        $current_id = Auth::user()->id;
        //step 1: remove all order_detail of order
        //step 2: add new order_detail of order

        if($input['room_id'] && $input['order_id']){

            $room = Room::find($input['room_id']);
                // var_dump($room);die;
            if($room){
                $room->order_type = $input['type_order'];
                $room->save();
            }

            // remove all order_detail of order
            DB::table('order_detail')->where('order_id', '=', $input['order_id'])->delete();

            // store order_detail
            $data_list = json_decode('['.$input['room_services'].']');
            if(count($data_list) > 0){
                foreach ($data_list as $data) {
                    $order_detail = new Order_Detail;
                    $order_detail->service_id       = $data->service_id;
                    $order_detail->order_id         = $input['order_id'];
                    $order_detail->number_count     = $data->service_number;
                    $order_detail->created_by       = $current_id;
                    $order_detail->created_at       = date("Y-m-d H:i:s");
                    $order_detail->save();
                }
            }
            return Response::json(array('code' => '200', 'message' => 'success'));
        }
        return Response::json(array('code' => '404', 'message' => 'unsuccess'));
    }

    public function payOrder(Request $request)
    {
        $input = $request->all();
        $current_id = Auth::user()->id;

        //step 1: update order
        //step 2: change status of room
        //step 3: update total service in store

        if($input['room_id'] && $input['order_id']){

            $order = Order::find($input['order_id']);

            if($order){

                $order->state = 2;
                $order->updated_at = date("Y-m-d H:i:s");

                if($order->save()){

                    $room = Room::find($input['room_id']);
                    $room->state = 0;

                    if($room->save()){

                        $service_list = DB::table('order_detail')->where('order_id', '=', $input['order_id'])->get();

                        foreach ($service_list as $list) {
                            $service = Service::find($list->service_id);
                            $service->number = $service->number - $list->number_count;
                            $service->save();
                        }
                    return Response::json(array('code' => '200', 'message' => 'success'));
                    }
                }
            }
        }
        return Response::json(array('code' => '404', 'message' => 'unsuccess'));
    }
}
