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
        if (\Auth::check()) {
            if(\Auth::user()->expiration_date == null){
                \Auth::user()->expiration_date = \Auth::user()->created_at;
                \Auth::user()->save();
            }
            $current_id = Auth::user()->id;
            $rooms = DB::table('rooms')->select('*')->where('created_by', '=', $current_id)->get();
            $room_types = DB::table('room_type')->where('created_by', $current_id)->pluck('name', 'id');
            $room_type_first = DB::table('room_type')->where('created_by', $current_id)->first();
            $services = DB::table('services')->select('*')->where('created_by', '=', $current_id)->get();
            return view('room.index', [ 'rooms' => $rooms, 'room_types' => $room_types, 'services' => $services, 'room_type_first' => $room_type_first]);
        }
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
        $room->created_by   = $current_id;
        if($room->save()){
            return Response::json(array('code' => '200', 'message' => 'success', 'room' => $room));
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
                $order = DB::table('orders')->select('*')->where([['room_id', '=', $id], ['state', '=', '1']])->first();
                if($order){
                    $order_details = DB::table('order_detail')
                                    ->join('services', 'services.id', '=', 'order_detail.service_id')
                                    ->where('order_detail.order_id', '=', $order->id)
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

        if($input['room_id']){
            // store order
            $order              = new Order;
            $order->room_id     = $input['room_id'];
            $order->room_name     = $input['room_name'];
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
        // get all service of order

        if($input['room_id'] && $input['order_id']){

            $price_order = 0;

            $services = DB::table('order_detail')
                        ->leftJoin('services', 'services.id', '=', 'order_detail.service_id')
                        ->select('services.price as price', 'order_detail.number_count as count')
                        ->where('order_id', '=', $input['order_id'])->get();

            foreach ($services as $service) {
                $price_order += $service->price * $service->count;
            }

            $order = Order::find($input['order_id']);

            if($order){

                $order->state = 2;
                $order->updated_at = date("Y-m-d H:i:s");

                $room = Room::find($input['room_id']);

                $room_type = DB::table('room_type')->select('*')->where('id', '=', $room->room_type)->first();

                $to_time = strtotime(date("Y-m-d H:i:s"));
                $from_time = strtotime($room->updated_at);
                $diff_time = round(abs($to_time - $from_time) / 3600);

                if($room_type == null){
                    $price_order += 0;
                }else{
                    $price_order += $this->getPriceRoom($room->order_type, $diff_time, $room_type);
                }

                $order->price_order = $price_order;

                if($order->save()){

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

    function getPriceRoom($order_type, $diff_time, $room_type){
        if($order_type == 0){
            // nghi gio
            if($diff_time <= 1){
                return $room_type->priceinroom;
            }else{
                return $room_type->priceinroom + $room_type->priceahour * ($diff_time - 1);
            }
        }else if($order_type == 1){
            // qua dem
            if($diff_time <= 12){
                return $room_type->priceovernight;
            }else{
                return $room_type->priceovernight + $room_type->priceahour * ($diff_time - 12);
            }
        }else if($order_type == 2){
            // nghi ngay
            if($diff_time <= 24){
                return $room_type->priceaday;
            }else{
                return $room_type->priceaday + $room_type->priceahour * ($diff_time - 24);
            }
        }else if($order_type == 3){
            // nghi tuan
            if($diff_time <= 168){
                return $room_type->priceaweek;
            }else{
                return $room_type->priceaweek + $room_type->priceahour * ($diff_time - 168);
            }
        }else if($order_type == 4){
            // nghi thang
            if($diff_time <= 720){
                return $room_type->priceamonth;
            }else{
                return $room_type->priceamonth + $room_type->priceahour * ($diff_time - 720);
            }
        }
    }
}
