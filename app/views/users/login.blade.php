@extends('template.master')


@section('title')
ELTDP - Login
@stop

@section('main')

<div class="container">
    
    <div class="containerForm">

        <div class="row">

            <section id="content">

                @if ($errors->any())
                        <ul>
                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                        </ul>
                @endif


                {{ Form::open(array('url' => 'login')) }}
                    
                    <h1>Login Form</h1>

                    <div>
                        <input type="text" placeholder="Email" required="" id="email" name="email" />
                    </div>
                    <div>
                        <input type="password" placeholder="Password" required="" id="password" name="password"/>
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