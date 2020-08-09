<div class="navbar-custom-menu">


  <ul class="nav navbar-nav">
    <!-- Messages: style can be found in dropdown.less-->

    <li class="dropdown messages-menu">

      <!-- search form -->
      <form action="#" method="get" class="navbar-form">
        <div class="input-group">
          <input type="text" class="form-control  " id="top-search" placeholder="@lang('messages.Search')...">
          <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
        </div>

      </form>
      <!-- /.search form -->
    </li>
  </ul>
  <ul class="nav navbar-nav">
    <!-- Messages: style can be found in dropdown.less-->

    <li class="dropdown messages-menu">


    </li>

    <li class="dropdown notifications-menu" >
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-tags"></i>
         
      </a>
      <ul class="dropdown-menu">

        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu">
            <li>
              <a class='@lang("messages.CNotlang")' href="#">
                    <i class="fa fa-tags"></i>
                    2.2.0
                  </a>

            </li>
            <!-- Menu Body -->
            <li>
              <a class='@lang("messages.CNotlang")' href="#">
                    <i class="fa fa-tags"></i>
                    2.2.4-tf
                  </a>

            </li>
          </ul>
        </li>

      </ul>

    </li>
    <!-- Tasks: style can be found in dropdown.less -->
    <li class="dropdown tasks-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-flag-o"></i>
         
      </a>
      <ul class="dropdown-menu">

        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu">
            <li>
              <a class="ar" href="{{url("lang/ar ")}}">
                    <i class="fa fa-flag-o"></i>
                    عربي
                  </a>

            </li>
            <!-- Menu Body -->
            <li>
              <a class="en" href="{{url("lang/en ")}}">
                    <i class="fa fa-flag-o"></i>
                    english
                  </a>

            </li>
          </ul>
        </li>

      </ul>
    </li>
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{url('/')}}/Template/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
          <span class="hidden-xs">{{Auth::user()->name}}</span>
        </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img src="{{url('/')}}/Template/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

          <p>
            {{Auth::user()->name}}
            <small>{{Auth::user()->email}}</small>
          </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
          <div class="row">
            <div class="col-xs-4 text-center">
              <a href="#"></a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#" id="LblLogoBID">
              
              </a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#"></a>
            </div>
          </div>
          <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-left">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
          </div>
          <div class="pull-right">

            <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
             

          <i class="gi gi-exit pull-right"></i>                                          
             
          {{ __('Logout') }}  

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
              
              </a>
          </div>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
    </li>
  </ul>
</div>



