<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $title = "Otentikasi Back Office";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return view('front-office.pages.home_login_sso', ['title' => $this->title]);
    }

    // public function generateuuid()
    // {
    //     $data=DB::table('files')->get();

    //     foreach($data as $row):
    //         $ids = $row->id;

    //         DB::table('files')
    //             ->where('id', $ids)
    //             ->update(['uuid' => (string) Str::uuid()]);            
    //     endforeach;
    // }

    // public function generateslug()
    // {
    //     $data=DB::table('kategoris')->get();

    //     foreach($data as $row):
    //         $ids = $row->id;
    //         $names = $row->nama;

    //         DB::table('kategoris')
    //             ->where('id', $ids)
    //             ->update(['slug' => Str::of($names)->slug('-') ]);            
    //     endforeach;
    // }

    public function produk()
    {
        $data = Kategori::get();

        return view('pages.produk',compact('data'));
    }

    public function listproduk()
    {
        return view('pages.listproduk');
    }

    public function detailproduk()
    {
        return view('pages.detailproduk');
    }

    public function pdfviewer(Request $request)
    {
        $data = File::where('uuid', $request->uuid)->get();

        return view('pages.pdfview', compact('data'));
    }

    public function detail(Request $request)
    {
        $data1 = Kategori::where('slug', $request->slug)->get();

        if($data1){
            foreach($data1 as $row1):
                $idkat = $row1->id;
            endforeach;
        }else{
            $idkat = null;
        }

        if($idkat){
            $data = File::where('id_kat', $idkat)->get();
        }else{
            $data = null;
        }

        return view('pages.detailproduk',compact('data'));
    }

    public function download($file)
    {
      $url = Storage::url($file);


        $download=DB::table('files')->get();
        return Storage::download($url);
        // view("files.download", compact('$download'));
    }

    public function downloadfile(Request $request)
    {
        
        $path = File::select('path')
        ->where("uuid", $request->uuid)
        ->get();

        foreach($path as $data):
            $pathfile = $data->path;
        endforeach;

        // dd($pathfile);
        // dd( response()->download(public_path("/file-storage/".$path)) );

        return response()->download(public_path("/file-storage/".$pathfile));

    }

    public function search(Request $request)
    {
        if (is_array($request->s)){
            return redirect()->route('notfound');
        }      

        if ($request->s == '' || (! isset($request->s)) ){
            return redirect()->route('notfound');
        }
        elseif ($request->s === null){
            return redirect()->route('notfound');
        }
        else{
            $data = File::where([
                ['judul', '!=', Null],
                ['bidang', '!=', Null],
                ['uke', '!=', Null],
                ['deskripsi', '!=', Null],
                [function ($query) use ($request) {
                    if (($request->s)) {
                        $strings = $request->s;
                        $s = preg_replace('/[@\#\?\{\}|<\>\%\^\*\[\]\|\/\(\)\.\;\=\""]+/', '', $strings);
                        // $s = $request->s;                        
                        $query->orWhere('judul', 'LIKE', '%' . $s . '%')
                            ->orWhere('bidang', 'LIKE', '%' . $s . '%')
                            ->orWhere('uke', 'LIKE', '%' . $s . '%')
                            ->orWhere('deskripsi', 'LIKE', '%' . $s . '%')
                            ->get();
                    }
                }]
            ])->get();
        }
        
        return view('pages.search',compact('data'));
    }

    public function notfound()
    {        
        return view('pages.404');
    }
}
