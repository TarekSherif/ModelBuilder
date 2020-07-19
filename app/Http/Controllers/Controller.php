<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

      // public function
      public function UpdateSOrderUp( $Tname,$PKName,$FKName, $PKValue, $FKValue,$SOrder){
        $jTableResult =  array();
        $jTableResult['refresh'] =false;

        if( $SOrder != "1"){
            
            $newSOrder=intval($SOrder)-1;
       

            $SQL="UPDATE $Tname SET 
            SOrder =  '" . $SOrder . "' 
            WHERE 
            $FKName='". $FKValue."'
             and
            SOrder =  '" . $newSOrder . "'" ;
                      
            DB::update($SQL);

           

            $SQL="UPDATE $Tname SET 
            SOrder =  '" . $newSOrder . "'  
            WHERE  $PKName='". $PKValue."' " ;
                      
            DB::update($SQL);

            $jTableResult['refresh'] =true;
            
        }
        return response()->json($jTableResult);  
       

      
     }
    public function UpdateSOrderDown( $Tname,$PKName,$FKName, $PKValue, $FKValue,$SOrder){
        $jTableResult =  array();
        $jTableResult['refresh'] =false;
        $SQL="select count(*) as MaxOrder from $Tname where $FKName='". $FKValue."'";
        $Data=DB::select($SQL);
        $MaxOrder=$Data[0]->MaxOrder;
        if( $SOrder != $MaxOrder){
            
            $newSOrder=intval($SOrder)+1;
            

            $SQL="UPDATE $Tname SET 
            SOrder =  '" . $SOrder . "'  
            WHERE $FKName='". $FKValue."' and SOrder =  '" . $newSOrder . "'" ;
                      
            DB::update($SQL);

           

            $SQL="UPDATE $Tname SET 
            SOrder =  '" . $newSOrder . "'  
            WHERE  $PKName='". $PKValue."' " ;
                      
            DB::update($SQL);

            $jTableResult['refresh'] =true;
            
        }
        return response()->json($jTableResult);  
       

      
    }
}
