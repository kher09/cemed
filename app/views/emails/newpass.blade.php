<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <style>
			@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro);
			h1{
				font-family: 'Source Sans Pro', sans-serif;
			}
			h3{
				margin: 1px 0px;
			}
			a{
				text-decoration: none;
			}
			a:hover{
				text-decoration: none;
			}

      </style>
   </head>
   <body>
   	  <img src="http://www.lavozdelsandinismo.com/wp-estaticos/2011/11/13/minsa.jpg">
      <h1>Contraseña actualizada</h1>
      <p>Sus datos han sido actualizados correctamente. Sus nuevos datos son:</p>
       <h4>UserName: {{$username}}</h4>
       <h4>Contraseña: {{$pass}}</h4>
		<h3>Para iniciar sesion, usted tiene que ingresar a: <a href="{{URL::to('login')}}">{{URL::to('login')}}</a></h3>
   </body>
</html>
