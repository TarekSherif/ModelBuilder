<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLayerController extends Controller
{

   

    
        //Getting records (listAction)
        public function ListOfLayers()
        {
          $jTableResult =  array();
        
              try
              {
                  $ModelID=$_GET["ModelID"];
                  $SQL ="SELECT `MLayer`.`LayerID`,
                                `MLayer`.`LName`,
                                `MLayer`.`LCategory`,
                                `MLayer`.`trainable`,
                                `MLayer`.`ModelID`,
                                `MLayer`.`SOrder`,
                                `KLayer`.`HelpUrl`
                         FROM `MLayer`
                         LEFT join `KLayer` ON `MLayer`.`LCategory`=`KLayer`.`LName`  
                         Where `MLayer`.`ModelID`='$ModelID'
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
        public function CreateLayer()
        {
            
          $jTableResult =  array();
                  try 
                  {

                  $SOrder=CurrentOrder("MLayer","ModelID",$_POST["ModelID"]);


                          //Insert record into database

                          $SQL='INSERT INTO MLayer( `LName`,`LCategory`,`trainable`,`ModelID`,`SOrder`) VALUES("'.$_POST["LName"].'","'.$_POST["LCategory"].'","'.$_POST["trainable"].'","'.$_POST["ModelID"].'", "'.$SOrder.'")';

                          DB::insert($SQL);
                          //Get last inserted record (to return to jTable)
                           
                          $SQL ="SELECT * FROM MLayer WHERE LayerID = LAST_INSERT_ID();";
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
      
      
              public function UpdateLayer()
              {
                  $jTableResult =  array();
              
                      try
                      {
      

                        $SQL="SELECT `LayerID`, `LName`, `LCategory`, `trainable`, `ModelID`, `SOrder` FROM `MLayer`
                              WHERE LayerID = '". $_POST["LayerID"]."'";
                        $Data=DB::select($SQL);
                        if(!empty($Data))
                        {
                            if($Data[0]->LCategory !=  $_POST["LCategory"])
                            {
                                $SQL="DELETE FROM `MLParameter`  
                                WHERE LayerID = '". $_POST["LayerID"]."'";
                                DB::delete($SQL);
                            }
                        }
                          //Update record in database
                          $SQL="UPDATE MLayer SET
                            LName= '". $_POST["LName"]."',
                            LCategory=  '". $_POST["LCategory"]."',
                            trainable= '". $_POST["trainable"]."' 
                            WHERE LayerID = '". $_POST["LayerID"]."'";
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
                    public function DeleteLayer()
                    {
                      $jTableResult =  array();
                          try
                          {
                                  //Delete from database
                                  $SQL="DELETE FROM MLayer WHERE LayerID = " . $_POST["LayerID"] . ";";
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
      