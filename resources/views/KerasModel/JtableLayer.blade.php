
<script type="text/javascript">
	$(function () {
		
		$('#collapseLayers').collapse({
					toggle:false
		});

		$("[data-toggle=popover]").popover({
		html : true,
		content: function() {
			var content = $(this).attr("data-popover-content");
			return  $(".popover-body").detach().appendTo(content);
		},
		title: function() {
			var title = $(this).attr("data-popover-content");
			return  $(title).children(".popover-heading").html();
		}
		
		}).on('hide.bs.popover', function () {
 			// $(content).children(".popover-body").html();
			$(".popover-body").detach().appendTo("#delivery");
		});
		
		$('#frmKerasModel').trigger("reset");

		 
		$('#btnPrint').click(function() {
		 
			alert($("#ModelID").val());
			
		});

 var ModelID= $("#ModelID").val();
	if(ModelID)
	{
		$('#collapseLayers').collapse('show');
		LoadModelLayer(ModelID);
	}
	
		// $('#btnSave').click(function() {
		// alert("");
			
		// 	var Action="{{route('KerasModel.store') }}";
		// 	var formdata=$("#frmKerasModel").serialize();
				
		// 	$.post(Action,formdata,function(data) {
		// 		
		// 		// LoadModelLayer(data.Record.ModelID);
		// 		// $("#ModelID").val(data.Record.ModelID);
		// 		// LoadOrder(data.Record) ;
		// 	});	
			
		// });
	
		
		});
 

function LoadModelLayer(ModelID) {
	$('#jtableContainer').jtable({
				title: '<i class="fa fa-ellipsis-v  " style="color: orange;" aria-hidden="true"></i>  @lang("messages.Layers")',
                selecting: true, //Enable selecting
                multiselect: false, //Allow multiple selecting
                selectingCheckboxes: true, //Show checkboxes on first column
				columnResizable: true,
				columnSelectable: true,
				saveUserPreferences: true,
				//openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
				actions: {
					listAction:   '{{url("/")}}/api/ListOfLayers?_token={{ csrf_token() }}&ModelID={{$KerasModel->ModelID}}',
					createAction: '{{url("/")}}/api/CreateLayer?_token={{ csrf_token() }}',
					updateAction: '{{url("/")}}/api/UpdateLayer?_token={{ csrf_token() }}',
					deleteAction: '{{url("/")}}/api/DeleteLayer?_token={{ csrf_token() }}'
											
				}
				,
	@include('layouts.inc.JtableToolbar'),
 
		fields: {
			ModelID: {
				type:"hidden",
				defaultValue:ModelID,
				
			},
			LayerID: {
				key: true,
				list:false
			},
			LCategory: {
						title:'@lang("messages.LCategory")',
						visibility: 'visible',
						width: '10%',
					input: function (data) {
							if (data.record) {
								return '<input type="text"  placeholder=" @lang("messages.LCategory")"   class=" form-control validate[required]"   autocomplete="off"   name="LCategory"   value="' + data.record.LCategory + '" />';
							} else {
								return '<input type="text"  placeholder=" @lang("messages.LCategory")"     class="form-control validate[required]"  autocomplete="off"   name="LCategory"     />';
							}
						}  
				},
				LName: {
						title:'@lang("messages.LName")',
						visibility: 'visible',
						width: '10%',
					input: function (data) {
							if (data.record) {
								return '<input type="text"  placeholder=" @lang("messages.LName")"   class=" form-control validate[required]"   autocomplete="off"   name="LName"   value="' + data.record.LName + '" />';
							} else {
								return '<input type="text"  placeholder=" @lang("messages.LName")"     class="form-control validate[required]"  autocomplete="off"   name="LName"     />';
							}
						}  
				},
			trainable: {
				title: ' @lang("messages.trainable")',
				type: 'radiobutton',

				options: { 
							0: '@lang("messages.nottrainable")',
							1: '@lang("messages.trainable")' 
							}		
							
													
			},
			upColumn: {
			
				create: false,
				edit :false,
				width:'2%',
				display: function(LayerData) {
					var $link = $('<button  class="jtable-command-button fa fa-arrow-circle-up"  ></button>');
					$link.click(function(){
						url='{{url("/")}}/api/UpdateSOrderUp/MLayer/LayerID/ModelID/' + LayerData.record.LayerID + '/' + LayerData.record.ModelID + '/' + LayerData.record.SOrder;
						$.get(url,null,function (data) {
							if(data.refresh){
                                $('#jtableContainer').jtable('load');
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
						url='{{url("/")}}/api/UpdateSOrderDown/MLayer/LayerID/ModelID/' + LayerData.record.LayerID + '/' + LayerData.record.ModelID + '/' + LayerData.record.SOrder;
						$.get(url,null,function (data) {
							if(data.refresh){
                                $('#jtableContainer').jtable('load');
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
			
			data.form.find('input[name=LCategory]').autocomplete({
				source: '{{url("/")}}/api/ListOfACLayerType?_token={{ csrf_token() }}',
	       }).data("autocomplete")._renderItem = function (ul, item) {
                  return $( "<li></li>" )
                      .append(
                        `<a>
                          <div class="row" > 
                            <div class="col-xs-6"> 
                                  <strong> <i class="fa fa-address-card-o"></i>:</strong>`+item.label+`
                              </div>
                              <div class="col-xs-6"> 
                                    <strong><i class="fa fa-address-card-o"></i> :</strong>`+item.KLType+`
                              </div>
                            </div>
                          </a>
                              ` )
                      .appendTo( ul );
                  };
       
   
       
   

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
			
			 
		} ,   selectionChanged: function () {
                //Get all selected rows

					ShowLayerProperty();
               
            },
	
				
					
			});
	 
			//Load student list from server
			$('#jtableContainer').jtable('load');

		$('#optimizer').autocomplete({
           source: '{{url("/")}}/api/ListOfACType/Optimizer?_token={{ csrf_token() }}',
	   });
	   
	   $('#loss').autocomplete({
           source: '{{url("/")}}/api/ListOfACType/Loss?_token={{ csrf_token() }}',
	   });
	   
		$('#metrics').autocomplete({
           source: '{{url("/")}}/api/ListOfACType/metrics?_token={{ csrf_token() }}',
	   });
		// 		.attr('multiple','multiple')
		// 		.multiselect({
		// 			placeholder: '@lang("messages.Serves")',
		// 			search: true,
					
		// });


		var Pval="",LCategory="", LayerID=0,ModelID={{$KerasModel->ModelID}};

		// $("#btnfork").click(function(){
		// 	url='{{url("/")}}/api/GenerateScript/'+ModelID;
		// 				$.get(url,null,function (data) {
		// 					var $jupyterBady= $('#jupyterBady')
		// 		            $jupyterBady.empty();
		// 				    $jupyterBady.append(data);
		// 				});
		// });
		$("#btnjupyterScript").click(function(){
			GenerateScript();
		});
		
		$("[data-toggle='control-sidebar']").click(function(){
			ShowLayerProperty() 	
		});
		function GenerateScript() {
			url='{{url("/")}}/api/GenerateScript/'+ModelID;
						$.get(url,null,function (data) {
							var $jupyterBady= $('#jupyterBady')
				            $jupyterBady.empty();
							$jupyterBady.append(data);
						});
		}



		function ShowLayerProperty() {


			 var $selectedRows = $('#jtableContainer').jtable('selectedRows');
			var $SelectedLayer= $('#SelectedLayer')
			$SelectedLayer.empty();
               
                if ($selectedRows.length > 0) {
                    //Show selected rows
                    $selectedRows.each(function () {

                        var record = $(this).data('record');
						LayerID=record.LayerID;
						LCategory=record.LCategory;
						
					

			url='{{url("/")}}/api/GetLayerParameters/'+ LayerID+ '/' + LCategory;
							
							$.get(url,null,function (data) {
							if(data){
								var inputType="";
								
								data.forEach(function(element) {
								// inputType=(element.PType=='number')?:;
									$PName=element.PName;
							
									$SelectedLayer.append(
									` <div class="col-xs-12">
										<div class="form-group ">
												<label for='`+element.PName+`' class="  col-form-label text-md-right">`+element.PName+`</label>
												<input id='`+element.PName+`' type="`+element.PType+`" name='`+element.PName+`' class="auto-save" value="`+element.PValue+`">
										</div>
									</div>`);

									if (! ['number', 'text', 'checkbox'].includes(element.PType) ){
										$SelectedLayer.append(
											`<script>
													$('#`+element.PName+`').autocomplete({
														source: '{{url("/")}}/api/ListOfACType/`+element.PType+`?_token={{ csrf_token() }}',
													});
												<\/script>`);
									}
								
								});
							}
						});
						


                    });
                } else {
                    //No rows selected
					
                   $SelectedLayer.append('No SelectedLayer selected! Select SelectedLayer to see here...');
                }
								
		}
		$(document).on('focus', '.auto-save', function() {
			Pval=$(this).val();
		});

		$(document).on('blur', '.auto-save', function() {
		if(Pval != $(this).val()){
			url='{{url("/")}}/api/AutoSave/'+ LayerID+ '/' + $(this).attr("name")+ '/' + $(this).val();
			$.get(url);
			GenerateScript();
			}
		});




 
}

</script>


