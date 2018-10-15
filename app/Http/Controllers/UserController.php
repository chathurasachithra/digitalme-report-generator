<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as ValidationRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Redirect;
use App\Http\Controllers\Session;
use Validator;
use Hash;
use App\User;
use App\Role;
use DB;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends BaseController
{

    /**
     * @return mixed
     */
    public function getLogin(){
		return view('layouts.user.login');
	}

    /**
     * @return mixed
     */
	public function postLogin()
    {
		if(!Request::has('email') || !Request::has('password')){
    		$this->msg = "Invalid CredentigetDashboardals.!";
    		$this->status = false;
		}else{
			$checkUser = User::where('email',Request::get('email'))->first();
			if(!$checkUser){
	    		$this->msg = "Invalid Credentials.!";
	    		$this->status = false;
			}else{
				$hashedPassword = $checkUser->password;
				if(Hash::check(Request::get('password'), $hashedPassword)){
					$this->status = true;
					//\Auth::login($checkUser);
                    //$this->msg = 'Login successfull.!';
                    //$this->status = true;

                    $credentials = array('email' => Request::get('email'), 'password' => Request::get('password'));

                    if (\Auth::attempt($credentials, true))
                    {
                        //check active user or not
                        $profileId = \Auth::user()->id;
                        $isProfile = User::where('id',$profileId)->where('status',1)->get()->first();
                        if($isProfile){
                            $this->msg = 'Login successfull..!';
                            $this->status = true;
                           
                        }
                        else{
                            $this->msg = "Account is still not yet activated..!";
                            $this->status = false;
                        }

                    }else{
                        $this->msg = "Invalid Credentials..!";
                        $this->status = false;
                    }

				}else{
		    		$this->msg = "Invalid Credentials..!";
		    		$this->status = false;
				}
			}
		}
		if(Request::ajax()){
			return response()->json(['status' => $this->status, 'msg' => $this->msg ]);
		}else{
			if($this->status){
				//return redirect()->route('home');
                return redirect()->intended('user/dashboard');
			}else{
				return back()->withErrors($this->msg);				
			}
		}
	}

    /**
     * @param ValidationRequest $request
     * @return mixed
     */
	public function postRegister(ValidationRequest $request)
    {

	    $validator = Validator::make(Request::all(),[
	        'g-recaptcha-response' => 'required|recaptcha'
	    ]);

	    //capcha check only
	    if ($validator->fails()) {
	    	return response()->json(['status' => false, 'msg' => 'Please prove that you are a human.!' ]);
	    }

		if(!Request::has('name') || !Request::has('company') || !Request::has('email') || !Request::has('password') || !Request::has('repassword')){
    		$this->msg = "Please provide all the necessary details.!";
    		$this->status = false;
		}elseif(Request::get('name') == '' || Request::get('company') == '' || Request::get('email') == '' || Request::get('password') == '' || Request::get('repassword') == ''){
			$this->msg = "Please provide all the necessary details.!";
    		$this->status = false;
		}elseif(strlen(Request::get('password')) < 5 ) {
    		$this->msg = "Password should contain atleast 5 characters !";
    		$this->status = false;
		}elseif(Request::get('password') != Request::get('repassword')){
	   		$this->msg = "Passwords should be matched.!";
    		$this->status = false;
		}else{

			$requestParams = Request::all();

            //add default user role to new account for first time account add super admin role
            $roleId = 0;
            $userList = User::all();
            if(count($userList) > 0){
                //add default user role to new account
                $role = Role::where('name','user')->get()->first();
                $roleId = $role->id;
            }else{
                //add first time user to super admin role
                $role = Role::where('name','super_admin')->get()->first();
                $roleId = $role->id;
            }

			//check an user exists with same email
			$checkUser = User::where('email',$requestParams['email'])->get();

			if($checkUser->count() > 0){
				$this->status = false;
				$this->msg = "User with this email already exists.!";
			}else{
				$user = new User();
		        $user->fill([
		        	'name' => $requestParams['name'],
		        	'email' => $requestParams['email'],
		        	'company' => $requestParams['company'],
		        	'status' => 1,
                    'role_id' => $roleId,
                    'created_at' => date("Y-m-d H:i:s"),
		            'password' => Hash::make($requestParams['password'])
		        ])->save();

                $this->copyDefaultChartPlanToUser($user->id);

		        $this->status = true;
		        $this->msg = "Successfully added the User";

    	        Mail::send('emails.register',[], function ($m) use ($user) {
    	            $m->from(config('custom.fromEmail'), 'CCProject');
    	            $m->to($user->email, $user->name)->subject('Thanks for Registering with CCProject!');
    	        });
			}
		}

		if(Request::ajax()){
			return response()->json(['status' => $this->status, 'msg' => $this->msg ]);
		}else{
			if($this->status){
				\Session::flash('success',$this->msg);
				return back();
			}else{
				return back()->withErrors($this->msg);				
			}
		}
	}

    /**
     * @return mixed
     */
    public function getDashboard(){
        //return view('layouts.user.profile');
        return view('profilepage.main');
    }

    /**
     * @return mixed
     */
	public function getProfile(){

        $user_details = DB::table('users')->select('users.*','roles.display_name as rolename')
            ->join('roles','roles.id','=','users.role_id')->where(['users.id' => \Auth::user()->id])->get();

        return view('profilepage.profilecontent')->with(['logged_user'=>$user_details]);
	}


}