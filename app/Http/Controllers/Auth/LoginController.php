<?php

namespace Ecotickets\Http\Controllers\Auth;

use Eco\Utilidades\JwtAutenticacion;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }


   /**  * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException**/

   public function login(Request $request)
    {
        Cache::flush();
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $usuario= $this->guard()->user();
            if($usuario->CorreoConfirmado == 1)
            {
                if($usuario->Sede->Empresa->EsActiva==1){
                    return $this->sendLoginResponse($request);
                }else{
                    $this->guard()->logout();
                    return view('auth.RespuestaRegistro',['respuesta'=>'sinPago']);
                }

            }
            else{
                $this->guard()->logout();
                return view('auth.RespuestaRegistro',['respuesta'=>false]);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
//NO BORRAR
  /*  public function loginApp($correo,$password)
    {
        $jwtAut= new JwtAutenticacion();

        if(!is_null($correo) && !is_null($password)){
            $singUp = $jwtAut->SingUp($correo,$password);
            return response()->json($singUp,200);
        }
    }*/

    public function loginApp($correo,$password)
    {
        $credentials =["email" => $correo,"password" => $password];
        return response()->json($this->attemptLoginAPP($credentials));
    }

    protected function credentials(Request $request)
    {
        $login = $request->input($this->username());
        // Comprobar si el input coincide con el formato de E-mail
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return [
            $field => $login,
            'password' => $request->input('password')
        ];
    }

    public function username()
    {
        return 'email';
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->Sede->Empresa->EsActiva==0)
            return redirect('/welcome');
    }

    protected function attemptLoginAPP($request)
    {
        return $this->guard()->attemptApp(
            $request, false
        );
    }

    public function logoutApp() {
        $this->guard()->logout();
        $respuesta =["cerrasSesion" => true];
        return $respuesta;
    }

    public function attemptApp(array $credentials = [], $remember = false)
    {
        $user = $this->provider->retrieveByCredentials($credentials);
        // If an implementation of UserInterface was returned, we'll ask the provider
        // to validate the user against the given credentials, and if they are in
        // fact valid we'll log the users into the application and return true.
        if ($this->hasValidCredentials($user, $credentials)) {

            return $user;
        }

        // If the authentication attempt fails we will fire an event so that the user
        // may be notified of any suspicious attempts to access their account from
        // an unrecognized user. A developer may listen to this event as needed.
        //$this->fireFailedEvent($user, $credentials);
        $respuesta = ['respuesta'=>false];
        return $respuesta;
    }

}
