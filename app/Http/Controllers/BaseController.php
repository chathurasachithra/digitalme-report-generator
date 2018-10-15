<?php

namespace App\Http\Controllers;

use App\Http\Controllers\View;
use DB;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
class BaseController extends Controller
{
	//define return response params
    public	$msg = '';
	public	$status = false;
	public	$data = null;
	protected $site_settings;

    /**
     * BaseController constructor.
     */
	public function __construct()
	{
		$this->setConfigurationsValues();	
		$this->getUserRole();	
	}

    /**
     *
     */
	public function setConfigurationsValues(){
		//show system logo on each views
		$configurations_list = DB::table('core_config')
                            ->select('core_config.*')
                            ->where(['core_config.deleted_at' => null])
                            ->get();

        $systemData = array();
        foreach($configurations_list as $config){
           $this->site_settings[$config->key] = $config->value;
        }                  

        \View::share('site_settings', $this->site_settings);
	}

    /**
     *
     */
	public function getUserRole(){

		if(is_object(\Auth::user())){
			$logged_user = DB::table('users')->select('users.*','roles.display_name as rolename')->join('roles','roles.id','=','users.role_id')->where(['users.id' => \Auth::user()->id])->get();	
			\View::share('logged_user', $logged_user);	
		}
		
	}
}
