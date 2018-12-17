<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionViewRolePermissionController extends Controller {
    
    
    //{{url("/")}}/api/ViewRolePermissionListoptions
   
    
            //Getting records (listAction)
    public function ListOfViewRolePermissions($RID)    {
        $jTableResult =  array();
    
            try
            {
                $SQL ="SELECT * FROM ViewRolePermission  where  RID='$RID'";
                $Data= DB::select($SQL);
                $jTableResult['Result'] = "OK";
                $jTableResult['Records'] =$Data;
            
            }
            catch(Exception $ex)
            {
                //Return error Message
                $jTableResult['Result'] = "ERROR";
                $jTableResult['Message'] = $ex->getMessage();
            
            }
            return response()->json($jTableResult);
            }
    //Creating a new record (createAction)
    public function CreateViewRolePermission()  {
        
        $jTableResult =  array();
                try
                {
                        //Insert record into database
                        $SQL="INSERT INTO ViewRolePermission(ViewName ,RID, ShowData,InsertData, UpdateData,DeleteData,DataToPrint,DataToExcel) VALUES('" . $_POST["ViewName"] . "','" . $_POST["RID"] . "', '" . $_POST["ShowData"] . "','" . $_POST["InsertData"] . "', '" . $_POST["UpdateData"] . "','" . $_POST["DeleteData"] . "', '" . $_POST["DataToPrint"] . "','" . $_POST["DataToExcel"] . "');";
                        DB::insert( $SQL);
                        //Get last inserted record (to return to jTable)
                    
                        $SQL ="SELECT * FROM ViewRolePermission WHERE RVPID = LAST_INSERT_ID()  ;";
                        $Data= DB::select($SQL);
                        $jTableResult['Result'] = "OK";
                        $jTableResult['Record'] =$Data[0];
                    
                        
                }
                catch(Exception $ex)
                {
                    //Return error Message
                    
                    $jTableResult['Result'] = "ERROR";
                    $jTableResult['Message'] = $ex->getMessage();
                
                }
                return response()->json($jTableResult);
            }


    public function UpdateViewRolePermission(){
            $jTableResult =  array();
        
                try
                {

                    //Update record in database
                    $SQL="UPDATE ViewRolePermission SET
                            ViewName = '" . $_POST["ViewName"] . "' ,
                            RID=  '" . $_POST["RID"] . "' ,
                            ShowData=  '" . $_POST["ShowData"] . "',
                            InsertData=  '" . $_POST["InsertData"] . "' ,
                            UpdateData=  '" . $_POST["UpdateData"] . "',
                            DeleteData = '" . $_POST["DeleteData"] . "',
                            DataToPrint=  '" . $_POST["DataToPrint"] . "',
                            DataToExcel = '" . $_POST["DataToExcel"] . "'
                            WHERE RVPID = " . $_POST["RVPID"];
                    
                    DB::update($SQL);

                    //Return result to jTable
                    
                    $jTableResult['Result'] = "OK";

                    
                }
                catch(Exception $ex)
                {
                    //Return error Message
                    
                    $jTableResult['Result'] = "ERROR";
                    $jTableResult['Message'] = $ex->getMessage();
                }
                return response()->json($jTableResult);
        
        }

            //Deleting a record (deleteAction)
    public function DeleteViewRolePermission() {
            $jTableResult =  array();
                try
                {
                        //Delete from database
                        $SQL="DELETE FROM ViewRolePermission WHERE RVPID = " . $_POST["RVPID"] . ";";
                        DB::update($SQL);
                        //Return result to jTable
                        $jTableResult['Result'] = "OK";
                        
                }
                catch(Exception $ex)
                {
                    //Return error Message
                    $jTableResult['Result'] = "ERROR";
                    $jTableResult['Message'] = $ex->getMessage();
                }
            return response()->json($jTableResult);
     }
}
