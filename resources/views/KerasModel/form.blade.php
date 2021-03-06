@csrf
<fieldset>
    <div class="container">
        <div class="row">

            <input name="ModelID" id="ModelID" type="hidden" value="{{old('ModelID',$KerasModel->ModelID)}}" />

            <div class="col-xs-4">
                <div class="form-group ">
                    <label for='MName' class=" col-form-label text-md-right"> @lang('messages.MName') </label>
                    <input id='MName' type="text" class="form-control{{ $errors->has('MName') ? ' is-invalid' : '' }}" name='MName' value="{{old('MName',$KerasModel->MName)}}"
                        autofocus> @if ($errors->has('MName'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('MName') }}</strong>
                    </div>
                    @endif
                </div>
            </div>


      
            <div class="col-xs-5">
                <br>
                <!-- <a href="#" class="btn btn-primary" data-toggle="popover" data-placement="bottom" data-popover-content="#delivery">
                    <i class="fa fa-gears"></i>
                </a> -->

                <button type="submit" form="frmKerasModel" class="btn btn-primary" id="btnSave">
                    <i class="fa fa-floppy-o"></i>
                </button>
                <a class="btn btn-primary " id="btnfork"   >
                    <i class="fa fa-code-fork"></i>
                </a> 
                <!-- $KerasModel->ModelID -->
                
                <a class="btn btn-danger"  id="btnDelete"    >
                    <i class="fa fa-trash "></i>
                </a> 
                
                <a class="btn btn-primary" id="btnjupyterScript"  data-toggle="collapse" data-target="#jupyterScript">
                    <i class="fa fa-file-powerpoint-o"></i>
                </a>

             

            </div>
            <div class="col-xs-3">
            <br>
                <div class="btn-group">
                        <a id="btn_jtableContainer" class="btn btn-primary active  grid-view">
                            <i class="fa fa-ellipsis-v  " ></i>
                        </a>
                        <a  id="btn_DSContainer" class="btn btn-primary grid-view"  >
                            <i class="fa fa-database"></i>
                        </a>
                    
                </div>
            </div>
        </div>
    </div>


    <!-- <div id="delivery" class="hidden">
        <div class="popover-heading">@lang("messages.ModelOptions")</div>

        <div class="popover-body">
            <div class="row">
                <div class="col-xs-12">

                    <div class="form-group ">
                        <label for='optimizer' class="  col-form-label text-md-right">@lang('messages.optimizer') </label>
                        <input id='optimizer' type="text" class="form-control{{ $errors->has('optimizer') ? ' is-invalid' : '' }}" name='optimizer'
                            value="{{old('optimizer',$KerasModel->optimizer)}}"> @if ($errors->has('optimizer'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('optimizer') }}</strong>
                                </span> @endif
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group ">
                        <label for='loss' class="  col-form-label text-md-right">@lang('messages.loss') </label>
                        <input id='loss' type="text" class="form-control{{ $errors->has('loss') ? ' is-invalid' : '' }}" name='loss' value="{{old('loss',$KerasModel->loss)}}">                        @if ($errors->has('loss'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('loss') }}</strong>
                                </span> @endif
                    </div>
                </div>
                <div class="col-xs-12">


                    <div class="form-group ">
                        <label for='metrics' class="  col-form-label text-md-right">@lang('messages.metrics') </label>
                        <input id='metrics' type="text" class="form-control{{ $errors->has('metrics') ? ' is-invalid' : '' }}" name='metrics' value="{{old('metrics',$KerasModel->metrics)}}">                        @if ($errors->has('metrics'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('metrics') }}</strong>
                                </span> @endif
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group ">
                        <label for='batch_size' class="  col-form-label text-md-right">@lang('messages.batch_size') </label>
                        <input id='batch_size' type="number" class="form-control{{ $errors->has('batch_size') ? ' is-invalid' : '' }}" name='batch_size'
                            value="{{old('batch_size',$KerasModel->batch_size)}}"> @if ($errors->has('batch_size'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('batch_size') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group ">
                        <label for='epochs' class="  col-form-label text-md-right">@lang('messages.epochs') </label>
                        <input id='epochs' type="number" class=" auto-save form-control{{ $errors->has('epochs') ? ' is-invalid' : '' }}" name='epochs'
                            value="{{old('epochs',$KerasModel->epochs)}}"> @if ($errors->has('epochs'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('epochs') }}</strong>
                                </span> @endif

                    </div>
                </div>
            </div>
        </div>
    </div> -->


</fieldset>

</form>





<div id="collapseLayers" class="white-Background collapse">

    <div id="jtableContainer" class='@lang("messages.Clang") jtable-grid-view'></div>
    <div id="DSContainer" class='@lang("messages.Clang") jtable-grid-view' style="display: none;"></div>

</div>



 <div style="height: 200px !important;overflow: scroll;"> 
    <div class=" highlight hl-ipython3 collapse"  id="jupyterScript"   aria-expanded="false" >
        <pre id="jupyterBady">
            
        </pre>
    </div>
 </div>
