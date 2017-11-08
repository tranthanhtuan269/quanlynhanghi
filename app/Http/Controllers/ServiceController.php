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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check()) {
            $current_id = Auth::user()->id;
            $services = DB::table('services')->select('*')->where('created_by', '=', $current_id)->get();
            return view('service.index', ['services' => $services ]);
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
}
