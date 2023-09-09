<?php

namespace App\Http\Controllers\Auth; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

class LibSSOController extends Controller
{

    var $app        = 'bappenas-komens-beta-version-dev';
    var $apikey     = 'twVXNQ83QfNGuKCHjs%21gnIKOFSxF6BOh0iViaoa0Ig5GV4BnSRVz2wuxsyrDob0KWbYRnz%217e5EwDNSb1dDSyw==';
    var $sess_id    = '';

    // use this for env production
    // var $app        = 'bappenas-komens';
    // var $apikey     = '3BrwyKngPwb4A%21PKG6EcLg95edvo+JJXMyp0SQqsQaI63aC+9qHzsyfG52vyt+S7yGuFsjo+IiVi6cxjskhm3g==';
    // var $sess_id    = ''; 


    public function __construct()
    {
        if(! isset($_COOKIE['um-bp'])):
            $this->sess_id = null;
        else:
            $cookies = $_COOKIE['um-bp']; 
            $this->sess_id = substr($cookies, strpos($cookies, "32:") + 4, 32);            
        endif;

        return $this->sess_id;
    }

    public function deleteCookies()
    {
        if (isset($_COOKIE['um-bp'])) {
            unset($_COOKIE['um-bp']); 
            setcookie('um-bp', null, -1, '/'); 
            return true;
        } else {
            return false;
        }        
    }


    public function setCookies(){
        if(! isset($_COOKIE['um-bp'])):
            $this->sess_id = null;
        else:
            $cookies = $_COOKIE['um-bp']; 
            $this->sess_id = substr($cookies, strpos($cookies, "32:") + 4, 32);           
        endif;

        return $this->sess_id;
    }

    public function getData(){
        $sess_id = $this->setCookies();
        $isian = array( 'session' => $sess_id,
                        'app'      => $this->app,
                        'apikey'   => $this->apikey);
        $url = "https://akun.bappenas.go.id/bp-um/service/checkSession";
        return $this->postData($isian, $url);
    } 

    public function deleteSession(){
        $isian = array( 'session' => $this->sess_id,
                        'app'      => $this->app,
                        'apikey'   => $this->apikey);
        $url = "https://akun.bappenas.go.id/bp-um/service/deleteSession";
        unset($_COOKIE["um-bp"]);
        $this->deleteCookies();
        // $this->sess_id = NULL;
        return $this->postData($isian, $url);
        
    }

    public function getOneStepAhead($username){
        if(!empty($username)){
            $isian = array( 'username' => $username,
                            'app'      => $this->app,
                            'apikey'   => $this->apikey);
            $url = "https://akun.bappenas.go.id/bp-um/service/getUserBoss";
            //unset($_COOKIE["um-bp"]);
            return $this->postData($isian, $url);
        }else{
            return false;
        }
    }

    public function getUserapp(){
        $isian = array( 'username' => $this->getData()->data[0]->userid,
                        'app'      => $this->app,
                        'apikey'   => $this->apikey);
        $url = "https://akun.bappenas.go.id/bp-um/service/getUserApp";
        return $this->postData($isian, $url);
    }

    public function getuserdata($uid){
        $isian = array( 'username' => $uid,
                        'app'      => $this->app,
                        'apikey'   => $this->apikey);
        $url = "https://akun.bappenas.go.id/bp-um/service/checkUser";
        return $this->postData($isian, $url);
    }

    private function postData($data, $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec ($ch);
        curl_close ($ch);
        $hasil = json_decode($output);
        return $hasil;
    }



}
