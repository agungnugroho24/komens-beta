<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, PostBerita, PostLayanan};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class BackOfficeController extends Controller
{
    // use AuthenticatesUsers;

    protected $title = "Halaman Dashboard";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'totalAdmin' => $this->totalAdmin(),
            'totalPostBerita' => $this->totalPostBerita(),
            'totalPostPanduanTeknis' => $this->totalPostLayanan('Pedoman/Panduan Teknis'),
            'totalPostTipsKeamanan' => $this->totalPostLayanan('Tips Keamanan Siber'),
            'dataArrayStatistikBerita' => $this->arrayDataBeritaPerBulan(),
            ];
        return view('back-office.pages.dashboard_bo', ['title' => $this->title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    public function totalAdmin()
    {
        $query = User::where('is_active', '=', 200)->where('is_approved', '=', 200)->count();
        
        if(! empty($query)):
            $data = $query;
        else:
            $data = 0;
        endif;  
        
        return $data;
    }
    
    public function totalPostBerita()
    {
        $query = PostBerita::where('is_publish', '=', 1)->count();
        
        if(! empty($query)):
            $data = $query;
        else:
            $data = 0;
        endif;  
        
        return $data;
    }
    
    public function totalPostBeritaPerBulan($bulan)
    {
        $query = DB::table('post_berita')->where('is_publish', '=', 1)->whereMonth('created_at', $bulan)->whereYear('created_at', date('Y'))->count();
        
        if(! empty($query)):
            $data = $query;
        else:
            $data = 0;
        endif;  
        
        return $data;
    }
    
    public function arrayDataBeritaPerBulan()
    {
        
        for($i=1; $i <= 12; $i++){
            // $data = [];
            $dataTotal = $this->totalPostBeritaPerBulan($i);
            $data[] = $dataTotal;
        }
        
        return $data;
    }
    
    public function totalPostLayanan($kategori)
    {
        $query = PostLayanan::where('is_publish', 1)->where('kategori', $kategori)->count();
        
        if(! empty($query)):
            $data = $query;
        else:
            $data = 0;
        endif;  
        
        return $data;
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
