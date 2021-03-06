<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    public function postRegister(Request $request)
    {
        // dd($request->all());
        $rules = [
            'user_name'          => 'required|max:255|min:6|unique:users,name',
            'email'             => 'required|email|unique:users,email',
            'phone'             => 'required',
            'user_password'          => 'required|min:8|max:64',
            'confirm_password'  => 'required|same:user_password'
        ];
        $messages = [
            'user_name.required'         => 'Vui l??ng nh???p username',
            'user_name.min'              => 'Username kh??ng d?????i 6 k?? t???',
            'user_name.max'              => 'Username kh??ng qu?? 64 k?? t???',
            'user_name.unique'           => 'Username ???? t???n t???i',

            'email.required'             => 'Vui l??ng nh???p email',
            'email.email'                => 'Vui l??ng nh???p ????ng ?????nh d???ng email',
            'email.unique'               => '?????a ch??? email ???? t???n t???i',

            'phone.required'             => 'Vui l??ng nh???p s??? ??i???n tho???i',
            
            'user_password.required'         => 'Vui l??ng nh???p password',
            'user_password.min'              => 'Vui l??ng nh???p password t???i thi???u 8 k?? t???',
            'user_password.max'              => 'Vui l??ng nh???p password t???i ??a 64 k?? t???',

            'confirm_password.same'      => 'M???t kh???u kh??ng kh???p',
            'confirm_password.required'  => 'Vui l??ng x??c nh???n m???t kh???u',
            
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $name     = $request->user_name;
        $password = $request->user_password;
        // $data = [
        //     'email'    => $request->email,
        //     'name'     => $request->user_name,
        //     'phone'    => $request->phone,
        //     'password' => Hash::make($request->user_password)
        // ];
        // $user = User::insert($data);
        $user = User::create([
            'email'    => $request->email,
            'name'     => $request->user_name,
            'phone'    => $request->phone,
            'password' => Hash::make($request->user_password)
        ]);
        event(new Registered($user));
        // Auth::attempt(['name'=>$name, 'password'=>$password]);
        return response()->json([
            'status' => true,
            'message' => '????ng k?? th??nh c??ng'
        ], 200);
        // $valid = Auth::guard('admin')->attempt(['email'=>$email, 'password'=>$password]);
        // var_dump ($valid);

        // die();
        // if ($valid) {
        //     $details = Auth::guard('admin')->user();
        //     $user = $details['original'];
        //     return response()->json([
        //         'status' => true
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'status' => 'auth_fail',
        //         'messages' => 'Email ho???c m???t kh???u ch??a ????ng'
        //     ], 400);
        // }
        // $data = [
        //  'avatar' => $request->email,
     //        'password' => $request->password
        // ];
        // if (Auth::attempt($data)) {
        //  return redirect()->route('register');
        // } else {
        //  return redirect()->route('login');
        // }
    }

    public function successRegister()
    {
        return view('auth.custom_verify');
    }
}
