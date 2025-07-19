<?php

namespace sisVentas\Http\Controllers\Auth;
use sisVentas\User;
use sisVentas\UserPermisos;
use Validator;
use sisVentas\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use sisVentas\Site;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;
    use ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'home';



    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
		     																	  
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
		/*
		 $id = $user_create->id;
        //dd($id);
        $permiso = new UserPermisos();
        $permiso->id_user = $id;
        $permiso->save();

        return $user_create;
		*/
    }
    public function showRegistrationForm()
    {
        return view('login');
    }
	
	///NO ESTA ENTRANDO AL HACER LOGIN
    protected function getCredentials_OLD(Request $request)
    {	$idsite = $request->site ;
		if (empty($idsite))
		{	/*
			$countSite = Site::where('condicion',1)->get()->count();
			if ( $countSite == 1)
				{	 
					$rSite = Site::where('condicion',1)->get();
					//dd($rSite );
					$idsite = $rSite[0]->id;
					Session::set('site_id', $idsite);
				}
			*/
		}
		else
			{
			Session::set('site_id', $request->site);
			}
			
        return $request->only($this->loginUsername(), 'password');
    }   

 

}
