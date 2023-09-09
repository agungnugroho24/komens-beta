<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostRFC;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Http\Controllers\AdministrasiUserController;

class PostRFCController extends Controller
{
    protected $title = "Halaman Post RFC 2350";
    protected $segment = "Post RFC 2350";   
    protected $titlepage = "RFC 2350";
    protected $fronttitle = "CSIRT Kementerian PPN/Bappenas";     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office.pages.post_rfc_bo', ['title' => $this->title, 'segment' => $this->dataSegment()]);
    }

    public function dataSegment()
    {
        $linksegment = route('post-rfc');
        $datasegment = [
            'segment' => $this->segment,
            'linksegment' => $linksegment,
        ];
        return $datasegment;
    }

    public function pageInformasiDokumen()
    {
        $kategori = 'Informasi Dokumen';
        $query = $this->getDataRFC($kategori);
        return view('front-office.details.page_detail_1', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $query]);
    }

    public function pageInformasiKontak()
    {
        $kategori = 'Informasi Kontak';
        $query = $this->getDataRFC($kategori);
        return view('front-office.details.page_detail_1', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $query]);
    }    

    public function pageTentangBappenasCSIRT()
    {
        $kategori = 'Tentang Bappenas CSIRT';
        $query = $this->getDataRFC($kategori);
        return view('front-office.details.page_detail_1', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $query]);
    }     

    public function pageLayananBappenasCSIRT()
    {
        $kategori = 'Layanan Bappenas CSIRT';
        $query = $this->getDataRFC($kategori);
        return view('front-office.details.page_detail_1', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $query]);
    }   

    public function pageKebijakan()
    {
        $kategori = 'Kebijakan';
        $query = $this->getDataRFC($kategori);
        return view('front-office.details.page_detail_1', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $query]);
    }       

    public function pagePelaporanInsiden()
    {
        $kategori = 'Pelaporan Insiden';
        $query = $this->getDataRFC($kategori);
        return view('front-office.details.page_detail_1', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $query]);
    }  

    public function pageDisclaimer()
    {
        $kategori = 'Disclaimer';
        $query = $this->getDataRFC($kategori);
        return view('front-office.details.page_detail_1', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $query]);
    }                

    public function getDataRFC($kategori)
    {
        $query = PostRFC::where('kategori', $kategori)->where('is_publish', '=', 1)->get();
        if($query->isNotEmpty()):
            $data = $query;
        else:
            $data = NULL;
        endif;        

        return $data;        
    }      

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new AdministrasiUserController;
        $title = "Halaman Input Data RFC 2350";
        $pagestitle = "Form Input Data RFC 2350";
        return view('back-office.forms.form_input_rfc', ['title' => $title, 'pagestitle' => $pagestitle, 'UIDuser' => $user->cekDataSessionUser()]);        
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
            'kategori' => 'required',
            'konten' => 'required',
        ];

        $messages = [
            'judul.required' => 'Field \':attribute\' tidak boleh kosong',
            'kategori.required' => 'Field \':attribute\' tidak boleh kosong',
            'konten.required' => 'Field \':attribute\' tidak boleh kosong',
        ];     

        $this->validate($request, $rules, $messages);   

        $data = array(
            'created_at' => Carbon::now(),
            'created_by' => $request->created_by,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'konten' => $request->konten,
            'uuid' => (string) Str::uuid(),
        );

        $query = PostRFC::create($data); 

        if($query):
            Alert::toast('Tambah Data RFC Berhasil', 'success');
            return redirect()->route('rfc.create');
        else:
            Alert::toast('Tambah Data RFC Gagal.!', 'error');
            return redirect()->route('rfc.create');
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
        $title = "Halaman Update Data RFC";
        $pagestitle = "Form Update Data RFC";        
        $post = PostRFC::findOrFail($id);
        return view('back-office.forms.form_edit_rfc', ['title' => $this->title, 'pagestitle' => $pagestitle, 'data' => $post, 'UIDuser' => $user->cekDataSessionUser()]);          
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
            'kategori' => 'required',
            'konten' => 'required',
        ];

        $messages = [
            'judul.required' => 'Field \':attribute\' tidak boleh kosong',
            'kategori.required' => 'Field \':attribute\' tidak boleh kosong',
            'konten.required' => 'Field \':attribute\' tidak boleh kosong',
        ];     

        $this->validate($request, $rules, $messages);   

        $data = array(
            'updated_at' => Carbon::now(),
            'updated_by' => $request->updated_by,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'konten' => $request->konten,
        );

        $query = PostRFC::find($id)->update($data);

        if($query):
            Alert::toast('Update Data RFC Berhasil', 'success');
            return redirect()->route('post-rfc');
        else:
            Alert::toast('Update Data RFC Gagal.!', 'error');
            return redirect()->route('post-rfc');
        endif;           
    }

    public function updatePublish(Request $request, $id)
    {         
        $result = PostRFC::findOrFail($id);
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

        $query = PostRFC::find($id)->update($data);       

        if($query):
            Alert::toast('Update Status Post Data RFC Berhasil', 'success');
            return redirect()->route('post-rfc');
        else:
            Alert::toast('Update Status Post Data RFC Gagal.!', 'error');
            return redirect()->route('post-rfc');
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
        $post = PostRFC::find($id);
        $query = $post->forceDelete();

        if($query):
            Alert::toast('Berhasil Hapus Data RFC', 'success');
            return redirect()->route('post-rfc');
        else:
            Alert::toast('Gagal Hapus Data RFC.!', 'error');
            return redirect()->route('post-rfc');
        endif;         
    }

    public function getDatatablesJson()
    {
        $data = DB::table('post_rfc')
            ->join('users', 'users.uid', '=', 'post_rfc.created_by')
            ->select([
                'post_rfc.id_rfc',
                'users.name',
                'users.uid',
                'post_rfc.judul',
                'post_rfc.kategori',
                'post_rfc.konten',
                'post_rfc.is_publish',
                'post_rfc.published_at',
                'post_rfc.created_at',
                'post_rfc.created_by',
                'post_rfc.updated_at',
                'post_rfc.updated_by',
            ])
            ->orderBy('post_rfc.id_rfc', 'DESC')
            ->get();
        
        return DataTables::of($data)
            ->addColumn('update', function($data){
                $route_update = route('rfc.edit', ['id' =>$data->id_rfc]);
                $updated = "<a href='$route_update' title='Update Data'><button type='button' class='btn btn-icon btn-round btn-warning btn-xs'><i class='fas fa-edit'></i></button></a>";    
                
                return $updated;           
            })
            ->addColumn('delete', function($data){
                $route_delete = route('rfc.delete', ['id' =>$data->id_rfc]);
                $deleted = "<a href='$route_delete' class='hard-delete-confirm' title='Delete Data'><button type='button' class='btn btn-icon btn-round btn-danger btn-xs'><i class='fas fa-trash-alt'></i></button></a>";
  
                return $deleted;            
            })
            ->addColumn('publish', function($data){
                $route_publish = route('rfc.publish', ['id' =>$data->id_rfc]);
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
            ->addColumn('konten', function($data){
                $konten = $data->konten;   
                return $konten;            
            })          
            ->rawColumns(['update', 'delete', 'publish', 'konten'])
            ->toJson();

    }

}
