
@extends('layouts.index')

@section('ScriptContent')
    @if ($Permission["ShowData"])       
               
<script type="text/javascript">
$(function () {

        $('#jtableContainer').jtable({
            title: '<i class="fa fa-group  " style="color: orange;" aria-hidden="true"></i> @lang("messages.users")',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'id DESC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
            actions: {
                listAction:   '{{url("/")}}/api/ListOfusers?_token={{ csrf_token() }}',
                @if ($Permission["InsertData"])
                createAction: '{{url("/")}}/api/Createuser?_token={{ csrf_token() }}',
                @endif
                @if ($Permission["UpdateData"])
                updateAction: '{{url("/")}}/api/Updateuser?_token={{ csrf_token() }}',
                @endif
                @if ($Permission["DeleteData"])
                deleteAction: '{{url("/")}}/api/Deleteuser?_token={{ csrf_token() }}'
                @endif
            }
            ,@include('layouts.inc.JtableToolbar'),
          
            
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '@lang("messages.name")',
                    width: '40%',
					inputClass:"form-control validate[required]"
                },
                email : {
                    title: '@lang("messages.email")',
					visibility: 'visible',
                    
					input: function (data) {
							if (data.record) {
								return '<input type="email"  placeholder=" @lang("messages.email")"   class=" form-control validate[required]"   autocomplete="off"   name="email"   value="' + data.record.email + '" />';
							} else {
								return '<input type="email"  placeholder=" @lang("messages.email")"     class="form-control validate[required]"  autocomplete="off"   name="email"     />';
							}
						} 
                },
                password: {
                    title: '@lang("messages.password")',
					 list: false,
                     edit:false,
					input: function (data) {
							if (data.record) {
								return '<input type="password"  placeholder=" @lang("messages.password")"   class=" form-control validate[required]"   autocomplete="off"   name="password"   value="' + data.record.password + '" />';
							} else {
								return '<input type="password"  placeholder=" @lang("messages.password")"     class="form-control validate[required]"  autocomplete="off"   name="password"     />';
							}
						} 
                },
               
                role: {
                    title: '@lang("messages.Roles")',
					visibility: 'visible',
                    inputClass:" form-control validate[required]",
                    options: '{{url("/")}}/api/RoleListoptions?_token={{ csrf_token() }}'
                },
             

            } 
            @include('layouts.inc.JtableEvent')
           

        });
 
        //Load student list from server
        $('#jtableContainer').jtable('load');
        // $('#jtableContainer').jtable('load', { '_token': '{{ csrf_token() }}' }); 
    });

</script>
@endif
@endsection


