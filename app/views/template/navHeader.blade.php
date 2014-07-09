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
         <li {{ (Request::is('/') ? 'class="active"' : '') }}>{{ HTML::link('/', ' Home', '', '', '') }}</li>
        <li {{ (Request::is('resources/*') ? 'class="active"' : '') }}>{{ link_to_route('resources.create', 'New Resource') }} </li>
        <li {{ (Request::is('resources') ? 'class="active"' : '') }}>{{ link_to_route('resources.index', 'Browse Resources') }} </li>
       
        <li>


          {{ Form::open(array('route' => 'search', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search')) }}
              <div class="form-group">
                {{ Form::input('search', 'q', null, array('class' => 'custom_box form_control', 'placeholder' => 'Search...')) }}
              </div>
          {{ Form::close() }}

        </li>


      </ul>
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