<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LibSSOController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginSSOController extends Controller
{
    // use AuthenticatesUsers;
    
    var $app        = 'bappenas-komens-beta-version-dev';
    var $apikey     = 'twVXNQ83QfNGuKCHjs%21gnIKOFSxF6BOh0iViaoa0Ig5GV4BnSRVz2wuxsyrDob0KWbYRnz%217e5EwDNSb1dDSyw==';
    var $sess_id    = '';

    // use this for env production
    // var $app        = 'bappenas-komens';
    // var $apikey     = '3BrwyKngPwb4A%21PKG6EcLg95edvo+JJXMyp0SQqsQaI63aC+9qHzsyfG52vyt+S7yGuFsjo+IiVi6cxjskhm3g==';
    // var $sess_id    = '';    


    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $data = session('csirtssodev'); 
        
        if(! empty($data)){
            $login = $data["login"];
            if($login):
                return redirect()->route('home');
            else:
                return redirect()->route('home.login.sso'); 
            endif;            
        }
        
        $this->middleware('guest')->except('logout');

    }  

    public function login(){
        $libcontrol = new LibSSOController;
        $data = $libcontrol->getData();

        if(empty($data->data)){
            return redirect()->to('https://akun.bappenas.go.id/bp-um/service/front/bappenas-komens-beta-version-dev/twVXNQ83QfNGuKCHjs%21gnIKOFSxF6BOh0iViaoa0Ig5GV4BnSRVz2wuxsyrDob0KWbYRnz%217e5EwDNSb1dDSyw==')->send(); 

            // use this for en production
            // return redirect()->to('https://akun.bappenas.go.id/bp-um/service/front/bappenas-komens/3BrwyKngPwb4A%21PKG6EcLg95edvo+JJXMyp0SQqsQaI63aC+9qHzsyfG52vyt+S7yGuFsjo+IiVi6cxjskhm3g==')->send(); 
            
        }else{
            if(empty($data->userdata)){
                $this->logout();
            }else{
                $response = $this->process_login($data->userdata, $data->usermail);
                
                if($response):
                    return redirect()->route('home');  
                else:
                    return redirect()->route('home.login.sso'); 
                endif;
            }
        }
    }

    public function index(Request $request){
        return $this->login();
    }

    private function process_login($userdata, $email){
        $libcontrol = new LibSSOController;
        $request = new Request;
        
        //end checking user status
        $newdata = array( 'username'    => $userdata[0]->user_name,
                          'email'       => $email,
                          'nama'        => $userdata[0]->nama,
                          'nip'         => $userdata[0]->nip,
                          'jabatan'     => $userdata[0]->jabatan_akhir,
                          'id_jabatan'  => $userdata[0]->id_jabatan,
                          'eselon'      => $userdata[0]->eselon,
                          'kode_surat'  => $userdata[0]->kode_surat,
                          'iduke'       => $userdata[0]->id_unitkerja,
                          'nama_uke'    => $userdata[0]->unit_kerja,
                          'avatar'      => $userdata[0]->avatar,
                          'isorganik'   => $userdata[0]->isorganik,
                          'userapp'     => $libcontrol->getUserapp(),
                          'login'       => TRUE,
                    );

        Session::put('csirtssodev', $newdata); 
        $data = session('csirtssodev');
        $login = $data["login"];      
        
        if($login):
            $check_user = $this->getDataUserPPID();
            $check_user_exist = $check_user['status'];
            
            if($check_user_exist):
                $data_user = $check_user['data'];
                foreach($data_user as $row):
                    $iduser = $row->id;
                endforeach;

                Auth::loginUsingId($iduser, $remember = false);
                
            else:
                $data_input = $this->storeUserBappenas($newdata);
                Auth::login( $data_input, true );
                
            endif;

            return redirect()->route('home');
            // return TRUE;
        else:
            return FALSE; 
        endif;
    }
    
    public function getDataUserPPID()
    {
        $sess_key = session('csirtssodev');
        if(isset($sess_key)):
            $data = session('csirtssodev');
            $username = $data['username'];
            $email = $data['email'];
        else:
            $username = NULL;
            $email = NULL;
        endif;
        
        $query = User::where('email', '=',$email)->get();

        if($query->isNotEmpty()):
            $status = TRUE;
            $data = $query;
        
        else:
            $status = FALSE;
            $data = NULL;            
            
        endif;
        
        return ['status' => $status, 'data' => $data];
    }
    
    private function storeUserBappenas($data)
    {
        $pass = $data['username'].'0623'.$data['nip'];

        $data_input = [   
            'name' => $data['nama'] ,
            'email' => $data['email'],
            'password' => Hash::make($pass),
            'uid' => $data['username'],
            'nip' => $data['nip'],
            'jabatan' => $data['jabatan'],
            'id_jabatan' => $data['id_jabatan'],
            'eselon' => $data['eselon'],
            'iduke' => $data['iduke'],
            'nama_uke' => $data['nama_uke'],
            'email_verified_at' => Carbon::now(),
            'is_active' => 200,
            'is_bappenas' => 404,
        ];
        
        $user_bappenas = User::create($data_input);
        
        return $user_bappenas;
    }

    public function logout(Request $request){
        
        $libcontrol = new LibSSOController;
        $libcontrol->deleteSession();
        Session::flush();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    } 

    // public function logout()
    // {
    //     $libcontrol = new LibSSOController;
    //     $libcontrol->deleteSession();
    //     Auth::logout();
    //     Session::flush();

    //     return redirect()->route('home');
    // }
    

}
