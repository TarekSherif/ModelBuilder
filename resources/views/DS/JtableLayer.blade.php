
<script type="text/javascript">
	$(function () {
		
	
		$('#frmDS').trigger("reset");

		$('#btnDelete').on('click',   function(){
            var result = confirm("Want to delete Data Set ?");
            if (result) {
                //Logic to delete the item
                window.location.href = "{{url("/")}}";
            }

        });

		$('#btnPrint').click(function() {
		 
			alert($("#DSID").val());
			
		});
	 
		var DSID= $("#DSID").val();

		if(DSID)
		{
		
			LoadDSModels(DSID);
		}
	
		 
		
	});
 

function LoadDSModels(DSID) {
	$('#DSContainer').jtable({
				title: '<i class="fa fa-database  " style="color: orange;" aria-hidden="true"></i>  @lang("messages.DS")',
               
				columnResizable: true,
				 
				saveUserPreferences: true,
				//openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
				actions: {
					listAction:   '{{url("/")}}/api/ListOfDSModels?DSID={{$DS->DSID}}&_token={{ csrf_token() }}',
					createAction: '{{url("/")}}/api/CreateDSModel?_token={{ csrf_token() }}',
					updateAction: '{{url("/")}}/api/UpdateDSModel?_token={{ csrf_token() }}',
					deleteAction: '{{url("/")}}/api/DeleteDSModel?_token={{ csrf_token() }}'
 						
				}
				,
	@include('layouts.inc.JtableToolbar'),
  
		fields: {
			DSModelID: {
				key: true,
				list:false
			},
			DSID: {
				type:"hidden",
				defaultValue:DSID,
			},
			ModelID: {
				title: 'ModelID',
				options: '{{url("/")}}/api/ModelListoptions?_token={{ csrf_token() }}'
			},
		
	 
			Train_loss: {
						title:'@lang("messages.Train_loss")',
						visibility: 'visible',
						width: '10%',
					input: function (data) {
							if (data.record) {
								return '<input type="number"  placeholder=" @lang("messages.Train_loss")"   class=" form-control validate[required]"   autocomplete="off"   name="Train_loss"   value="' + data.record.Train_loss + '" />';
							} else {
								return '<input type="number"  placeholder=" @lang("messages.Train_loss")"     class="form-control validate[required]"  autocomplete="off"   name="Train_loss"     />';
							}
						}  
				},
			Train_score: {
					title:'@lang("messages.Train_score")',
					visibility: 'visible',
					width: '10%',
				input: function (data) {
						if (data.record) {
							return '<input type="number"  placeholder=" @lang("messages.Train_score")"   class=" form-control validate[required]"   autocomplete="off"   name="Train_score"   value="' + data.record.Train_score + '" />';
						} else {
							return '<input type="number"  placeholder=" @lang("messages.Train_score")"     class="form-control validate[required]"  autocomplete="off"   name="Train_score"     />';
						}
					}  
			},
			Val_loss: {
					title:'@lang("messages.Val_loss")',
					visibility: 'visible',
					width: '10%',
				input: function (data) {
						if (data.record) {
							return '<input type="number"  placeholder=" @lang("messages.Val_loss")"   class=" form-control validate[required]"   autocomplete="off"   name="Val_loss"   value="' + data.record.Val_loss + '" />';
						} else {
							return '<input type="number"  placeholder=" @lang("messages.Val_loss")"     class="form-control validate[required]"  autocomplete="off"   name="Val_loss"     />';
						}
					}  
			},
			Val_score: {
					title:'@lang("messages.Val_score")',
					visibility: 'visible',
					width: '10%',
				input: function (data) {
						if (data.record) {
							return '<input type="number"  placeholder=" @lang("messages.Val_score")"   class=" form-control validate[required]"   autocomplete="off"   name="Val_score"   value="' + data.record.Val_score + '" />';
						} else {
							return '<input type="number"  placeholder=" @lang("messages.Val_score")"     class="form-control validate[required]"  autocomplete="off"   name="Val_score"     />';
						}
					}  
			},
			Test_loss: {
					title:'@lang("messages.Test_loss")',
					visibility: 'visible',
					width: '10%',
				input: function (data) {
						if (data.record) {
							return '<input type="number"  placeholder=" @lang("messages.Test_loss")"   class=" form-control validate[required]"   autocomplete="off"   name="Test_loss"   value="' + data.record.Test_loss + '" />';
						} else {
							return '<input type="number"  placeholder=" @lang("messages.Test_loss")"     class="form-control validate[required]"  autocomplete="off"   name="Test_loss"     />';
						}
					}  
			},
			Test_score: {
					title:'@lang("messages.Test_score")',
					visibility: 'visible',
					width: '10%',
				input: function (data) {
						if (data.record) {
							return '<input type="number"  placeholder=" @lang("messages.Test_score")"   class=" form-control validate[required]"   autocomplete="off"   name="Test_score"   value="' + data.record.Test_score + '" />';
						} else {
							return '<input type="number"  placeholder=" @lang("messages.Test_score")"     class="form-control validate[required]"  autocomplete="off"   name="Test_score"     />';
						}
					}  
			},
			upColumn: {
			
				create: false,
				edit :false,
				width:'2%',
				display: function(LayerData) {
					var $link = $('<button  class="jtable-command-button fa fa-arrow-circle-up"  ></button>');
					$link.click(function(){
						url='{{url("/")}}/api/UpdateSOrderUp/DSModels/DSModelID/DSID/' + LayerData.record.DSModelID + '/' + LayerData.record.DSID + '/' + LayerData.record.SOrder;
						$.get(url,null,function (data) {
							if(data.refresh){
                                $('#DSContainer').jtable('load');
							}
						});
						
						
																					//  $link.closest('tr').find('.jtable-child-table-container').jtable('reload');
					});
					return $link;
				}
				},
				DownColumn: {
			
				create: false,
				edit :false,
				width:'2%',
				display: function(LayerData) {
					var $link = $('<button  class="jtable-command-button fa fa-arrow-circle-down"  ></button>');
					$link.click(function(){
						url='{{url("/")}}/api/UpdateSOrderDown/DSModels/DSModelID/DSID/' + LayerData.record.DSModelID + '/' + LayerData.record.DSID + '/' + LayerData.record.SOrder;
						$.get(url,null,function (data) {
							if(data.refresh){
                                $('#DSContainer').jtable('load');
							}
						});
						
						
																					//  $link.closest('tr').find('.jtable-child-table-container').jtable('reload');
					});
					return $link;
				}
			}
		
			},
		//Initialize validation logic when a form is created
		formCreated: function (event, data) {

			data.form.validationEngine('attach'+promptPosition);
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
	
				
					
			});
	 
			//Load student list from server
			$('#DSContainer').jtable('load');

 
}

</script>


