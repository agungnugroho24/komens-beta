<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostAduanSiber;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Http\Controllers\AdministrasiUserController;

class PostAduanSiberController extends Controller
{
    protected $title = "Halaman Post Aduan Siber";
    protected $segment = "Post Aduan Siber";    
    protected $titlepage = "Aduan Siber";
    protected $fronttitle = "CSIRT Kementerian PPN/Bappenas";     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office.pages.post_aduansiber_bo', ['title' => $this->title, 'segment' => $this->dataSegment()]);
    }

    public function dataSegment()
    {
        $linksegment = route('post-aduansiber');
        $datasegment = [
            'segment' => $this->segment,
            'linksegment' => $linksegment,
        ];
        return $datasegment;
    }

    public function pageAduanSiber()
    {
        $query = $this->getDataAduanSiber();
        return view('front-office.details.page_detail_1', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $query]);
    } 

    public function pageAduanSiber2()
    {
        $query = PostAduanSiber::where('is_publish', '=', 1)->paginate(5);
        if($query->isNotEmpty()):
            $data = $query;
            $route = url('/aduan-siber/detail');
        else:
            $data = NULL;
            $route = NULL;
        endif;

        return view('front-office.details.page_detail_6', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage, 'data' => $data, 'route' => $route]);
    } 

    public function getDataAduanSiber()
    {
        $query = PostAduanSiber::where('is_publish', '=', 1)->get();
        if($query->isNotEmpty()):
            $data = $query;
        else:
            $data = NULL;
        endif;        

        return $data;        
    }   

    public function getDataAduanSiberDetail($uuid)
    {
        $query = PostAduanSiber::where('uuid', '=', $uuid)->get();
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
        $title = "Halaman Input Data Aduan Siber";
        $pagestitle = "Form Input Data Aduan Siber";
        return view('back-office.forms.form_input_aduansiber', ['title' => $title, 'pagestitle' => $pagestitle, 'UIDuser' => $user->cekDataSessionUser()]);        
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
            // 'kategori' => 'required',
            'konten' => 'required',
        ];

        $messages = [
            'judul.required' => 'Field \':attribute\' tidak boleh kosong',
            // 'kategori.required' => 'Field \':attribute\' tidak boleh kosong',
            'konten.required' => 'Field \':attribute\' tidak boleh kosong',
        ];     

        $this->validate($request, $rules, $messages);   

        $data = array(
            'created_at' => Carbon::now(),
            'created_by' => $request->created_by,
            'judul' => $request->judul,
            // 'kategori' => $request->kategori,
            'konten' => $request->konten,
            'uuid' => (string) Str::uuid(),
        );

        $query = PostAduanSiber::create($data); 

        if($query):
            Alert::toast('Tambah Data Aduan Siber Berhasil', 'success');
            return redirect()->route('aduansiber.create');
        else:
            Alert::toast('Tambah Data Aduan Siber Gagal.!', 'error');
            return redirect()->route('aduansiber.create');
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
        $title = "Halaman Update Data Aduan Siber";
        $pagestitle = "Form Update Data Aduan Siber";        
        $post = PostAduanSiber::findOrFail($id);
        return view('back-office.forms.form_edit_aduansiber', ['title' => $this->title, 'pagestitle' => $pagestitle, 'data' => $post, 'UIDuser' => $user->cekDataSessionUser()]);          
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
            // 'kategori' => 'required',
            'konten' => 'required',
        ];

        $messages = [
            'judul.required' => 'Field \':attribute\' tidak boleh kosong',
            // 'kategori.required' => 'Field \':attribute\' tidak boleh kosong',
            'konten.required' => 'Field \':attribute\' tidak boleh kosong',
        ];     

        $this->validate($request, $rules, $messages);   

        $data = array(
            'updated_at' => Carbon::now(),
            'updated_by' => $request->updated_by,
            'judul' => $request->judul,
            // 'kategori' => $request->kategori,
            'konten' => $request->konten,
        );

        $query = PostAduanSiber::find($id)->update($data);

        if($query):
            Alert::toast('Update Data Aduan Siber Berhasil', 'success');
            return redirect()->route('post-aduansiber');
        else:
            Alert::toast('Update Data Aduan Siber Gagal.!', 'error');
            return redirect()->route('post-aduansiber');
        endif;         
    }

    public function updatePublish(Request $request, $id)
    {         
        $result = PostAduanSiber::findOrFail($id);
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

        $query = PostAduanSiber::find($id)->update($data);       

        if($query):
            Alert::toast('Update Status Post Data Aduan Siber Berhasil', 'success');
            return redirect()->route('post-aduansiber');
        else:
            Alert::toast('Update Status Post Data Aduan Siber Gagal.!', 'error');
            return redirect()->route('post-aduansiber');
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
        $post = PostAduanSiber::find($id);
        $query = $post->forceDelete();

        if($query):
            Alert::toast('Berhasil Hapus Data Aduan Siber', 'success');
            return redirect()->route('post-aduansiber');
        else:
            Alert::toast('Gagal Hapus Data Aduan Siber.!', 'error');
            return redirect()->route('post-aduansiber');
        endif;        
    }

    public function getDatatablesJson()
    {
        $data = DB::table('post_aduansiber')
            ->join('users', 'users.uid', '=', 'post_aduansiber.created_by')
            ->select([
                'post_aduansiber.id_aduansiber',
                'users.name',
                'users.uid',
                'post_aduansiber.judul',
                'post_aduansiber.kategori',
                'post_aduansiber.konten',
                'post_aduansiber.is_publish',
                'post_aduansiber.published_at',
                'post_aduansiber.created_at',
                'post_aduansiber.created_by',
                'post_aduansiber.updated_at',
                'post_aduansiber.updated_by',
            ])
            ->orderBy('post_aduansiber.id_aduansiber', 'DESC')
            ->get();
        
        return DataTables::of($data)
            ->addColumn('update', function($data){
                $route_update = route('aduansiber.edit', ['id' =>$data->id_aduansiber]);
                $updated = "<a href='$route_update' title='Update Data'><button type='button' class='btn btn-icon btn-round btn-warning btn-xs'><i class='fas fa-edit'></i></button></a>";    
                
                return $updated;           
            })
            ->addColumn('delete', function($data){
                $route_delete = route('aduansiber.delete', ['id' =>$data->id_aduansiber]);
                $deleted = "<a href='$route_delete' class='hard-delete-confirm' title='Delete Data'><button type='button' class='btn btn-icon btn-round btn-danger btn-xs'><i class='fas fa-trash-alt'></i></button></a>";
  
                return $deleted;            
            })
            ->addColumn('publish', function($data){
                $route_publish = route('aduansiber.publish', ['id' =>$data->id_aduansiber]);
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
