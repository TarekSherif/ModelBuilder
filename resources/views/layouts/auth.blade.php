<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">

    <title>@lang('messages.Pname') | Login</title>

    <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{url('/')}}/images/favicon.png">
    <link rel="apple-touch-icon" href="{{url('/')}}/images/icon57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="{{url('/')}}/images/icon72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="{{url('/')}}/images/icon76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="{{url('/')}}/images/icon114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="{{url('/')}}/images/icon120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="{{url('/')}}/images/icon144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="{{url('/')}}/images/icon152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="{{url('/')}}/images/icon180.png" sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="{{url('/')}}/OldTemplate/css/bootstrap.min.css">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="{{url('/')}}/OldTemplate/css/plugins.css">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="{{url('/')}}/OldTemplate/css/main.css">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="{{url('/')}}/OldTemplate/css/themes.css">
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <script src="{{url('/')}}/OldTemplate/js/vendor/modernizr.min.js"></script>
</head>

<body>

    @yield('CoreContent')


    <script src="{{url('/')}}/OldTemplate/js/vendor/jquery.min.js"></script>
    <script src="{{url('/')}}/OldTemplate/js/vendor/bootstrap.min.js"></script>
    <script src="{{url('/')}}/OldTemplate/js/plugins.js"></script>
    <script src="{{url('/')}}/OldTemplate/js/app.js"></script>

    @yield('ScriptContent')

  
</body>

</html>