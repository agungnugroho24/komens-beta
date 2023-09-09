<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostBerita;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Http\Controllers\AdministrasiUserController;

class PostBeritaController extends Controller
{
    protected $title = "Halaman Post Berita";
    protected $segment = "Post Berita";  
    protected $titlepage = "Berita";
    protected $fronttitle = "CSIRT Kementerian PPN/Bappenas";      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office.pages.post_berita_bo', ['title' => $this->title, 'segment' => $this->dataSegment()]);
    }

    public function dataSegment()
    {
        $linksegment = route('post-berita');
        $datasegment = [
            'segment' => $this->segment,
            'linksegment' => $linksegment,
        ];
        return $datasegment;
    }

    public function getDataBerita()
    {
        $query = PostBerita::where('is_publish', '=', 1)->orderByDesc('id_berita')->paginate(5);
        if($query->isNotEmpty()):
            $data = $query;
            $route = url('/berita/detail');
        else:
            $data = NULL;
            $route = NULL;
        endif;        

        return view('front-office.details.page_detail_5', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $data, 'route' => $route]);;        
    }  

    public function getDataBeritaDetail($uuid)
    {
        $query = PostBerita::where('uuid', '=', $uuid)->get();
        if($query->isNotEmpty()):
            $data = $query;
            foreach($data as $row):
                $judul = $row->judul;
            endforeach;
        else:
            $data = NULL;
            $judul = NULL;
        endif;        

        return view('front-office.details.page_detail_4', ['title' => $this->titlepage." | ".$judul." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $data]);;        
    }        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new AdministrasiUserController;
        $title = "Halaman Input Data Berita";
        $pagestitle = "Form Input Data Berita";
        return view('back-office.forms.form_input_berita', ['title' => $title, 'pagestitle' => $pagestitle, 'UIDuser' => $user->cekDataSessionUser()]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required',
            'konten' => 'required',
            'deskripsi' => 'required',
            'thumbnail' => 'required',
            // 'teks_thumbnail' => 'required',
        ];

        $messages = [
            'judul.required' => 'Field \':attribute\' tidak boleh kosong',
            'konten.required' => 'Field \':attribute\' tidak boleh kosong',
            'deskripsi.required' => 'Field \':attribute\' tidak boleh kosong',
            'thumbnail.required' => 'Field \':attribute\' tidak boleh kosong',
            // 'teks_thumbnail.required' => 'Field \':attribute\' tidak boleh kosong',
        ];     

        $this->validate($request, $rules, $messages);   

        $data = array(
            'created_at' => Carbon::now(),
            'created_by' => $request->created_by,
            'judul' => $request->judul,
            // 'kategori' => $request->kategori,
            'konten' => $request->konten,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $request->thumbnail,
            'teks_thumbnail' => $request->teks_thumbnail,
            'uuid' => (string) Str::uuid(),
        );

        $query = PostBerita::create($data); 

        if($query):
            Alert::toast('Tambah Data Berita Berhasil', 'success');
            return redirect()->route('berita.create');
        else:
            Alert::toast('Tambah Data Berita Gagal.!', 'error');
            return redirect()->route('berita.create');
        endif;         
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
        $user = new AdministrasiUserController;
        $title = "Halaman Update Data Berita";
        $pagestitle = "Form Update Data Berita";        
        $post = PostBerita::findOrFail($id);
        return view('back-office.forms.form_edit_berita', ['title' => $this->title, 'pagestitle' => $pagestitle, 'data' => $post, 'UIDuser' => $user->cekDataSessionUser()]);           
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
        $rules = [
            'judul' => 'required',
            'konten' => 'required',
            'deskripsi' => 'required',
            'thumbnail' => 'required',
            // 'teks_thumbnail' => 'required',
        ];

        $messages = [
            'judul.required' => 'Field \':attribute\' tidak boleh kosong',
            'konten.required' => 'Field \':attribute\' tidak boleh kosong',
            'deskripsi.required' => 'Field \':attribute\' tidak boleh kosong',
            'thumbnail.required' => 'Field \':attribute\' tidak boleh kosong',
            // 'teks_thumbnail.required' => 'Field \':attribute\' tidak boleh kosong',
        ];     
        
        $this->validate($request, $rules, $messages);   
        
        $data = array(
            'updated_at' => Carbon::now(),
            'updated_by' => $request->updated_by,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $request->thumbnail,
            'teks_thumbnail' => $request->teks_thumbnail,
        );

        $query = PostBerita::find($id)->update($data);
        
        if($query):
            Alert::toast('Update Data Berita Berhasil', 'success');
            return redirect()->route('post-berita');
        else:
            Alert::toast('Update Data Berita Gagal.!', 'error');
            return redirect()->route('post-berita');
        endif;          
    }

    public function updatePublish(Request $request, $id)
    {         
        $result = PostBerita::findOrFail($id);
        if(!empty($result)):
            $publish = $result->is_publish;
            $datepublished = $result->published_at;

            if($publish == 0):
                $datapublish = 1;    

                if(empty($datepublished)):
                    $date_published = Carbon::now();               
                else:
                    $date_published = $result->published_at;             
                endif;                           
            else:
                $datapublish = 0;             
                $date_published = $result->published_at;             
            endif;
        endif; 

        $data = array(
            'is_publish' => $datapublish,
            'published_at' => $date_published,
        );          

        $query = PostBerita::find($id)->update($data);       

        if($query):
            Alert::toast('Update Status Post Data Berita Berhasil', 'success');
            return redirect()->route('post-berita');
        else:
            Alert::toast('Update Status Post Data Berita Gagal.!', 'error');
            return redirect()->route('post-berita');
        endif;        
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = PostBerita::find($id);
        $query = $post->forceDelete();

        if($query):
            Alert::toast('Berhasil Hapus Data Berita', 'success');
            return redirect()->route('post-berita');
        else:
            Alert::toast('Gagal Hapus Data Berita.!', 'error');
            return redirect()->route('post-berita');
        endif;         
    }

    public function getDatatablesJson()
    {
        $data = DB::table('post_berita')
            ->join('users', 'users.uid', '=', 'post_berita.created_by')
            ->select([
                'post_berita.id_berita',
                'users.name',
                'users.uid',
                'post_berita.judul',
                'post_berita.kategori',
                'post_berita.konten',
                'post_berita.deskripsi',
                'post_berita.thumbnail',
                'post_berita.teks_thumbnail',
                'post_berita.is_publish',
                'post_berita.published_at',
                'post_berita.created_at',
                'post_berita.created_by',
                'post_berita.updated_at',
                'post_berita.updated_by',
            ])
            ->orderBy('post_berita.id_berita', 'DESC')
            ->get();
        
        return DataTables::of($data)
            ->addColumn('update', function($data){
                $route_update = route('berita.edit', ['id' =>$data->id_berita]);
                $updated = "<a href='$route_update' title='Update Data'><button type='button' class='btn btn-icon btn-round btn-warning btn-xs'><i class='fas fa-edit'></i></button></a>";    
                
                return $updated;           
            })
            ->addColumn('delete', function($data){
                $route_delete = route('berita.delete', ['id' =>$data->id_berita]);
                $deleted = "<a href='$route_delete' class='hard-delete-confirm' title='Delete Data'><button type='button' class='btn btn-icon btn-round btn-danger btn-xs'><i class='fas fa-trash-alt'></i></button></a>";
  
                return $deleted;            
            })
            ->addColumn('publish', function($data){
                $route_publish = route('berita.publish', ['id' =>$data->id_berita]);
                if($data->is_publish == 0):
                    $published = "<a href='$route_publish' title='Published'><button type='button' class='btn btn-icon btn-round btn-info btn-xs'><i class='fas fa-share-square'></i></button></a>";
                else:
                    $published = "<a href='$route_publish' title='Unpublished'><button type='button' class='btn btn-icon btn-round btn-primary btn-xs'><i class='fas fa-share-square'></i></button</a>";
                endif;  
                return $published;            
            })  
            ->addColumn('updated_at', function($data){
                if(empty($data->updated_at)):
                    $updated_at = "-";
                else:
                    $updated_at = $data->updated_at;
                endif;  
                return $updated_at;            
            }) 
            ->addColumn('published_at', function($data){
                if(empty($data->published_at)):
                    $published_at = "-";
                else:
                    $published_at = $data->published_at;
                endif;  
                return $published_at;            
            })    
            ->addColumn('deskripsi', function($data){
                if(empty($data->deskripsi)):
                    $deskripsi = "-";
                else:
                    $deskripsi = $data->deskripsi;
                endif;  
                return $deskripsi;            
            })                                   
            ->addColumn('konten', function($data){
                $konten = $data->konten;   
                return $konten;            
            })          
            ->rawColumns(['update', 'delete', 'publish', 'konten'])
            ->toJson();

    }

}
