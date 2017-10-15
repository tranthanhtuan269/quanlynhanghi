<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\City;
use App\Room_Type;
use DB;
use Response;

class RoomTypeController extends Controller
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
        $roomtypes = DB::table('room_type')->select('*')->where('created_by', '=', $current_id)->get();
        return view('roomtype.index', ['roomtypes' => $roomtypes ]);
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
        $roomtype = new Room_Type;
        $roomtype->name             = $input['name_type'];
        $roomtype->priceinroom      = $input['priceinroom'];
        $roomtype->priceahour       = $input['priceinhour'];
        $roomtype->priceovernight   = $input['priceovernight'];
        $roomtype->priceaday        = $input['priceaday'];
        $roomtype->priceaweek       = $input['priceaweek'];
        $roomtype->priceamonth      = $input['priceamonth'];
        $roomtype->created_by       = $current_id;
        if($roomtype->save()){
            return Response::json(array('code' => '200', 'message' => 'success', 'roomtype' => $roomtype));
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
        $roomtype = Room_Type::find($id);
        $roomtype->name             = $input['name_type'];
        $roomtype->priceinroom      = $input['priceinroom'];
        $roomtype->priceahour       = $input['priceinhour'];
        $roomtype->priceovernight   = $input['priceovernight'];
        $roomtype->priceaday        = $input['priceaday'];
        $roomtype->priceaweek       = $input['priceaweek'];
        $roomtype->priceamonth      = $input['priceamonth'];
        $roomtype->created_by       = $current_id;
        if($roomtype->save()){
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

    public function getRoomTypeInfo()
    {
        if(isset($_GET) && isset($_GET['id'])){
            $roomtype = DB::table('room_type')->select('*')->where('id', '=', $_GET['id'])->first();
            if($roomtype){
                return Response::json(array('code' => '200', 'message' => 'success', 'room_type' => $roomtype));
            }
        }
        return Response::json(array('code' => '404', 'message' => 'unsuccess', 'room_type' => null));
    }
}
