<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\model\KerasModel;
use Illuminate\Http\Request;

class KerasModelController extends Controller
{


    
 private  function GetLookUpData()
 {
     $KerasModel =new KerasModel();
    return array(
        'KerasModel'=> $KerasModel,
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
       
        return view("KerasModel.create",$Data);
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
            'MName' => 'required',
              ]);
      
        $KerasModel = new KerasModel();
        $KerasModel->fill( $request->only($KerasModel->getFillable()));
        $KerasModel->createby=Auth::user()->id;
        if( $KerasModel->save()){
            return redirect()->route('KerasModel.edit', ['id' =>  $KerasModel->ModelID]);
        }

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\KerasModel  $kerasModel
     * @return \Illuminate\Http\Response
     */
    public function show(KerasModel $kerasModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\KerasModel  $kerasModel
     * @return \Illuminate\Http\Response
     */
    public function edit(KerasModel $kerasModel,$id)
    {
        
        $Data  =$this->GetLookUpData();
        $Data["KerasModel"] = KerasModel::find($id); 
        return view("KerasModel.edit",$Data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\KerasModel  $kerasModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KerasModel $kerasModel,$id)
    {

        $request->validate([
            'MName' => 'required',
              ]);
      
        $KerasModel = KerasModel::find($id); 
        $KerasModel->fill( $request->only($KerasModel->getFillable()));
        
        if( $KerasModel->save()){
            return redirect()->route('KerasModel.edit', ['id' =>  $KerasModel->ModelID]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\KerasModel  $kerasModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(KerasModel $kerasModel)
    {
        //
    }
}
