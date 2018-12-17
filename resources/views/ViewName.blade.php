
@extends('layouts.index')

@section('ScriptContent')
               


<script type="text/javascript">
$(function () {

        $('#jtableContainer').jtable({
            title: '<i class="fa fa-file-text  " style="color: orange;" aria-hidden="true"></i>	 @lang("messages.ViewName")',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting:'SOrder ASC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
            actions: {
				listAction:   '{{url("/")}}/api/ListOfViewNames?_token={{ csrf_token() }}',
                createAction: '{{url("/")}}/api/CreateViewName?_token={{ csrf_token() }}',
                updateAction: '{{url("/")}}/api/UpdateViewName?_token={{ csrf_token() }}',
                deleteAction: '{{url("/")}}/api/DeleteViewName?_token={{ csrf_token() }}'
            }
            ,@include('layouts.inc.JtableToolbar'),
            fields: {
                
                ViewName: {
                    title:'@lang("messages.ViewName")',
                    key: true,
                    list: true,
                    create: true,
        			edit: false,
                    inputClass:"form-control validate[required]"

				},
			
                ViewIcon: {
                    title: '@lang("messages.ViewIcon")',
					inputClass:"form-control validate[required]"
					
				},
                ViewGroup: {
                    title: '@lang("messages.ViewGroup")',
					inputClass:"form-control validate[required]"
					
				},
                ARName: {
                    title: '@lang("messages.ARName")',
					inputClass:"form-control validate[required]"
					
				},
                SOrder: {
						title:'@lang("messages.SOrder")',
							visibility: 'visible',
							width: '10%',
						input: function (data) {
								if (data.record) {
									return '<input type="number"  placeholder=" @lang("messages.SOrder")"   class=" form-control validate[required]"   autocomplete="off"   name="SOrder"   value="' + data.record.SOrder + '" />';
								} else {
									return '<input type="number"  placeholder=" @lang("messages.SOrder")"     class="form-control validate[required]"  autocomplete="off"   name="SOrder"     />';
								}
							}  
					},
				
            }
            @include('layouts.inc.JtableEvent')
        });
 
        //Load student list from server
        $('#jtableContainer').jtable('load');
 
    });
 


</script>


@endsection
