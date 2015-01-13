<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Poweradmin 3</title>

        <!-- Bootstrap core CSS -->
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/bootstrap-admin.css') }}
        @yield('css')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
        <![endif]-->
    </head>
    <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Poweradmin 3</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Helpers\View::activeLaravelLink('DashboardController@*') }}"><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
                    <li class="dropdown{{ Helpers\View::activeLaravelLink('ZonesController@*') }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Zones <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::to('/zones/add-master') }}">Add master zone</a></li>
                            <li><a href="{{ URL::to('/zones/add-slave') }}">Add slave zone</a></li>
                            <li><a href="{{ URL::to('/zones/templates') }}">Zone templates</a></li>
                        </ul>
                    </li>
                    <li class="dropdown{{ Helpers\View::activeLaravelLink('SupermasterController@*') }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Supermaster <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::to('/supermaster') }}">List supermasters</a></li>
                            <li><a href="{{ URL::to('/supermaster/add') }}">Add supermasters</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Entrust::can('user_edit_others'))
                    <li class="{{ Helpers\View::activeLaravelLink('UsersController@*') }}"><a href="{{ URL::to('/users') }}">User administration</a></li>
                    @endif
                    <li class="{{ Helpers\View::activeLaravelLink('UserController@*') }}"><a href="{{ URL::to('/user') }}">{{ Auth::user()->username }}</a></li>
                    <li><a href="{{ URL::to('/logout') }}">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable" style="margin-top:20px;">
            <i class="fa fa-check"></i>
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <b>Success!</b> {{ Helpers\View::sessionString('success') }}
        </div>
        @endif
        @if(Session::has('errors'))
        <div class="alert alert-danger alert-dismissable" style="margin-top:20px;">
            <i class="fa fa-check"></i>
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <b>Error!</b> {{ Helpers\View::sessionString('errors') }}
        </div>
        @endif
        @yield('content')
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    {{ HTML::script('/js/general.js') }}
    @yield('js')
    </body>
</html>
