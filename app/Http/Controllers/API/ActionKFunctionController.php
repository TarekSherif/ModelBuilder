<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionKFunctionController extends Controller
{

    public function ListOfChangedLayerParameters($LayerID)
    {
        $jTableResult =  array();
   
          try
          {
             
                $SQL="select 
                             PID, PName , PValue  
                    from MLParameter 
                    where LayerID=$LayerID";
     
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

    
    //ObjectID= LayerID,ModelID
    // $OType=Model,LayerType
    public function GetLayerParameters($ObjectID,$OType)
    {
      $Result =  array();
   
          try
          {
            $SQL="";
            if($OType=="Model"){
                $SQL=" 
                select 
                   MLParameter.PName , MLParameter.PValue , KLParameter.PType ,KLParameter.`SOrder` 
                 from MLParameter   
                 join KLParameter on MLParameter.PName=KLParameter.PName and MLParameter.ModelID=$ObjectID
                WHERE 
                      KLParameter.LName is null 
               UNION
               SELECT 
                    KLParameter.PName  , KLParameter.DefautValue, KLParameter.PType, `SOrder`
                from KLParameter 
                WHERE 
                KLParameter.LName is null and 
                KLParameter.PName not in (
                    select 
                         MLParameter.PName 
                    from MLParameter 
                    where  MLParameter.ModelID=$ObjectID)
                ORDER BY  `SOrder` ASC
                
         
                ";
         }
         else{
                $SQL="select 
                    MLParameter.PName , MLParameter.PValue , KLParameter.PType 
                    from MLParameter 
                    join KLParameter on MLParameter.PName=KLParameter.PName and MLParameter.LayerID=$ObjectID
                UNION
                    SELECT KLParameter.PName  , KLParameter.DefautValue, KLParameter.PType  from KLParameter 
                    WHERE 
                    KLParameter.LName='$OType' and 
                    KLParameter.PName not in (
                    select  MLParameter.PName    from MLParameter where  MLParameter.LayerID=$ObjectID
                ORDER BY  `SOrder` ASC
            )";
         }
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


    public function ListOfACModel()
    {
      $Result =  array();
   
          try
          {
          
            $whereUModel=  " and  MName like   '".((isset($_GET['term']))?$_GET['term']:"")."%'";
            $whereMyModelOnly= ( isset($_GET['UID']))?" and createby=".$_GET['UID']:"";

            $SQL="SELECT `ModelID`, `MName` as label
                   FROM `UModel` 
                   where   1=1 
                   $whereUModel
                   $whereMyModelOnly"; 

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


    
    public function ListOfACType($Type)
    {
      $Result =  array();
   
          try
          {
            $where="'%".((isset($_GET['term']))?$_GET['term']:"")."%'";
               
            $SQL="SELECT `KFunction`  as label  
                   FROM `KFunction`  
                   where
                    `KCategory`='$Type'  and 
                    CONCAT(' ',KFunction) like  $where  ";

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


    public function ListOfACLayerType()
    {
      $Result =  array();
    
          try
          {
            

            $where="'%".((isset($_GET['term']))?$_GET['term']:"")."%'";
               
            $SQL="SELECT `LName`  as label  , `KLType` 
                   FROM `KLayer`  where
                   CONCAT(' ',LName)  like  $where   
             UNION 
             SELECT `LName`  as label  , `KLType` 
                   FROM `KLayer`
                   where `KLType` like  $where  "; 

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


    // {{url("/")}}/api/KFunctionListoptions
    public function KFunctionListoptions()
    {
      $jTableResult =  array();
    
          try
          {
              $SQL ='SELECT `LicenseID` as "Value",`KFunction` as "DisplayText" FROM `KFunction` order by SOrder';
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
        public function ListOfKFunctions()
        {
          $jTableResult =  array();
        
              try
              {
                  $SQL ="SELECT * FROM KFunction  order by SOrder  ";
                  
                  
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
        public function CreateKFunction()
        {
            
          $jTableResult =  array();
                  try 
                  {
                          //Insert record into database
                          $SQL="INSERT INTO KFunction(KFunction,SOrder) VALUES('" . $_POST["KFunction"] . "' ,'" . $_POST["SOrder"] . "');";
                          DB::insert( $SQL);
                          //Get last inserted record (to return to jTable)
                         
                          $SQL ="SELECT * FROM KFunction WHERE LicenseID = LAST_INSERT_ID();";
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
      
              public function AutoSave( $ObjectID,$PName,$PValue)
              {
                  $jTableResult =  array();
              
                      try
                      {
                        if(strpos($PName, "Model_") !== false){
                            $PName= str_replace("Model_", '', $PName);
                            $where =" where `ModelID`='$ObjectID' and `PName`='$PName'";
                            $INSERT="INSERT INTO `MLParameter`( `PName`, `PValue`, `ModelID`) VALUES ('$PName','$PValue','$ObjectID')";
                        } else{
                            $where =" where`LayerID`='$ObjectID' and `PName`='$PName'";
                            $INSERT="INSERT INTO `MLParameter`( `PName`, `PValue`, `LayerID`) VALUES ('$PName','$PValue','$ObjectID')";
                        }
                        $SQL ="SELECT * FROM MLParameter". $where ;
                  
                  
                        $Data= DB::select($SQL);

                        if(!empty($Data)  )
                        {
                             //Update MLParameter in database
                          $SQL="UPDATE `MLParameter` SET
                          `PValue` = '$PValue' ".$where ;
                          DB::update($SQL);
                        }
                        else {
                            //Insert MLParameter in database
                         
                            DB::insert($INSERT);
                        }
                     
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



              public function UpdateKFunction()
              {
                  $jTableResult =  array();
              
                      try
                      {
      
                          //Update record in database
                          $SQL="UPDATE KFunction SET
                             KFunction = '" . $_POST["KFunction"] . "',
                             SOrder= '" . $_POST["SOrder"] . "'
                            WHERE LicenseID = " . $_POST["LicenseID"];
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
                    public function DeleteKFunction()
                    {
                      $jTableResult =  array();
                          try
                          {
                                  //Delete from database
                                  $SQL="DELETE FROM KFunction WHERE LicenseID = " . $_POST["LicenseID"] . ";";
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
      