<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
  
class XMLController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $app_url = env('APP_URL');
        $xmlString = file_get_contents($app_url.'/sitemap_bappenas_csirt.xml');
        $xmlObject = simplexml_load_string($xmlString);

        $json = json_encode($xmlObject);
        $xmlWeb = json_decode($json, true); 
   

		return response()->view('front-office.pages.sitemap', [ 'data' => $xmlWeb])
						 ->header('Content-Type', 'text/xml');        
    }
    
  
}