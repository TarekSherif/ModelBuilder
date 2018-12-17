
@include('layouts.inc.header')
    @include('layouts.inc.nav')




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="PageTitle">
                @lang("messages.$view_name") 
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('layouts.inc.meassage')

        @yield('CoreContent')
        
        @if($jtable)
            <div class="white-Background">
                    <div id="jtableContainer" class="@lang("messages.Clang")"></div>
            </div>
        @endif
    </section>
</div>
    @include('layouts.inc.footer') @yield('ScriptContent')




</body>

</html>