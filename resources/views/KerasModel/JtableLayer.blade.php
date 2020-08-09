
<script type="text/javascript">


	$(function () {

		
		$('#btnDelete').on('click',   function(){
            var result = confirm("Want to delete Model ?");
            if (result) {
                //Logic to delete the item
                window.location.href = "{{url("/")}}";
            }

        });



		$(".grid-view").click(function () {
			$(".grid-view").removeClass("active");
			$(this).addClass("active ");
			$(".jtable-grid-view").hide(); 
			$($(this).attr('id').replace("btn_", "#")).show();
			 
		});
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
		LoadDSModels(ModelID);
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
					listAction:   '{{url("/")}}/api/ListOfLayers?ModelID='+ModelID+'&_token={{ csrf_token() }}',
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
			HelpUrl: {
				list:false,
				create:false,
				edit:false
			},
			Parameters: {
                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (LayerData) {
                        //Create an image that will be used to open child table
                        var $img = $('<i class="fa fa-angle-down" style="font-size: 16px;"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:   ' Layer Parameters',
                                        actions: {
											listAction:   '{{url("/")}}/api/ListOfChangedLayerParameters/'+LayerData.record.LayerID+'?_token={{ csrf_token() }}',
                                        },
                                        fields: {
                                         
                                            PID: {
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false
                                            },
                                            PName: {
                                                title: 'PName',
                                                width: '30%',
                                            },
                                            PValue: {
                                                title: 'PValue',
                                                width: '30%'
                                            },
                                           
                                        }
                                    }, function (data) { //opened handler
                                        data.childTable.jtable('load');
                                    });
                        });
                        //Return image to show on the person row
                        return $img;
                    }
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
			$('#jtableContainer').jtable('reload');
			 
		} ,   selectionChanged: function () {
                //Get all selected rows

					ShowLayerProperty();
               
            },
	
				
					
			});
	 
	//Load Layers list from server
	$('#jtableContainer').jtable('load');

		}

function LoadDSModels(ModelID) {
		$('#DSContainer').jtable({
			title: '<i class="fa fa-database  " style="color: orange;" aria-hidden="true"></i>  @lang("messages.DS")',
			columnResizable: true,
			saveUserPreferences: true,
			actions: {
				listAction:   '{{url("/")}}/api/ListOfDSModels?ModelID='+ModelID+'&_token={{ csrf_token() }}',
				createAction: '{{url("/")}}/api/CreateDSModel?_token={{ csrf_token() }}',
				updateAction: '{{url("/")}}/api/UpdateDSModel?_token={{ csrf_token() }}',
				deleteAction: '{{url("/")}}/api/DeleteDSModel?_token={{ csrf_token() }}'
					
			},
			@include('layouts.inc.JtableToolbar'),
	
			fields: {
				DSModelID: {
					key: true,
					list:false
				},
				DSID: {
					title: 'DS',
					options: '{{url("/")}}/api/DSListoptions?_token={{ csrf_token() }}'
				},
				ModelID: {
					type:"hidden",
					defaultValue:ModelID,
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

		//Load DataSets list from server
		$('#DSContainer').jtable('load');
		
}


	
	
	
	// 	$('#optimizer').autocomplete({
    //        source: '{{url("/")}}/api/ListOfACType/Optimizer?_token={{ csrf_token() }}',
	//    });
	   
	//    $('#loss').autocomplete({
    //        source: '{{url("/")}}/api/ListOfACType/Loss?_token={{ csrf_token() }}',
	//    });
	   
	// 	$('#metrics').autocomplete({
    //        source: '{{url("/")}}/api/ListOfACType/metrics?_token={{ csrf_token() }}',
	//    });
		// 		.attr('multiple','multiple')
		// 		.multiselect({
		// 			placeholder: '@lang("messages.Serves")',
		// 			search: true,
					
		// });


		var Pval="",LCategory="", LayerID=0,ModelID={{$KerasModel->ModelID ?? '-1'}};

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
			var ObjectID="";
			var $selectedRows = $('#jtableContainer').jtable('selectedRows');
			var $SelectedLayer= $('#SelectedLayer')
			$SelectedLayer.empty();
			//ObjectID= LayerID,ModelID
			// $OType=Model,LayerType

                if ($selectedRows.length > 0) {
                    //Show selected rows
                    $selectedRows.each(function () {

                        var record = $(this).data('record');
						LayerID=record.LayerID;
						ObjectID=LayerID;
						LCategory=record.LCategory;
						 
						$SelectedLayer.append(
					`    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
							<li class="active">
								<a href="${record.HelpUrl}" target="_blank">
									<i class="fa fa-question-circle"></i>
								</a>
							</li>
						</ul>`);
                    });
                } else {
                    //No rows selected
					
					// $SelectedLayer.append('No SelectedLayer selected! Select SelectedLayer to see here...');
					 
					ObjectID=ModelID;
					LCategory="Model";
					 
					$SelectedLayer.append(
					`    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
							<li class="active">
								<a href="#"  >
									<i class="fa fa-gears"></i>
								</a>
							</li>
						</ul>`);
                }

				url='{{url("/")}}/api/GetLayerParameters/'+ ObjectID+ '/' + LCategory;
					
					$.get(url,null,function (data) {
					if(data){
						var inputType="",$isChecked="";
						
						data.forEach(function(element) {
						// inputType=(element.PType=='number')?:;
						 
						 
							$isChecked=(element.PValue.toLowerCase()=="true")?"checked":""
					 
							$PName=element.PName;
							
							$SelectedLayer.append(
							` <div class="col-xs-12">
								<div class="form-group ">
										<label for='${element.PName}' class="  col-form-label text-md-right">${element.PName}</label>
										<input id='${element.PName}' type='${element.PType}' name='${element.PName}' class="auto-save" ${$isChecked} value='${element.PValue}'>
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
				
								
		}
		$(document).on('click',":checkbox.auto-save",function() {
			var ObjectID="",ObjectType="", $selectedRows = $('#jtableContainer').jtable('selectedRows');
				//ObjectID= LayerID,ModelID
				if ($selectedRows.length > 0) {
                    //Show selected rows
                    ObjectID=LayerID;
                } else {
                    //No rows selected
					ObjectID=ModelID;
					ObjectType="Model_"
                }
   			var $isChecked=($(this).val().toLowerCase()=="true")?"false":"true";

			url='{{url("/")}}/api/AutoSave/'+ ObjectID+ '/' + ObjectType+$(this).attr("name")+ '/' + $isChecked;
	 
		$(this).val($isChecked)
		 
			$.get(url);
			GenerateScript();

		});
		// input:not([type="checkbox"])
		// $('#isAgeSelected').click(function() {
		// 	$("#txtAge").toggle(this.checked);
		// });
		$(document).on('focus',  'input:not(:checkbox).auto-save', function() {
			Pval=$(this).val();
		});

		$(document).on('blur', 'input:not(:checkbox).auto-save', function() {
	 
		if(Pval != $(this).val()){
			var $selectedRows = $('#jtableContainer').jtable('selectedRows');
			var ObjectID="",ObjectType="";

		 	//ObjectID= LayerID,ModelID
			 if ($selectedRows.length > 0) {
                    //Show selected rows
                    ObjectID=LayerID;
                } else {
                    //No rows selected
					ObjectID=ModelID;
					ObjectType="Model_"
                }


			url='{{url("/")}}/api/AutoSave/'+ ObjectID+ '/' + ObjectType+$(this).attr("name")+ '/' + $(this).val();
			$.get(url);
			GenerateScript();
			}
		});



 

</script>


