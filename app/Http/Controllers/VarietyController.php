<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VarietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         return view('Variety/index',['data' => \App\Variety::all()]) ;
    }

    public function api_list(){
      $data = \App\Variety::all();
      return json_encode($data);
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

    public function unitByVariety($id){

      $data = \App\Variety::find($id)->units;
      return view('Variety/unit',['data' => $data,'id'=>$id]);

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

        $data = \App\Variety::find($id)->units;
        return view('Variety/show',['data' => $data,'id'=>$id]);
    }


    public function heat($id){
      $data = \App\Variety::find($id)->units;

      return view('Variety/heat',['data' => $data]);
    }

    public function grid($id){

      $data = \App\Variety::find($id)->units;

      return view('Variety/grid',['data'=> $data]);
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
}
