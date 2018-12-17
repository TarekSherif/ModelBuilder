<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"> @lang('messages.MName')</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"> @lang('messages.MName')</span>
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
            {{-- <li class="header">MAIN NAVIGATION</li>
            <li class="">
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" class="form-control"  placeholder="@lang(" messages.Search ")...">
                        <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                </form>
                <!-- /.search form -->



            </li> --}}
      
            <li class="{{ $view_name == "create" ? "active" : "" }} ">
                <a href="{{url('/')}}/KerasModel/create" >
                        <i class="fa fa-plus sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">
                                @lang('messages.KerasModel.create')
                        </span>
                    </a>
            </li>
 
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>