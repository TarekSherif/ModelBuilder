<?php

if ( ! function_exists('config_path'))
{
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

 function RoleMenu()
{
      $RID=(Auth::check())?Auth::user()->role:0;
      $roleMenu = array();
       $SQL ="SELECT `ViewName`.`ViewName` ,`ViewName`.`ViewIcon`
              FROM `ViewName`    join `ViewRolePermission` 
              on `ViewName`.`ViewName`=`ViewRolePermission`.`ViewName`and 
              `ViewRolePermission`.`RID`=$RID and
              `ViewRolePermission`.`ShowData`=true  and 
              `ViewName`.`ViewGroup`='Settings' 
              order by `ViewName`.`SOrder`";

       $Data= DB::select($SQL);
       if(!empty($Data) &&  $RID!=0 )
       {
              $roleMenu=  json_decode(json_encode($Data), true) ;
       }


       return  $roleMenu;

}



function PagePermission ($viewName = "")
{
       $RID=(Auth::check())?Auth::user()->role:0;
       $Permission = array(
              'ShowData'=> false, 
              'InsertData'=> false,
              'UpdateData'=> false,
              'DeleteData'=> false,
              'DataToExcel'=> false,
              'DataToPrint'=> false );

    $SQL ="SELECT  `ShowData`, `InsertData`, `UpdateData`, `DeleteData` , `DataToExcel`, `DataToPrint` 
           FROM `ViewRolePermission`
           WHERE `ViewName`='$viewName' and  `RID`=$RID";
    $Data= DB::select($SQL);
    if(!empty($Data) &&  $RID!=0 )
    {
       $Permission=  json_decode(json_encode($Data[0]), true) ;
    }
 

    return $Permission;
  
}


function CurrentOrder ($TName ,$FKName,$FKValue)
{
      
    $CurrentOrder  =1;

    $SQL ="SELECT  Max(SOrder) as CurrentOrder
           FROM $TName
           WHERE $FKName ='$FKValue'";

    $Data= DB::select($SQL);
    if(!empty($Data)  )
    {
       $CurrentOrder=  json_decode(json_encode($Data[0]), true) ;
    }
 

    return $CurrentOrder["CurrentOrder"]+1;
  
}