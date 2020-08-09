@csrf
<fieldset>
    <div class="container">
        <div class="row">

            <input name="DSID" id="DSID" type="hidden" value="{{old('DSID',$DS->DSID)}}" />

            <div class="col-xs-2">
                <div class="form-group ">
                    <label for='Name' class=" col-form-label text-md-right"> @lang('messages.DS.Name') </label>
                    <input id='Name' type="text" class="form-control{{ $errors->has('Name') ? ' is-invalid' : '' }}" name='Name' value="{{old('Name',$DS->Name)}}"
                        autofocus> @if ($errors->has('Name'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('Name') }}</strong>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-xs-4">
                <div class="form-group ">
                    <label for='URL' class=" col-form-label text-md-right"> @lang('messages.DS.URL') </label>
                    <input id='URL' type="text" class="form-control{{ $errors->has('URL') ? ' is-invalid' : '' }}" name='URL' value="{{old('URL',$DS->URL)}}"
                        autofocus> @if ($errors->has('URL'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('URL') }}</strong>
                    </div>
                    @endif
                </div>
            </div>
    


            <div class="col-xs-2">
                <br>
             

                <button type="submit" form="frmDS" class="btn btn-primary" id="btnSave">
                    <i class="fa fa-floppy-o"></i>
                </button>
            
             
                
                <a class="btn btn-danger"  id="btnDelete"    >
                    <i class="fa fa-trash "></i>
                </a> 
                
               

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
                            value="{{old('optimizer',$DS->optimizer)}}"> @if ($errors->has('optimizer'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('optimizer') }}</strong>
                                </span> @endif
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group ">
                        <label for='loss' class="  col-form-label text-md-right">@lang('messages.loss') </label>
                        <input id='loss' type="text" class="form-control{{ $errors->has('loss') ? ' is-invalid' : '' }}" name='loss' value="{{old('loss',$DS->loss)}}">                        @if ($errors->has('loss'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('loss') }}</strong>
                                </span> @endif
                    </div>
                </div>
                <div class="col-xs-12">


                    <div class="form-group ">
                        <label for='metrics' class="  col-form-label text-md-right">@lang('messages.metrics') </label>
                        <input id='metrics' type="text" class="form-control{{ $errors->has('metrics') ? ' is-invalid' : '' }}" name='metrics' value="{{old('metrics',$DS->metrics)}}">                        @if ($errors->has('metrics'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('metrics') }}</strong>
                                </span> @endif
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group ">
                        <label for='batch_size' class="  col-form-label text-md-right">@lang('messages.batch_size') </label>
                        <input id='batch_size' type="number" class="form-control{{ $errors->has('batch_size') ? ' is-invalid' : '' }}" name='batch_size'
                            value="{{old('batch_size',$DS->batch_size)}}"> @if ($errors->has('batch_size'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('batch_size') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group ">
                        <label for='epochs' class="  col-form-label text-md-right">@lang('messages.epochs') </label>
                        <input id='epochs' type="number" class=" auto-save form-control{{ $errors->has('epochs') ? ' is-invalid' : '' }}" name='epochs'
                            value="{{old('epochs',$DS->epochs)}}"> @if ($errors->has('epochs'))
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



 
    <div id="DSContainer" class='@lang("messages.Clang") '></div>
 