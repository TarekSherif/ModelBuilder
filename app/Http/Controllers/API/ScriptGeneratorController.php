<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScriptGeneratorController extends Controller
{
    private $LayersType;  
    private $optimizerType;  
    private $NotTrainable=[];
    

    public function GenerateScript($ModelID)
    {
        $GenerateModelStructureScript = $this->GenerateModelStructureScript($ModelID);
        $GenerateModelOptionScript=$this->GenerateModelOptionScript($ModelID);
        $Script =  array_merge(
                        $this->GenerateImportScript(),
                        $GenerateModelStructureScript,
                        $this->NotTrainable,
                        $GenerateModelOptionScript
                    );
        



        return json_decode(json_encode($Script), true) ;
     }

     private function GenerateImportScript()
     {
   
         $Script =  array();
      
          
         $Script [] = $this->ImportStatement('tensorflow.keras.models','Sequential');
         $Script [] =$this->ImportStatement('tensorflow.keras.layers',ltrim(rtrim( $this->LayersType,", ")) );
         $Script [] =$this->ImportStatement('tensorflow.keras.optimizers',$this->optimizerType) ;
         $Script [] =$this->ImportStatement('tensorflow.keras','regularizers') ;
         return  $Script;
         
      }
      private function GenerateModelOptionScript($ModelID)
      {
    
          $Script =  array();
       
          $SQL=" 
          SELECT 
              MLParameter.PName , MLParameter.PValue 
         FROM MLParameter 
          join KLParameter on MLParameter.PName=KLParameter.PName and MLParameter.ModelID=$ModelID
          UNION
              SELECT KLParameter.PName  , KLParameter.DefautValue from KLParameter 
              WHERE 
              KLParameter.LName is null and 
              KLParameter.PName not in (
                SELECT  MLParameter.PName    FROM MLParameter WHERE  MLParameter.ModelID=$ModelID
          )";
        

       
          $ModelOption=array();
          $ModelsArray = json_decode(json_encode(DB::select($SQL)), true);
          foreach ($ModelsArray as $Option) {
            $ModelOption[$Option["PName"]]=$Option["PValue"];
          }
          
       
       if(!empty($ModelOption)  )
       {
            
           
            $Script [] ="\nmodel.compile(optimizer=". $ModelOption["optimizer"].",
            loss=<span class='s1'>'". $ModelOption["loss"]."'</span>,
            metrics=[<span class='s1'>'". $ModelOption["metrics"]."'</span>])";
            $Script [] ="\nH1= model.fit(X_train, Y_train, batch_size = ". $ModelOption["batch_size"].", epochs = ". $ModelOption["epochs"].") ";
            $this->optimizerType=substr($ModelOption["optimizer"], 0, strpos( $ModelOption["optimizer"],'('));
       }

        
          return  $Script;
       }
  
      private function ImportStatement($nn,$n)
      {
       return "\n<span class='kn'>from</span> <span class='nn'>$nn</span> <span class='k'>import</span> <span class='n'>$n</span> ";
      }
      private function GenerateModelStructureScript($ModelID)
      {
          $Script =  array();
          $this->LayersType=" ";
          $Script [] ="\nmodel = Sequential()";

          
          $SQL ="SELECT   `LayerID` ,`LName`, `LCategory`,`trainable`
                  FROM `MLayer`
                  WHERE `ModelID` ='$ModelID'
                  ORDER BY `MLayer`.`SOrder` ASC";

       $Layers= DB::select($SQL);
       if(!empty($Layers)  )
       {
           foreach ($Layers as  $Layer) {
                $trainable="\n";
                if($Layer->trainable==0){
                    $trainable=$trainable.$Layer->LName."=";
                    $this->NotTrainable[]="\n".$Layer->LName.".trainable = False";
                }
                 
                $Script [] =$trainable.$this->GenerateLayerScript($Layer->LayerID ,$Layer->LCategory);

                $this->LayersType=( strpos( $this->LayersType,$Layer->LCategory) == false )? $this->LayersType . $Layer->LCategory .",":$this->LayersType;
           }
       }
 
          return  $Script;
       }
       private function GenerateLayerScript($LayerID,$LCategory)
       {
           $LayerScript = "";
           $LayerScript = $LCategory ."(".$this->GenerateLayerParameterScript($LayerID,$LCategory).")";
           return "model.add(".$LayerScript.")";
        }
        private function GenerateLayerParameterScript($LayerID,$LCategory)
        {
 
            $LayerParameterScript = "";
 
            $SQL ="SELECT   MLParameter.PName,MLParameter.PValue ,KLParameter.PType
                    FROM MLParameter
                    join KLParameter on KLParameter.PName=MLParameter.PName and KLParameter.LName='$LCategory' and LayerID ='$LayerID' ";
              
 
         $Data= DB::select($SQL);
         if(!empty($Data)  )
         {
             foreach ($Data as  $Parameter) {
                 
                if($Parameter->PType=="number"){
                   $LayerParameterScript=$LayerParameterScript. $Parameter->PName . "<span class='o'>=</span>".'<span class="mi">'. $Parameter->PValue.'</span>,'  ;
                }elseif ($Parameter->PType=='Text' || $Parameter->PType==  'Activation') {
                    $LayerParameterScript=$LayerParameterScript. $Parameter->PName . "<span class='o'>=</span>".'<span class="s1">"'. $Parameter->PValue.'"</span>,'  ;
                } else {
                    $LayerParameterScript=$LayerParameterScript. $Parameter->PName. "<span class='o'>=</span>".$Parameter->PValue  . ","  ;
                }
                // $LayerParameterScript=$LayerParameterScript. $Parameter->PName. "<span class='o'>=</span>".$Parameter->PValue  . ","  ;
                // <span class="mi">784</span>
             }
         }
            return rtrim($LayerParameterScript,", ");
         }
  


}
      