<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionViewNameController extends Controller
{

    // public function ListOfACViewName()
    // {
    //   $Result =  array();
    
    //       try
    //       {
            
    //         $where=" where ARName like '".((isset($_GET['term']))?$_GET['term']:"")."%'";
    //         $SQL="SELECT  `ViewName` as 'value',`ARName` as 'label' FROM `ViewName` $where ;";
      
    //         // $where=" where phone like '".((isset($_GET['term']))?$_GET['term']:"")."%'";
    //         // $SQL="SELECT  `OrderID` as 'value',`phone` as 'label' FROM `TOrder` $where ;";
      

    //           $Data= DB::select($SQL);
             
    //           $Result =$Data;
             
    //       }
    //       catch(Exception $ex)
    //       {
    //           //Return error Message
    //           $Result['Result'] = "ERROR";
    //           $Result['Message'] = $ex->getMessage();
             
    //       }
    //       return response()->json($Result);
    //       }


    // {{url("/")}}/api/ViewNameListoptions
    public function ViewNameListoptions()
    {
      $jTableResult =  array();
    
          try
          {
            //   $RID=$_GET["RID"];
            //   $SQL ="SELECT `ViewName`.`ViewName` as 'Value',`ViewName`.`ARName` as 'DisplayText' 
            //         FROM `ViewName`  LEFT  join `ViewRolePermission` 
            //         on `ViewName`.`ViewName`=`ViewRolePermission`.`ViewName`and `ViewRolePermission`.`RID`= $RID
            //         where ViewRolePermission.RVPID is null
            //         order by `ViewName`.`SOrder`";
            
            $SQL ="SELECT `ViewName`.`ViewName` as 'Value',`ViewName`.`ARName` as 'DisplayText' 
                FROM `ViewName` 
                order by `ViewName`.`SOrder`";
              $Data= DB::select($SQL);
              $jTableResult['Result'] = "OK";
              $jTableResult['Options'] =$Data;
             
          }
          catch(Exception $ex)
          {
              //Return error Message
              $jTableResult['Result'] = "ERROR";
              $jTableResult['Message'] = $ex->getMessage();
             
          }
          return response()->json($jTableResult);
          }

        //Getting records (listAction)
        public function ListOfViewNames()
        {
          $jTableResult =  array();
        
              try
              {
                  $SQL ="SELECT * FROM ViewName  order by SOrder  ";
                  
                  
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
        public function CreateViewName()
        {
            
          $jTableResult =  array();
                  try 
                  {
                          //Insert record into database
                          $SQL="INSERT INTO ViewName(ViewName,ViewIcon,ARName,ViewGroup,SOrder) VALUES
                          ('" . $_POST["ViewName"] . "' ,'" . $_POST["ViewIcon"] . "' ,'" . $_POST["ARName"] . "' ,'" . $_POST["ViewGroup"] . "','" . $_POST["SOrder"] . "');";
                          DB::insert( $SQL);
                          //Get last inserted record (to return to jTable)
                         
                          $SQL ="SELECT * FROM ViewName WHERE ViewName = '" . $_POST["ViewName"] . "'";
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
      
      
              public function UpdateViewName()
              {
                  $jTableResult =  array();
              
                      try
                      {
      
                          //Update record in database
                          $SQL="UPDATE ViewName SET
                             ARName = '" . $_POST["ARName"] . "',
                             ViewIcon = '" . $_POST["ViewIcon"] . "',
                             ViewGroup = '" . $_POST["ViewGroup"] . "',                             
                             SOrder= '" . $_POST["SOrder"] . "'
                            WHERE ViewName = '" . $_POST["ViewName"] ."'";
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
                    public function DeleteViewName()
                    {
                      $jTableResult =  array();
                          try
                          {
                                  //Delete from database
                                  $SQL="DELETE FROM ViewName WHERE ViewName = '" . $_POST["ViewName"] . "';";
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
      