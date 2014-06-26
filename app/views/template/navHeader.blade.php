<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ELTDP</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
         <li {{ (Request::is('/') ? 'class="active"' : '') }}>{{ HTML::link('/', ' Home', '', '', '<span class="glyphicon glyphicon-home"></span>') }}</li>
        <li {{ (Request::is('resources/*') ? 'class="active"' : '') }}>{{ link_to_route('resources.create', 'New Resource') }} </li>
        <li {{ (Request::is('resources') ? 'class="active"' : '') }}>{{ link_to_route('resources.index', 'Browse Resources') }} </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::user())
                  <li {{ (Request::is('users/*') ? 'class="active"' : '') }}>{{ link_to_route('users.show', ucwords(Auth::user()->name), Auth::user()->id ) }}</li>
                  <li>{{ HTML::link('logout', 'Logout') }}</li>
                @else


                         
                 <li {{ (Request::is('login') ? 'class="active"' : '') }}>{{ HTML::link('login', 'Login') }}</li>
                 <li {{ (Request::is('register') ? 'class="active"' : '') }}>{{ HTML::link('register', 'Register') }}</li>
                @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>