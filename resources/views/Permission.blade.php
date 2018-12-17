
@extends('layouts.index')

@section('ScriptContent')
               


<script type="text/javascript">
$(function () {

        $('#jtableContainer').jtable({
            title: '<i class="fa fa-file-text  " style="color: orange;" aria-hidden="true"></i>	 @lang("messages.Roles")',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'SOrder ASC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
            actions: {
				listAction:   '{{url("/")}}/api/ListOfRoles?_token={{ csrf_token() }}',
                createAction: '{{url("/")}}/api/CreateRole?_token={{ csrf_token() }}',
				@if ($Permission["UpdateData"])
                updateAction: '{{url("/")}}/api/UpdateRole?_token={{ csrf_token() }}',
				@endif
                deleteAction: '{{url("/")}}/api/DeleteRole?_token={{ csrf_token() }}'
            }
            ,@include('layouts.inc.JtableToolbar'),
            fields: {
                
                RID: {
                    key: true,
                    list: false
				},	//CHILD TABLE DEFINITION FOR "PHONE NUMBERS"
					ViewRolePermission: {
						title:"",
						width: '5%',
						sorting: false,
						edit: false,
						create: false,
						display: function (RoleData) {
							//Create an image that will be used to open child table
							var $img = $('<i class="fa  fa-cogs  fa-fw  fa-2x" style="color: #b90606;" aria-hidden="true"></i>');
							//Open child table when user clicks the image {{--&RID='+RoleData.record.RID--}}
							$img.click(function () {
								$('#jtableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title:'<i class="fa fa-lock  fa-fw  " style="color: #b90606;" aria-hidden="true"></i>-    @lang("messages.Permission")',
											defaultSorting:"SOrder ASC",
											actions: {
												listAction:   '{{url("/")}}/api/ListOfViewRolePermissions/'+RoleData.record.RID+'?_token={{ csrf_token() }}',
												// createAction: '{{url("/")}}/api/CreateViewRolePermission?_token={{ csrf_token() }}',
												updateAction: '{{url("/")}}/api/UpdateViewRolePermission?_token={{ csrf_token() }}',
												// deleteAction: '{{url("/")}}/api/DeleteViewRolePermission?_token={{ csrf_token() }}'
											
											},
											fields: {
												RID: {
													type:"hidden",
													defaultValue: RoleData.record.RID,
													
													},
												RVPID: {
													key: true,
													create: false,
													edit: false,
													list: false
													},
												ViewName: {
													title:  '@lang("messages.ViewName")',
													inputClass:"form-control  validate[required]",
													options: '{{url("/")}}/api/ViewNameListoptions?_token={{ csrf_token()}}'
													},
												ShowData: {
													title: '@lang("messages.ShowData")',
													type: 'radiobutton',
													defaultValue:'1',
                    								options: { 
															'0': '@lang("messages.Prevention")',
															'1': '@lang("messages.Allow")'
															 }							
														 },
												InsertData: {
													title: ' @lang("messages.InsertData")',
													defaultValue:'0',
													type: 'radiobutton',
                    								options: { 
															'0': '@lang("messages.Prevention")',
															'1': '@lang("messages.Allow")'
															 }							
														 },
												UpdateData:{
													title: ' @lang("messages.UpdateData")',
													defaultValue:'0',
													type: 'radiobutton',
													options: { 
															'0': '@lang("messages.Prevention")',
															'1': '@lang("messages.Allow")'
															 }									
													     },
												DeleteData: {
													title: ' @lang("messages.DeleteData")',
													defaultValue:'0',
													type: 'radiobutton',
                    								options: { 
															'0': '@lang("messages.Prevention")',
															'1': '@lang("messages.Allow")'
															 }	
														},
												DataToExcel: {
													title: ' @lang("messages.DataToExcel")',
													defaultValue:'0',
													type: 'radiobutton',
                    								options: { 
															'0': '@lang("messages.Prevention")',
															'1': '@lang("messages.Allow")'
															 }	
														},
												DataToPrint: {
													title: ' @lang("messages.DataToPrint")',
													defaultValue:'0',
													type: 'radiobutton',
                    								options: { 
															'0': '@lang("messages.Prevention")',
															'1': '@lang("messages.Allow")'
															 }	
														}
											
												}   ,
												//Initialize validation logic when a form is created
												formCreated: function (event, data) {
													//readonly 
													data.form.find("select[name='ViewName']").addClass("readonly");
													data.form.validationEngine('attach'+promptPosition);
												//  data.form.validationEngine();
												},
												//Validate form when it is being submitted
												formSubmitting: function (event, data) { 
													return data.form.validationEngine('validate');
													
												},
												//Dispose validation logic when form is closed
												formClosed: function (event, data) {
													data.form.validationEngine('hide');
													data.form.validationEngine('detach');
												}
												,rowUpdated: function (event, data){
													window.location.reload();
												} 

										   }, function (data) { //opened handler
												data.childTable.jtable('load');
											});
								});
								//Return image to show on the person row
								return $img;
							}
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

                RName: {
                    title: '@lang("messages.Roles")',
					inputClass:"form-control validate[required]"
					
				},
				
            }
            @include('layouts.inc.JtableEvent')
        });
 
        //Load student list from server
        $('#jtableContainer').jtable('load');
 
    });
 


</script>


@endsection
