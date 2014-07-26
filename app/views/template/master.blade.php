<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!-- CSS are placed here -->
        {{ HTML::style('css/normalize.css') }}
        {{ HTML::style('css/main.css') }}
        {{ HTML::style('css/style.css') }}
        <!-- Bootstrap -->
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/bootstrap-select.min.css') }}
        <!--ckeditor-->
        {{-- HTML::style('ckeditor/contents.css') --}}

        <!--my css-->
        {{ HTML::style('css/custom.css') }}

    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        @include('template.navHeader')

        <div class="container">

            @if(Session::has('message'))
                <p class="alert alert-info">{{ Session::get('message') }}</p>

            @endif

             @if(Session::has('warning'))
                <p class="alert alert-warning">{{ Session::get('warning') }}</p>

            @endif

            @if(Session::has('errors'))

                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

            @endif

            @yield('main')

        </div>

        @include('template.footer')
        

        <!-- Scripts are placed here -->
        {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
        {{ HTML::script('js/vendor/modernizr-2.6.2.min.js') }}
        {{ HTML::script('js/plugins.js') }}
        {{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js') }}
        {{ HTML::script('js/bootstrap.file-input.js') }}
        {{ HTML::script('js/bootstrap-select.min.js') }}

        <!--ckeditor-->
        {{ HTML::script('ckeditor/ckeditor.js') }}
        {{ HTML::script('ckeditor/config.js') }}

        <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace( 'editor1' );
        </script>

        <!--for reviews-->
        @yield('scripts')

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
