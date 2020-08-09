<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionDSModelController extends Controller
{

    public function ListOfACDS()
    {
      $Result =  array();
   
          try
          {
            $whereUDS=  " and  name like   '".((isset($_GET['term']))?$_GET['term']:"")."%'";
            $whereMyDSOnly= ( isset($_GET['UID']))?" and createby=".$_GET['UID']:"";

            $SQL="SELECT `DSID`, `Name` as label
                   FROM `UDS` 
                   where   1=1 
                   $whereUDS
                   $whereMyDSOnly"; 

              $Data= DB::select($SQL);
             
              $Result =$Data;
             
          }
          catch(Exception $ex)
          {
              //Return error Message
              $Result['Result'] = "ERROR";
              $Result['Message'] = $ex->getMessage();
             
          }
          return response()->json($Result);
          }


        
        public function ListOfDSModels()
        {
          $jTableResult =  array();
        
              try
              {
                  $WhereDSID=isset($_GET["DSID"])?"`DSID`='".$_GET["DSID"]."'":"";
                  $WhereModelID=isset($_GET["ModelID"])?"`ModelID`='".$_GET["ModelID"]."'":"";

                  $SQL ="SELECT `DSModelID`,
                                `DSID`,
                                `ModelID`,
                                `Train_loss`,
                                `Train_score`,
                                `Val_loss`,
                                `Val_score`,
                                `Test_loss`,
                                `Test_score`
                         FROM `DSModels`
                         Where    $WhereDSID  $WhereModelID
                         order by SOrder  ";
                    
                  $Data= DB::select($SQL );
                  
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
        public function CreateDSModel()
        {
            
          $jTableResult =  array();
                  try 
                  {

                    $SOrder=1;
                    // CurrentOrder("DSModels","DSModelID",$_POST["DSModelID"]);

        //  DSModels `DSModelID` 
        //   `DSID`  ,`ModelID`  , `Train_loss`,   `Train_score`,   `Val_loss`,   `Val_score`,  `Test_loss`,   `Test_score`, `SOrder`
                          //Insert record into database

                          $SQL='INSERT INTO DSModels( `DSID`  ,`ModelID`  , `Train_loss`,   `Train_score`,   `Val_loss`,   `Val_score`,  `Test_loss`,   `Test_score`, `SOrder`) 
                                VALUES("'.$_POST["DSID"].'","'.$_POST["ModelID"]
                                .'","'.$_POST["Train_loss"].'","'.$_POST["Train_score"]
                                .'", "'.$_POST["Val_loss"].'","'.$_POST["Val_score"]
                                .'","'.$_POST["Test_loss"].'","'.$_POST["Test_score"].'",'.$SOrder.')';
                             
                          DB::insert($SQL);
                          //Get last inserted record (to return to jTable)
                           
                          $SQL ="SELECT * FROM DSModels WHERE DSModelID= LAST_INSERT_ID();";
                          $Data= DB::select($SQL)[0];

                     

                          $jTableResult['Result'] = "OK";
                          $jTableResult['Record'] =$Data;
                          
                    

                          
                  }
                  catch(Exception $ex)
                  {
                      //Return error Message
                      
                      $jTableResult['Result'] = "ERROR";
                      $jTableResult['Message'] = $ex->getMessage();
                    
                  }
                  return response()->json($jTableResult);
              }
      
      
              public function UpdateDSModel()
              {
                  $jTableResult =  array();
              
                      try
                      {
      
  //  DSModels `DSModelID` 
        //   `DSID`  ,`ModelID`  , `Train_loss`,   `Train_score`,   `Val_loss`,   `Val_score`,  `Test_loss`,   `Test_score`, `SOrder`
       
                       
                          //Update record in database
                          $SQL="UPDATE DSModels SET
                          `DSID` = '". $_POST["DSID"]."',
                          `ModelID`  = '". $_POST["ModelID"]."',
                          `Train_loss`= '". $_POST["Train_loss"]."',
                          `Train_score`= '". $_POST["Train_score"]."',
                          `Val_loss`= '". $_POST["Val_loss"]."',
                          `Val_score`= '". $_POST["Val_score"]."',
                          `Test_loss`= '". $_POST["Test_loss"]."',
                          `Test_score` = '". $_POST["Test_score"]."'
                            WHERE DSModelID = '". $_POST["DSModelID"]."'";
                             
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
                    public function DeleteDSModel()
                    {
                      $jTableResult =  array();
                          try
                          {
                                  //Delete from database
                                  $SQL="DELETE FROM DSModels WHERE DSModelID= " . $_POST["DSModelID"] . ";";
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


                // {{url("/")}}/api/ViewNameListoptions
    public function DSListoptions()
    {
      $jTableResult =  array();
    
          try
          {
 
            
            $SQL ="SELECT `DSID` as 'Value',`Name` as 'DisplayText' 
                FROM `UDS` 
                order by `Name` ";
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

          public function ModelListoptions()
          {
            $jTableResult =  array();
          
                try
                {
       
                  
                  $SQL ="SELECT `ModelID` as 'Value',`MName` as 'DisplayText' 
                      FROM `UModel` 
                      order by `MName` ";
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
      
      }
      