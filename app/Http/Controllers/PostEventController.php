<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostEvent;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Http\Controllers\AdministrasiUserController;

class PostEventController extends Controller
{
    protected $title = "Halaman Post Event";
    protected $segment = "Post Event";
    protected $titlepage = "Event";
    protected $fronttitle = "CSIRT Kementerian PPN/Bappenas";         
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office.pages.post_event_bo', ['title' => $this->title, 'segment' => $this->dataSegment()]);
    }

    public function dataSegment()
    {
        $linksegment = route('post-event');
        $datasegment = [
            'segment' => $this->segment,
            'linksegment' => $linksegment,
        ];
        return $datasegment;
    }

    public function pageEvent()
    {
        // $kategori = 'Kebijakan';
        // $query = $this->getDataRFC($kategori);
        return view('front-office.details.page_detail_2', ['title' => $this->titlepage." | ".$this->fronttitle, 'titlepage' => $this->titlepage]);
    }     

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new AdministrasiUserController;
        $title = "Halaman Input Data Event";
        $pagestitle = "Form Input Data Event";
        return view('back-office.forms.form_input_event', ['title' => $title, 'pagestitle' => $pagestitle, 'UIDuser' => $user->cekDataSessionUser()]);        
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
            'judul_acara' => 'required',
            'tempat' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'materi' => 'required',
        ];

        $messages = [
            'judul_acara.required' => 'Field \':attribute\' tidak boleh kosong',
            'tempat.required' => 'Field \':attribute\' tidak boleh kosong',
            'tanggal_mulai.required' => 'Field \':attribute\' tidak boleh kosong',
            'tanggal_selesai.required' => 'Field \':attribute\' tidak boleh kosong',
            'materi.required' => 'Field \':attribute\' tidak boleh kosong',
        ];     

        $this->validate($request, $rules, $messages);   

        $data = array(
            'created_at' => Carbon::now(),
            'created_by' => $request->created_by,
            'judul_acara' => $request->judul_acara,
            'tempat' => $request->tempat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_selesai,
            'materi' => $request->materi,
            'uuid' => (string) Str::uuid(),
        );

        $query = PostEvent::create($data); 

        if($query):
            Alert::toast('Tambah Data Event Berhasil', 'success');
            return redirect()->route('event.create');
        else:
            Alert::toast('Tambah Data Event Gagal.!', 'error');
            return redirect()->route('event.create');
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
        $title = "Halaman Update Data Event";
        $pagestitle = "Form Update Data Event";        
        $post = PostEvent::findOrFail($id);
        return view('back-office.forms.form_edit_event', ['title' => $this->title, 'pagestitle' => $pagestitle, 'data' => $post, 'UIDuser' => $user->cekDataSessionUser()]);           
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
            'judul_acara' => 'required',
            'tempat' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'materi' => 'required',
        ];

        $messages = [
            'judul_acara.required' => 'Field \':attribute\' tidak boleh kosong',
            'tempat.required' => 'Field \':attribute\' tidak boleh kosong',
            'tanggal_mulai.required' => 'Field \':attribute\' tidak boleh kosong',
            'tanggal_selesai.required' => 'Field \':attribute\' tidak boleh kosong',
            'materi.required' => 'Field \':attribute\' tidak boleh kosong',
        ];     

        $this->validate($request, $rules, $messages);   

        $data = array(
            'updated_at' => Carbon::now(),
            'updated_by' => $request->updated_by,
            'judul_acara' => $request->judul_acara,
            'tempat' => $request->tempat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_selesai,
            'materi' => $request->materi,
        );

        $query = PostEvent::find($id)->update($data);

        if($query):
            Alert::toast('Tambah Data Event Berhasil', 'success');
            return redirect()->route('post-event');
        else:
            Alert::toast('Tambah Data Event Gagal.!', 'error');
            return redirect()->route('post-event');
        endif;             
    }

    public function updatePublish(Request $request, $id)
    {         
        $result = PostEvent::findOrFail($id);
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

        $query = PostEvent::find($id)->update($data);       

        if($query):
            Alert::toast('Update Status Post Data Event Berhasil', 'success');
            return redirect()->route('post-event');
        else:
            Alert::toast('Update Status Post Data Event Gagal.!', 'error');
            return redirect()->route('post-event');
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
        $post = PostEvent::find($id);
        $query = $post->forceDelete();

        if($query):
            Alert::toast('Berhasil Hapus Data Event', 'success');
            return redirect()->route('post-event');
        else:
            Alert::toast('Gagal Hapus Data Event.!', 'error');
            return redirect()->route('post-event');
        endif;            
    }

    public function getDatatablesJsonFront()
    {
        $data = DB::table('post_event')
            ->select([
                'post_event.id_event',
                'post_event.judul_acara',
                'post_event.tempat',
                'post_event.tanggal_mulai',
                'post_event.tanggal_akhir',
                'post_event.materi',
            ])
            ->where('is_publish', 1)
            ->orderBy('post_event.id_event', 'DESC')
            ->get();
        
        return DataTables::of($data)                         
            ->addColumn('materi', function($data){
                $materi = $data->materi;   
                return $materi;            
            })  
            ->editColumn('tanggal_mulai', function($data){ $tanggal_mulai = date("d/m/Y", strtotime($data->tanggal_mulai));return $tanggal_mulai; }) 
            ->editColumn('tanggal_akhir', function($data){ $tanggal_akhir = date("d/m/Y", strtotime($data->tanggal_akhir)); return $tanggal_akhir; })                                           
            ->rawColumns(['materi'])
            ->toJson();

    }

    public function getDatatablesJson()
    {
        $data = DB::table('post_event')
            ->join('users', 'users.uid', '=', 'post_event.created_by')
            ->select([
                'post_event.id_event',
                'users.name',
                'users.uid',
                'post_event.judul_acara',
                'post_event.tempat',
                'post_event.tanggal_mulai',
                'post_event.tanggal_akhir',
                'post_event.materi',
                'post_event.is_publish',
                'post_event.published_at',
                'post_event.created_at',
                'post_event.created_by',
                'post_event.updated_at',
                'post_event.updated_by',
            ])
            ->orderBy('post_event.id_event', 'DESC')
            ->get();
        
        return DataTables::of($data)
            ->addColumn('update', function($data){
                $route_update = route('event.edit', ['id' =>$data->id_event]);
                $updated = "<a href='$route_update' title='Update Data'><button type='button' class='btn btn-icon btn-round btn-warning btn-xs'><i class='fas fa-edit'></i></button></a>";    
                
                return $updated;           
            })
            ->addColumn('delete', function($data){
                $route_delete = route('event.delete', ['id' =>$data->id_event]);
                $deleted = "<a href='$route_delete' class='hard-delete-confirm' title='Delete Data'><button type='button' class='btn btn-icon btn-round btn-danger btn-xs'><i class='fas fa-trash-alt'></i></button></a>";
  
                return $deleted;            
            })
            ->addColumn('publish', function($data){
                $route_publish = route('event.publish', ['id' =>$data->id_event]);
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
            ->addColumn('materi', function($data){
                $materi = $data->materi;   
                return $materi;            
            })  
            ->editColumn('tanggal_mulai', function($data){ $tanggal_mulai = date("d/m/Y", strtotime($data->tanggal_mulai));return $tanggal_mulai; }) 
            ->editColumn('tanggal_akhir', function($data){ $tanggal_akhir = date("d/m/Y", strtotime($data->tanggal_akhir)); return $tanggal_akhir; })                             
            // ->editColumn('tanggal_mulai', function($data){ $formatedDateStart = Carbon::createFromFormat('Y-m-d H:i:s', $data->tanggal_mulai)->format('d-F-Y'); return $formatedDateStart; })               
            // ->editColumn('tanggal_akhir', function($data){ $formatedDateFinish = Carbon::createFromFormat('Y-m-d H:i:s', $data->tanggal_akhir)->format('d-F-Y'); return $formatedDateFinish; })               
            ->rawColumns(['update', 'delete', 'publish', 'materi'])
            ->toJson();

    }

}
