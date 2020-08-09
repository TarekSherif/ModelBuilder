<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\model\DS;
use Illuminate\Http\Request;

class DSController extends Controller
{


    
 private  function GetLookUpData()
 {
     $DS =new DS();
    return array(
        'DS'=> $DS,
            );
 }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Data =$this->GetLookUpData();
       
        return view("DS.create",$Data);
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
        $request->validate([
            'Name' => 'required',
              ]);
      
        $DS = new DS();
        $DS->fill( $request->only($DS->getFillable()));
        $DS->createby=Auth::user()->id;
        if( $DS->save()){
            return redirect()->route('DS.edit', ['id' =>  $DS->DSID]);
        }

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\DS  $DS
     * @return \Illuminate\Http\Response
     */
    public function show(DS $DS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\DS  $DS
     * @return \Illuminate\Http\Response
     */
    public function edit(DS $DS,$id)
    {
        
        $Data  =$this->GetLookUpData();
        $Data["DS"] = DS::find($id); 
        return view("DS.edit",$Data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\DS  $DS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DS $DS,$id)
    {

        $request->validate([
            'Name' => 'required',
              ]);
      
        $DS = DS::find($id); 
        $DS->fill( $request->only($DS->getFillable()));
        
        if( $DS->save()){
            return redirect()->route('DS.edit', ['id' =>  $DS->DSID]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\DS  $DS
     * @return \Illuminate\Http\Response
     */
    public function destroy(DS $DS)
    {
        //
    }
}
