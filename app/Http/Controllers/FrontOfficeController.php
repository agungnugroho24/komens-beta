<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{PostBerita, PostProfil, PostRFC, PostLayanan, PostAduanSiber, PostEvent};
use Illuminate\Support\Facades\DB;

class FrontOfficeController extends Controller
{
    protected $title = "CSIRT Kementerian PPN/Bappenas";
    protected $tipskeamanan = "Tips Keamanan Siber";
    protected $panduanteknis = "Pedoman/Panduan Teknis";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $data['introberita'] = $this->getDataInformation('Intro Berita');
        $data['intropanduanteknis'] = $this->getDataInformation('Intro Panduan Teknis');
        $data['introtipskeamanansiber'] = $this->getDataInformation('Intro Tips Keamanan Siber');
        $data['introhubungikami'] = $this->getDataInformation('Intro Hubungi Kami');
        $data['alamatCSIRT'] = $this->getDataInformation('Alamat CSIRT Bappenas');
        $data['emailCSIRT'] = $this->getDataInformation('Email CSIRT Bappenas');
        $data['kontakCSIRT'] = $this->getDataInformation('Kontak CSIRT Bappenas');
        
        $data['databerita'] = $this->getDataBerita();
        $data['datalayanantipskeamanan'] = $this->getDataLayanan($this->tipskeamanan, 3);
        $data['datalayananpanduanteknis'] = $this->getDataLayanan($this->panduanteknis, 4);
        return view('front-office.pages.front_office', ['title' => $this->title, 'data' => $data]);
    }

    public function pagedetail()
    {
        $title = 'Detail Page';
        return view('front-office.details.page_detail_3', ['title' => $title]);
    }

    public function redirectOverwriteRoute()
    {
        return redirect()->route('front-office');
    }

    public function redirectOverwriteRoutePost(Request $request)
    {
        return redirect()->route('front-office');
    }

    public function getDataBerita()
    {
        $query = PostBerita::where('is_publish', 1)->get();
        $data = $query->sortDesc()->take(4);
        return $data;
    }   

    public function getDataLayanan($kategori, $numdata)
    {
        $query = PostLayanan::where('kategori', $kategori)->where('is_publish', 1)->get();
        $data = $query->sortDesc()->take($numdata);
        return $data;
    }

    public function getDataInformation($kategori)
    {
        $query = PostProfil::where('kategori', $kategori)->where('is_publish', 1)->get();
        if($query->isNotEmpty()):
            foreach($query as $row):
                $konten = $row->konten;
            endforeach;
        else:
            $konten = NULL;
        endif; 
        
        return $konten;
    }

}
