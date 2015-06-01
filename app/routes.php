<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

/*
Route::get('kher09', function(){
	$user = new User;
    $user->username = "kher09";
    $user->password = Hash::make("123456");
    $user->correo="kher09@outlook.com";
    $user->role_id = 0;//admmin
    $user->enable=1;
    $user->firstlog=0;
    $user->forgetpass=0;
    if($user->save()){
    	$admin=new UserAdmin();
    	$admin->id_usuario=$user->id;
    	$admin->nombre="Kevin Hernandez";
    	$admin->telefono="8998-1256";
    	$admin->cargo="Desarrollador";
    	if($admin->save()){
    		   return "Usuario ".$admin->nombre." agregado correctamente";
    	}
    }

});



/*
ROLES DE USUARIOS
0-Admin
1-CEMED
2-Silais
3-Unidades


*/
Route::get('login', function(){
	return View::make('usuarios.login');
});


Route::get('correo', function(){
		$uripass=URL::to('Usuario/First/Pass').'/mkmakskamsm/8/jjkjk12kk13km';
		$data = array(
						'urlpass' => $uripass,
						'nombre' => 'Kevin Hernadne',
						'username' => 'kher09',
						'telefono' => '999999',
						'cargo' => 'Informatica',
						'codigo'=>'88828221213',
						'id'=>'2',
						'pass'=>'alkladklwklklklks'
						);

						Mail::send('emails.template', $data, function($message){
					    	$message->to('kher09@outlook.com', 'CEMED')->subject('CEMED - Registro de Usuarios');
						});
		return $uripass;
		
		//return View::make('emails.template', array('data'=>$data,));
}); 



Route::get('/Usuario/Recuperar/{numero}/{id}/{pass}','AdminController@Add');

Route::get('/Usuario/First/{numero}/{id}/{pass}','UsuariosController@FirstLogin');

Route::post('/Usuario/First/Pass/{numero}/{id}/{pass}','UsuariosController@NewPass');
//Iniciar sesion
Route::post('usuarios/validar', array('uses'=> 'UsuariosController@validateLogin'));

Route::group(array('before' => 'auth'), function()		
	{
		Route::get('usuarios/logout', array('uses'=> 'UsuariosController@getLogout'));		//cerrar secion

		Route::group(array('prefix' => 'administrador', 'before' => 'roles:0,login'), function () {

			Route::get('/', function(){
				return Redirect::to('/administrador/Usuarios');
			});

			Route::group(array('prefix' => 'Usuarios'), function () {
				
				Route::get('/','AdminController@ShowUsers');
				
				Route::get('/Add','AdminController@AddUser');

				Route::get('/Update/{id}','UsuariosController@EditUser');

				Route::post('/Update/{id}','UsuariosController@UpdateUser');

				Route::post('/Add','UsuariosController@RegistrarUser');

				Route::get('/Del/{id}','UsuariosController@DeleteUser');

				Route::get('/Desactivar/{id}','UsuariosController@DesactivarUser');

				Route::get('/Activar/{id}','UsuariosController@ActivarUser');

				Route::post('/Silais/Unidad','AdminController@CargarUnidades');
			});

			Route::group(array('prefix' => 'Silais'), function () {

				Route::get('/','AdminController@ShowSilais');

				Route::post('/Add','AdminController@AddSilais');

				Route::post('/Unidad/Add','AdminController@AddUnidad');

				Route::get('/Equipos/{nombre}/{id}','EquiposController@EquiposSilais');

				Route::group(array('prefix' => 'Unidad'), function () {

					Route::get('/','AdminController@ShowSilais');

					Route::get('/Update/{Nombre}/{id}','AdminController@EditUnidad');

					Route::post('/Update/{id}','AdminController@UpdateUnidad');

					Route::get('/Equipos/{Nombre}/{id}','EquiposController@EquiposUnidad');

				});
			});

			Route::group(array('prefix' => 'Equipos'), function () {

				Route::get('/Add','EquiposController@AddView');

				Route::get('/Show',function(){
					$Equipos=Equipo::all();
					return View::make('Admin.Equipos.General', array('Equipos'=>$Equipos));
				});

				Route::post('/Add','EquiposController@AddEquipos');

				Route::get('/Categorias','EquiposController@ShowCategorias');

				Route::post('/Categorias/Add','EquiposController@AddCategorias');
			});
		});

		Route::group(array('prefix' => 'Silais', 'before' => 'roles:2,login'), function () {

			Route::get('/', function(){
				return View::make('Silais.inicio');
			});

			Route::group(array('prefix' => 'Equipos'), function () {

				Route::get('/Show','SilaisController@EquiposSilais');

				Route::get('/Add','SilaisController@AddEquipo');

				Route::post('/Add','SilaisController@NewEquipo');

				Route::get('/Categorias','EquiposController@ShowCategorias');

				Route::post('/Categorias/Add','EquiposController@AddCategorias');
			});

			Route::group(array('prefix' => 'Unidades'), function () {

					Route::get('/Show','SilaisController@ShowUnidades');

					Route::get('/Add','SilaisController@AddUnidad');

					Route::post('/Update/{id}','AdminController@UpdateUnidad');

					Route::get('/Equipos/{Nombre}/{id}','EquiposController@EquiposUnidad');

				});
		});

		Route::group(array('prefix' => 'Unidad', 'before' => 'roles:3,login'), function () {

			Route::get('/', function(){
				return View::make('Unidades.inicio');
			});

			Route::group(array('prefix' => 'Equipos'), function () {

				Route::get('/Show','UnidadController@Equipos');

				Route::get('/Add',function(){
					$EspecialidadMedica=Especialidad::where('tipo','0')->get();

					$EspecialidadNoMedica=Especialidad::where('tipo','1')->get();

					return View::make('Unidades.Equipos.Add',array('EspecialidadMedica'=>$EspecialidadMedica,'EspecialidadNoMedica'=>$EspecialidadNoMedica));
				});

				Route::post('/Add','EquiposController@AddEquiposUnidad');

				Route::get('/Categorias','EquiposController@ShowCategorias');

				Route::post('/Categorias/Add','EquiposController@AddCategorias');
			});

			Route::group(array('prefix' => 'Unidades'), function () {

					Route::get('/Show','SilaisController@ShowUnidades');

					Route::get('/Add','SilaisController@AddUnidad');

					Route::post('/Update/{id}','AdminController@UpdateUnidad');

					Route::get('/Equipos/{Nombre}/{id}','EquiposController@EquiposUnidad');

				});
		});
	});
