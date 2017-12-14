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

    public function getDistrict($id){
        $districts = \DB::table('districts')
                    ->where('districts.city_id', '=', $id)
                    ->where('districts.active', '=', 1)
                    ->get();   
        $html = "";
        $html .= '<option value="0">Chọn Quận / Huyện</option>';
        foreach ($districts as $district) {
            $html .= '<option value="'.$district->id.'">'.$district->name.'</option>';
        }
        return $html;
    }

    public function getTown($id){
        $towns = \DB::table('towns')
                    ->where('towns.district_id', '=', $id)
                    ->where('towns.active', '=', 1)
                    ->get();   
        $html = "";
        $html .= '<option value="0">Chọn Phường / Xã</option>';
        foreach ($towns as $town) {
            $html .= '<option value="'.$town->id.'">'.$town->name.'</option>';
        }
        return $html;
    }

    public function ajaxpro(Request $request){
        if(isset($_POST["image"])){
            $data = $_POST["image"];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $imageName = time().'.png';
            $destinationPath = base_path('public/images');
            file_put_contents($destinationPath.'/'.$imageName, $data);
            return \Response::json(array('code' => '200', 'message' => 'success', 'image_url' => $imageName));
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'image_url' => ""));
    }

    public function countServiceSellInDay(){
        $date = date("Y-m-d", time() - 60 * 60 * 24);

        // get all user
        $users = DB::table('users')->select('id')->orderBy('id', 'asc')->get();
        foreach ($users as $user) {
            // get all room of user 
            $rooms = DB::table('rooms')->select('id')->where('created_by', '=', $user->id)->get();
            $room_list = '';
            // create string room
            foreach ($rooms as $room) {
                $room_list .= $room->id . ',';
            }
            $room_list = rtrim($room_list,",");

            // run sql count 
            $sql = "SELECT SUM(price_order) AS 'order_price', CAST(updated_at AS DATE) as order_date";
            $sql .= " FROM orders";
            $sql .= " WHERE room_id IN (";
            $sql .= $room_list;
            $sql .= ")";
            $sql .= " AND created_by = ";
            $sql .= $user->id;
            $sql .= " AND DATE(updated_at) = DATE(NOW() - INTERVAL 1 DAY) GROUP BY CAST(updated_at AS DATE)";
            dd($sql);

            $total_order_yesterday = DB::select($sql);

            if(count($total_order_yesterday) > 0){
                $order_history = new Order_History;
                $order_history->order_total = (int)$total_order_yesterday[0]->order_price;
                $order_history->created_at = $total_order_yesterday[0]->order_date;
                $order_history->created_by = $user->id;
                $order_history->save();
            }else{
                $order_history = new Order_History;
                $order_history->order_total = 0;
                $order_history->created_at = $date;
                $order_history->created_by = $user->id;
                $order_history->save();
            }
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

    public function updateInfo(Request $request, $id){
        $requestData = $request->all();
        
        $user = \App\User::findOrFail(\Auth::user()->id);
        $user->update($requestData);

        return redirect('/');
    }

    public function updateSetting(Request $request, $id){
        $requestData = $request->all();
        
        $user = \App\User::findOrFail(\Auth::user()->id);
        $user->update($requestData);

        return redirect('/');
    }

    public function postImages(Request $request, $id){
        $requestData = $request->all();
        // dd($requestData);
        
        $user = \App\User::findOrFail(\Auth::user()->id);
        $user->images = $requestData['images'];
        $user->save();

        return redirect('/');
    }

    public function functions(){
        return view('site/functions');
    }

    public function test(){
        $current_id = \Auth::user()->id;
        //get all service of id
        $sql = "SELECT id, name FROM services where created_by = $current_id";
        $listServiceID = \DB::select($sql);
        $listService = "";
        $resource = array();
        $YList = array();
        $number_day = 30;
        
        if(count($listServiceID) > 0){
            for($i = 0; $i < $number_day; $i++){
                $XList[] = date("d/m/Y", time() - 60 * 60 * 24 * $i);
            }
            foreach ($listServiceID as $service) {
                $data = array();
                for($i = 0; $i < $number_day; $i++){
                    $data[] = null;
                }  
                $timeGetFirst = date("Y-m-d", time() - 60 * 60 * 24 * ($number_day - 1));
                $sql2 = "
                        SELECT 
                            SUM(number_count) AS 'number_sell', 
                            CAST(created_at AS DATE) as order_date 
                        FROM order_detail 
                        WHERE service_id = $service->id
                        AND created_by = $current_id
                        AND created_at > '$timeGetFirst 00:00:00'
                        GROUP BY CAST(created_at AS DATE)";
                $resource = \DB::select($sql2);

                foreach($resource as $order){
                    $time=date("Y-m-d", time());
                    $date1=date_create($time);
                    $date2=date_create($order->order_date);
                    $diff=date_diff($date1,$date2);
                    $data[$diff->format("%a")] = $order->number_sell;
                }
                $obj = new objectNew;
                $obj->name = $service->name;
                $obj->data = $data;
                array_push($YList, $obj);
            }
        }

        // dd($YList);
        return view('site/test',['XList' => $XList, 'YList' => json_encode($YList)]);
    }
}

class objectNew{
    public $name;
    public $data;
}