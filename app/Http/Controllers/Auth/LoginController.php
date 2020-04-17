<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function indexlogin(){
        // if (auth()->guard('admin')->check()) return redirect('admin/dashboard');
        return view('admin.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|string'
        ]);

        $auth = $request->only('username', 'password');
        $auth['id_roles'] = 1;
  
        
        if (auth()->attempt($auth)) {
        // if (auth()->guard('admin')->attempt($auth)) {
            $user = Auth::user();
            $user->api_token = str_random(60);
            $user->save();
            return response()->json(['success' => $user], 200); 
            // return redirect('/admin/dasboard');
            // return redirect()->intended(route('customer.dashboard'));
        }
        return redirect()->back()->with(['error' => 'Username / Password Salah']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('admin/login');
        // return response()->json(['message' => 'Successfully logged out']);
    }

    public function dashboard()
    {
        return view('admin.admin');
    }
}
