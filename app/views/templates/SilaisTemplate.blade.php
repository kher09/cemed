<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title><?php $usuario = User::find(Auth::user()->id)->UserSilais()->first(); $Silais=Silais::find($usuario->id_silais);?>{{$Silais->nombre}}</title>

    <!-- Bootstrap Core CSS -->   
    {{ HTML::style('css/bootstrap.min.css') }}
    

    <!-- Custom CSS -->
    {{ HTML::style('css/sb-admin-2.css') }}  


    {{ HTML::style('css/admin.css') }}

    {{ HTML::style('font-awesome-4.1.0/css/font-awesome.min.css') }}  

    {{-- HTML::style('css/data/jquery.dataTables.css') --}}

    {{ HTML::style('css/dataTables.bootstrap.css') }}

    {{ HTML::style('css/dataTables.tableTools.css') }}

    {{ HTML::style('css/dataTables.colVis.css') }}
   



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/') }}">{{$Silais->nombre}}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">                                    
                <!-- /.dropdown -->              
                <li class="dropdown nombreusuario">
                    <a href="#" class="navbar-brand">{{$usuario->nombre}}</a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">                        
                        <li><a href="{{ URL::to('usuarios/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href=""><i class="fa fa-hospital-o fa-fw"></i>Unidades<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ URL::to('Silais/Unidades/Show') }}">Ver Unidades</a>
                                </li>
                                 <li>
                                    <a href="{{ URL::to('Silais/Unidades/Add') }}">Agregar</a>
                                </li>
                             </ul>
                        </li>
                         <li>
                            <a href=""><i class="fa fa-stethoscope fa-fw"></i>Equipos<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ URL::to('Silais/Equipos/Show') }}">Ver Todos</a>
                                </li>
                                 <li>
                                    <a href="{{ URL::to('Silais/Equipos/Add') }}">Agregar</a>
                                </li>
                             </ul>
                        </li> 
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
          @yield('contenido')
            
           
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    {{ HTML::script('js/vendor/jquery-1.11.1.min.js') }}        
    {{ HTML::script('js/vendor/bootstrap.min.js') }}
    {{ HTML::script('js/sb-admin-2.js') }}
    {{ HTML::script('js/metisMenu.min.js') }}

    {{ HTML::script('js/js/jquery.dataTables.js') }}
    {{ HTML::script('js/js/dataTables.bootstrap.js') }}
    {{ HTML::script('js/dataTables.tableTools.js') }}
    {{ HTML::script('js/dataTables.colVis.js') }}
    {{ HTML::script('js/silais.js') }}

    @yield('Scripts')
</body>

</html>
