<?php

namespace App\Http\Controllers;

use DB;
use App\Emp;
use Illuminate\Http\Request;

class EmpController extends Controller
{
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
        $Data =$this->GetLookUpData();
       
        return view("Emp.create",$Data);
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
    //     $this->validate($request,
    //    [
    //        'txtUser' => 'required',
    //        'txtPass' => 'required',
    //    ],
    //    [
    //        'required'=> ':attribute field is required',
    //    ],
    //    [
    //        'txtUser'=>'Username',
    //        'txtPass'=>'Password',
    //    ]);

        $Emp = new Emp();
        $data = $request->only($Emp->getFillable());
        $Emp->fill($data)->save();

        return redirect("Emp/create")->with('success', 'تم  الاضافه بنجاح');
    }
 /**
     * Display the specified resource.
     *
     * @param  \App\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function show(Emp $emp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function edit(  $id)
    {
        $Data =$this->GetLookUpData();
        $Data['emp']= Emp::find( $id) ;

        return view("Emp.edit",$Data);
    //
 }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emp $emp)
    {
        //
        $data = $request->only($emp->getFillable());
        $emp->fill($data)->save();
        
        return redirect("Emp/$emp->EmpID/edit")->with('success', 'تم  الحفظ بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emp $emp)
    {
        //
    }
}
