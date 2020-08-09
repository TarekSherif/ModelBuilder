<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"> @lang('messages.MiniName')</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"> @lang('messages.Pname')</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    @include('layouts.inc.menu')

    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('/')}}/Template/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                {{Auth::user()->email}}
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
              
       
            <li class="">
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" class="form-control  " id="sidebar-search"   placeholder="@lang('messages.Search')..." autocomplete="off">

                        <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                </form>
                <!-- /.search form -->
            <li class="header"  title=" @lang('messages.Models')"> 
            @lang('messages.Models')
            <a href="{{url('/')}}/KerasModel/create"  class="pull-right"  title=" @lang('messages.KerasModel.create')" >
                        <i class="fa fa-plus sidebar-nav-icon"  ></i>
                        
                    </a>
            </li>
            
        </ul>
        <ul class="sidebar-menu " id="model-list" data-widget="tree">
            
           
            
        </ul>
        <ul class="sidebar-menu" data-widget="tree">
        <li class="header" >
            @lang('messages.DS')
            <a href="{{url('/')}}/DS/create"  class="pull-right" title=" @lang('messages.DS.create')" >
                        <i class="fa fa-plus sidebar-nav-icon"  ></i>
                        
                    </a>
            </li>
            
        </ul>
        <ul class="sidebar-menu " id="ds-list" data-widget="tree">
            
           
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>