@extends('template.master')


@section('title')
ELTDP - Register
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


                {{ Form::open(array('route' => 'users.store')) }}
                    
                    <h1>Register</h1>

                    <div>
                        <input type="text" placeholder="Username" required="" id="username" name="name" />
                    </div>
                    <div>
                        <input type="text" placeholder="Email" required="" id="email" name="email" />
                    </div>
                    <div>
                        <input type="password" placeholder="Password" required="" id="password" name="password"/>
                    </div>
                    <div>
                        <input type="submit" value="Register" />
                        {{ HTML::link('/', 'Cancel') }}
                    </div>
                {{ Form::close() }}
                
            </section><!-- content -->

        </div>
    </div>
  
</div><!-- container -->


@stop