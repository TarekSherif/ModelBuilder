<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScriptGeneratorController extends Controller
{
    private $LayersType;  
    private $optimizerType;  
    

    public function GenerateScript($ModelID)
    {
        $GenerateModelStructureScript = $this->GenerateModelStructureScript($ModelID);
        $GenerateModelOptionScript=$this->GenerateModelOptionScript($ModelID);
        $Script =  array_merge(
                        $this->GenerateImportScript(),
                        $GenerateModelStructureScript,
                        $GenerateModelOptionScript
                    );
        



        return json_decode(json_encode($Script), true) ;
     }

     private function GenerateImportScript()
     {
   
         $Script =  array();
      
         $Script [] ="
        <span class='kn'></span><span class='kn'>import</span> <span class='nn'>keras</span> ";
         $Script [] = $this->ImportStatement('keras.models','Sequential');
         $Script [] =$this->ImportStatement('keras.layers',ltrim(rtrim( $this->LayersType,", ")) );
         $Script [] =$this->ImportStatement('keras.optimizers',$this->optimizerType) ;
         $Script [] =$this->ImportStatement('keras','regularizers') ;
         return  $Script;
         
      }
      private function GenerateModelOptionScript($ModelID)
      {
    
          $Script =  array();
       
          
          $SQL ="SELECT   *
                  FROM `UModel`
                  WHERE `ModelID` ='$ModelID'";

       $Models= DB::select($SQL);
       if(!empty($Models)  )
       {
           $Model=$Models[0];
           
        $Script [] ="
        model.compile(optimizer=". $Model->optimizer.",
        loss=<span class='s1'>'". $Model->loss."'</span>,
        metrics=[<span class='s1'>'". $Model->metrics."'</span>])
        H1= model.fit(X_train, Y_train, batch_size = ". $Model->batch_size.", epochs = ". $Model->epochs.") ";
        $this->optimizerType=substr($Model->optimizer, 0, strpos( $Model->optimizer,'('));
       }

        
          return  $Script;
       }
  
      private function ImportStatement($nn,$n)
      {
       return "
        <span class='kn'>from</span> <span class='nn'>$nn</span> <span class='k'>import</span> <span class='n'>$n</span> ";
      }
      private function GenerateModelStructureScript($ModelID)
      {
          $Script =  array();
          $this->LayersType=" ";
          $Script [] ="
        model = Sequential()";

          
          $SQL ="SELECT   `LayerID` , `LCategory`
                  FROM `MLayer`
                  WHERE `ModelID` ='$ModelID'";

       $Layers= DB::select($SQL);
       if(!empty($Layers)  )
       {
           foreach ($Layers as  $Layer) {
            $Script [] =$this->GenerateLayerScript($Layer->LayerID ,$Layer->LCategory);

            $this->LayersType=( strpos( $this->LayersType,$Layer->LCategory) == false )? $this->LayersType . $Layer->LCategory .",":$this->LayersType;
           }
       }
          $Script [] ="
        model.summary()";
          return  $Script;
       }
       private function GenerateLayerScript($LayerID,$LCategory)
       {
           $LayerScript = "";
           $LayerScript = $LCategory ."(".$this->GenerateLayerParameterScript($LayerID,$LCategory).")";
           return "
        model.add(".$LayerScript.")";
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
      