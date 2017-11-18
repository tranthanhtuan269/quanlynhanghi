<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\City;
use App\Service;
use DB;
use Response;

class ServiceController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_id = Auth::user()->id;

        //get all service of id
        $sql = "SELECT * FROM services where created_by = $current_id";
        $services = \DB::select($sql);
        $listService = "";
        $resource = array();
        $YList = array();
        $number_day = 30;
        
        if(count($services) > 0){
            for($i = 0; $i < $number_day; $i++){
                $XList[] = date("d/m/Y", time() - 60 * 60 * 24 * $i);
            }
            foreach ($services as $service) {
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
        return view('service.index', ['services' => $services, 'XList' => $XList, 'YList' => json_encode($YList)]);
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
        $service                    = new Service;
        $service->name              = $input['service_name'];
        $service->price             = $input['service_price'];
        $service->number            = $input['service_number'];
        $service->created_by        = $current_id;
        if($service->save()){
            return Response::json(array('code' => '200', 'message' => 'success', 'service' => $service));
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
        $input = $request->all();
        $current_id = Auth::user()->id;

        // update
        $service = Service::find($id);
        $service->name              = $input['service_name'];
        $service->price             = $input['service_price'];
        $service->number            = $input['service_number'];
        $service->created_by        = $current_id;
        if($service->save()){
            return Response::json(array('code' => '200', 'message' => 'success'));
        }
        return Response::json(array('code' => '404', 'message' => 'unsuccess'));
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

    public function getServiceInfo()
    {
        if(isset($_GET) && isset($_GET['id'])){
            $service = DB::table('services')->select('*')->where('id', '=', $_GET['id'])->first();
            if($service){
                return Response::json(array('code' => '200', 'message' => 'success', 'service' => $service));
            }
        }
        return Response::json(array('code' => '404', 'message' => 'unsuccess', 'service' => null));
    }

    public function getServiceSale(){
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