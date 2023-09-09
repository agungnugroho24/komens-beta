<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
 
class CustomHelper {

    public static function custom_path($path='') {
        return getcwd().'/'.$path;
    }

    public static function csirt_asset($path, $secure = null) {
        // return app('url')->asset('public/'.$path, $secure);//dipakai saat pindah ke server(ketika ada perubahan susunan direktori folder asset)
        return app('url')->asset($path, $secure);
    }
}