<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2020 <a href="mailto:Eng.Tarek.Sherif@gmail.com">Tarek Sherif</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->

<aside class="control-sidebar control-sidebar-dark" style="
    height: 90%;
    overflow: scroll;
    
    overflow-x: hidden;
" >
    <!-- Create the tabs -->

    <!-- Tab panes -->
    <div class="tab-content">

        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane active" id="control-sidebar-settings-tab">
                <div id="SelectedLayer">                    
                </div>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<!-- <div class="control-sidebar-bg"></div>
</div> -->



<!-- jQuery 3 -->
<script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('js/jquery-ui-1.9.2.min.js')}}" type="text/javascript"></script>


<script src="{{url('/')}}/Template/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/Template/AdminLTE/dist/js/adminlte.js"></script>
@if($jtable)
<script src="{{asset('js/validationEngine/jquery.validationEngine-en.js')}}"></script>
<script src="{{asset('js/validationEngine/jquery.validationEngine.js')}}"></script>
<script src="{{asset('js/datepicker-ar.js')}}"></script>
<script src="{{asset('js/MultiSelect/jquery.multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.table2excel.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jtable/jquery.jtable.js')}}"></script>
@if(session("lang")=="ar")
<script type="text/javascript" src="{{asset('js/jtable/localization/jquery.jtable.AR.js')}}"></script>
@endif

<script>
    var promptPosition="";
              @if (session("lang")=="ar" )
                  promptPosition=',{promptPosition: "topLeft"}' ;
              @endif

</script>
@endif

<script type="text/javascript">
 

    $(function () {
        function sidebarSearch(term="") {
            $.get( "{{url("/")}}/api/ListOfACModel?term="+term+"&UID={{Auth::user()->id}}&_token={{ csrf_token() }}", function( data ) {
                $('#model-list').empty();
                data.forEach(function(element, i) { 

                    $('#model-list').append(`
                        <li >
                            <a href="{{url('/')}}/KerasModel/${element.ModelID}/edit" >
                                    <i class="fa fa-pencil-square-o  sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">
                                        ${element.label}
                                    </span>
                                </a>
                             
                        </li>`);
                
                });
            });
            $.get( "{{url("/")}}/api/ListOfACDS?term="+term+"&UID={{Auth::user()->id}}&_token={{ csrf_token() }}&_token={{ csrf_token() }}", function( data ) {
                $('#ds-list').empty();
                data.forEach(function(element, i) { 
               
                    $('#ds-list').append(`
                        <li >
                            <a href="{{url('/')}}/DS/${element.DSID}/edit" >
                                    <i class="fa fa-database  sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">
                                        ${element.label}
                                    </span>
                                </a>
                             
                        </li>`);
                
                });
            });
       }
       
      
      $('#top-search').autocomplete({
           source: '{{url("/")}}/api/ListOfACModel?_token={{ csrf_token() }}',
           select: function (e, ui) {
              window.open( "{{url("/")}}/KerasModel/"+ui.item.ModelID+"/edit", '_self');
             
           }
       });
       
       $('#sidebar-search').on('keyup',   function(){
             sidebarSearch( $(this).val());
        });

      
       sidebarSearch(); 
   

      
  
      $('[data-toggle="push-menu"]').on('click', function (e) {
          e.preventDefault();
         
          if ($("body").hasClass('sidebar-collapse')) {
              $(".content,.content-header>h1,.main-header>.navbar").removeClass('margin-50');
          } else {
              $(".content,.content-header>h1,.main-header>.navbar").addClass('margin-50');
          }
          
 
          });

   
       
   });



</script>