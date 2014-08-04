@extends('template.master')


@section('title')
ELTDP - Login
@stop

@section('main')

<div class="container">
    
    <div class="containerForm">

        <div class="row">

            <section id="content">
            
                {{ Form::open(array('url' => 'login', 'POST')) }}
                    
                    <h1>Login Form</h1>

                    <div>
                        <input type="text" placeholder="Email" id="email" name="email" />
                    </div>
                    <div>
                        <input type="password" placeholder="Password" id="password" name="password"/>
                    </div>
                    <div>
                        <input type="submit" value="Login" />
                        <a href="#">Lost your password?</a>
                        {{ HTML::link('register', 'Register') }}
                    </div>
                {{ Form::close() }}
                
            </section><!-- content -->

        </div>
    </div>
  
</div><!-- container -->

    
@stop