<!DOCTYPE html>


<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->




    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>

    <link href="{{asset('css/themes/metroblue/jquery-ui.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('js/jquery-ui-1.9.2.min.js')}}" type="text/javascript"></script>


    <link href="{{asset('js/jtable/themes/metro/purple/jtable.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{asset('js/jtable/jquery.jtable.js')}}"></script>
    @if(session("lang")=="ar")
    <script type="text/javascript" src="{{asset('js/jtable/localization/jquery.jtable.AR.js')}}"></script>
    @endif


    <link href="{{asset('js/validationEngine/validationEngine.jquery.css')}}" rel="stylesheet" />
    <script src="{{asset('js/validationEngine/jquery.validationEngine-en.js')}}"></script>
    <script src="{{asset('js/validationEngine/jquery.validationEngine.js')}}"></script>


    <script src="{{asset('js/datepicker-ar.js')}}"></script>


    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <link href="{{asset('css/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <script src="{{asset('css/bootstrap/js/bootstrap.min.js')}}"></script>



    <link href="{{asset('js/MultiSelect/jquery.multiselect.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('js/MultiSelect/jquery.multiselect.js')}}" type="text/javascript"></script>



    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/main.css')}}" rel="stylesheet" />




    <script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('js/jquery.table2excel.js')}}"></script>




    {{--
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}">

    </script>
    --}}



</head>

<body>

    @yield('content')
    <div class="white-Background">
        <div id="jtableContainer" class="@lang("messages.Clang")"></div>
    </div>
<script>
    var promptPosition="";
    @if (session("lang")=="ar" )
        promptPosition=',{promptPosition: "topLeft"}' ;
    @endif
    
</script>


</body>

</html>