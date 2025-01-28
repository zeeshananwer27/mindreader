<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Enums\StatusEnum;
use App\Models\Admin;
use App\Traits\InstallerManager;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class InstallerController extends Controller
{

    use InstallerManager;

    public function __construct(){

        $this->middleware(function ($request, $next) {
            if($this->is_installed() 
                    && !$request->routeIs('install.setup.finished') 
                    && !$request->routeIs('invalid.purchase') 
                    && !$request->routeIs('verify.puchase')){
                return redirect()->route('home')->with('success',trans('default.already_installed'));
            }
            return $next($request);
        });
    
    }


    /**
     * Installer init
     *
     * @return View
     */
    public function init() :View
    {
        $this->_registerDomain();
        return view('install.init',[
            'title' => 'Install'
        ]);
    }

    
    /**
     * Requirments and permission verifications
     *
     * @return View |RedirectResponse
     */
    public function requirementVerification() : View |RedirectResponse
    {   

        if (Hash::check('requirements', request()->input('verify_token'))) {
            return view('install.requirements',[
                'title' => 'File Permissions & Requirments',
                'requirements' => $this->checkRequirements(
                    config('installer.requirements')
                ),
                "phpSupportInfo" =>  $this->checkPHPversion(config('installer.core.minPhpVersion')),
                'permissions'    => $this->permissionsCheck(
                                        config('installer.permissions')
                                    )
                
            ]);
        }

        return redirect()->route('install.init')->with('error','Invalid verification token');
    }



    /**
     * Envato verification view
     *
     * @return View |RedirectResponse
     */
    public function envatoVerification() :View |RedirectResponse
    {

        if(session()->get('system_requirments')){

            if (Hash::check('envato_verification', request()->input('verify_token'))) return view('install.envato_verification',[
                'title' => 'Envato Verification'
            ]);
            return redirect()->route('install.init')->with('error','Invalid verification token');
        }
        
        return redirect()->back()->with('error','Server requirements not met. Ensure all essential Extension and file permissions are enabled to ensure proper functionality');
        
    }


    /**
     * Envato verification
     *
     * @param Request $request
     * @return View |RedirectResponse
     */
    public function purchaseVerification(Request $request) :View |RedirectResponse
    {
        $request->validate([
            'requirements' => "required",
            'username'         => "required"
        ],[
            'purchase_code.required' => "Code is required", 
            'username.required'         => "Username is required", 
        ]);

        if($this->_envatoVerification($request)){
            session()->put( 'purchase_code', $request->input('purchase_code'));
            session()->put( 'username', $request->input('username'));
            return redirect()->route('install.db.setup',['verify_token' => bcrypt('dbsetup_')]);
        }
    
        return redirect()->back()->with('error','Invalid verification code');
    }


    /**
     * Database configuration view
     *
     * @return View |RedirectResponse
     */
    public function dbSetup() :View |RedirectResponse
    {
        if(session()->get('system_requirments')){
            if (Hash::check('dbsetup_', request()->input('verify_token'))) {
                return view('install.db_setup',[
                    'title' => 'Database Setup'
                ]);
            }
            return redirect()->route('install.init')->with('error','Invalid verification token');
        }

        return redirect()->back()->with('error','Server requirements not met. Ensure all essential Extension and file permissions are enabled to ensure proper functionality');
    }

    /**
     * Database setup
     *
     * @param Request $request
     * @return View |RedirectResponse
     */
    public function dbStore(Request $request) :View |RedirectResponse
    {

        $message = "Invalid database info. Kindly check your connection details and try again";
        $request->validate([
            'db_host'     => "required",
            'db_port'     => "required",
            'db_database' => "required",
            'db_username' => "required" ,
        ]);

        if($this->_chekcDbConnection( $request)){
            if($this->_envConfig($request))   return redirect()->route('install.account.setup',['verify_token' => bcrypt('system_config')]);
            $message = "Please empty your database then try again";
        }

        return back()->with("error", $message);


    }


    
    /**
     * Setup admin account
     *
     * @return View |RedirectResponse
     */
    public function accountSetup() :View |RedirectResponse
    {
  
        if (Hash::check('system_config', request()->input('verify_token'))) {
            return view('install.account_setup',[
                'title' => 'System Account Setup'
            ]);
        }
        return redirect()->route('install.init')->with('error','Invalid verification token');

    }

    /**
     * Account Store
     *
     * @param Request $request
     * @return View |RedirectResponse
     */
    public function accountSetupStore(Request $request) :View |RedirectResponse
    {

        try {

            $request->validate([
                'username' => 'required|max:155',
                'email'    => 'required|email|max:155',
                'password' => 'required|min:5',
            ]);

            $is_force = request()->input('force','0');

            if($is_force == StatusEnum::false->status() && !$this->_isDbEmpty()) {
                return redirect()->back()
                ->with('error','Please Empty Your database first!!');
            }

            $this->_dbMigrate($is_force);
            optimize_clear();


            $admin =  Admin::firstOrNew(['super_admin' => StatusEnum::true->status()]);
            $admin->username                  = $request->input('username');
            $admin->name                      = 'SuperAdmin';
            $admin->email                     = $request->input('email');
            $admin->password                  = Hash::make($request->input('password'));
            $admin->email_verified_at         = Carbon::now();
            $admin->super_admin               = StatusEnum::true->status();
            $admin->save();
    
            session()->put('password',$request->input('password'));

            $this->_dbSeed();
            $this->_systemInstalled();
    
            return redirect()->route('install.setup.finished',['verify_token' => bcrypt('setup_completed')]);
        } catch (\Exception $ex) {
            return back()->with('error', strip_tags($ex->getMessage()));

        }
       

    }


    /**
     * Setup finished
     *
     * @param Request $request
     * @return View |RedirectResponse
     */
    public function setupFinished(Request $request) :View |RedirectResponse
    {
        if (Hash::check('setup_completed', request()->input('verify_token'))) {
            $admin =  Admin::where('super_admin' , StatusEnum::true->status())->first();
            optimize_clear();
            return view('install.setup_finished',[
                'admin' => $admin,
                'title' => 'System Installed',
            ]);
        }

        return redirect()->route('install.init')->with('error','Invalid verification token');
    }



    /**
     * Invalid user
     *
     * @return View |RedirectResponse
     */
    public function invalidPurchase() :View |RedirectResponse
    {
        if(!$this->_isPurchased()){

            $view = request()->input('verification_view',false) ? 'install.invalid':'invalid_license' ;
            return view($view ,[
                'title' => 'Invalid Software License',
                'note'  => 'Please Verify Yourself',
            ]);
        }
        return redirect()->route("home")->with('success','Your system is already verified');

    }


    /**
     * Verify purchase
     *
     * @param Request $request
     * @return View |RedirectResponse
     */
    public function verifyPurchase(Request $request) :View |RedirectResponse
    {
  
    
        $request->validate([
            'purchase_code' => "required",
            'username'         => "required"
        ],[
            'purchase_code.required' => "Code is required", 
            'username.required'         => "Username is required", 
        ]);


        if($this->_registerDomain() && $this->_validatePurchaseKey($request->input('purchase_code')) ){

            $newPurchaseKey        = $request->input('purchase_code');
            $newEnvatoUsername     =  $request->input( 'username');
            update_env('PURCHASE_KEY',$newPurchaseKey);
            update_env('ENVATO_USERNAME',$newEnvatoUsername);
            optimize_clear();
            $this->_systemInstalled($newPurchaseKey,$newEnvatoUsername);
            return redirect()->route("admin.home")->with("success","Verified Successfully");
        }

        return redirect()->back()->with("error","Invalid Purchase key");
    }









}
