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
      <h1>Estimado {{$nombre}}</h1>
      <p>Este correo fue generado automaticamente, para informarle que su registro en el Sistema del CEMED - MINSA,
       ha sido exitoso.</p>
       <p>Para poder iniciar sesion por primera vez, usted necesita crear su propia contraseña, para esto podra hacerlo desde el
       siguiente enlace: <a href="{{ URL::to('Usuario/First').'/'.$codigo.'/'.$id.'/'.$pass }}">{{ URL::to('Usuario/First').'/'.$codigo.'/'.$id.'/'.$pass }}</a> </p>
       <p>Al cambiar su contraseña, utilice una contraseña facil de recordar para usted, y no la comparta con nadie mas.Los datos de su usuario, son:</p>
       <h3>UserName: {{$username}}</h3>   
       <h3>Nombre: {{$nombre}}</h3>    
       <h3>Telefono: {{$telefono}}</h3>
       <h3>Cargo: {{$cargo}}</h3>
		<p>Una vez que usted haya realizado el cambio de contraseña, puede iniciar sesion desde el enlace: <a href="{{URL::to('login')}}">{{URL::to('login')}}</a></p>
   </body>
</html>
