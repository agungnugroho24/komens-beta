<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class AdministrasiUserController extends Controller
{
    protected $title = "Halaman Administrasi User";
    protected $segment = "Administrasi User";    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office.pages.administrasi_user_bo', ['title' => $this->title, 'segment' => $this->dataSegment()]);
    }

    public function dataSegment()
    {
        $linksegment = route('administrasi-user');
        $datasegment = [
            'segment' => $this->segment,
            'linksegment' => $linksegment,
        ];
        return $datasegment;
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

    public function dataProfile()
    {
        $query = User::where('uid', 'muharam.aram')->firstOrFail();
        return $query;
    }
    
    public function cekDataSessionUser()
    {
        $sessionUser = Session::get('csirtssodev');
        if(empty($sessionUser)):
            $UIDUser = null;
        else:
            $UIDUser = Session::get('csirtssodev')['username'];
        endif;
        
        return $UIDUser;
    }

    public function cekDataApproveUser()
    {
        $UIDUser = Session::get('csirtssodev')['username'];
        $query = User::where('uid', $UIDUser)->firstOrFail();
      
        if(!empty($query)):
            $is_approved = $query->is_approved;
        else:
            $is_approved = NULL;
        endif; 
        
        return $is_approved;
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

    public function updateApproved(Request $request, $id)
    {         
        $result = User::findOrFail($id);
        if(!empty($result)):
            $approved = $result->is_approved;

            if($approved == 404):
                $dataapproved = 200;               
            else:
                $dataapproved = 404;             
            endif;
        endif; 

        $data = array(
            'is_approved' => $dataapproved,
        );          

        $query = User::find($id)->update($data);       

        if($query):
            Alert::toast('Update Status Approve Data User Berhasil', 'success');
            return redirect()->route('administrasi-user');
        else:
            Alert::toast('Update Status Approve Data User Gagal.!', 'error');
            return redirect()->route('administrasi-user');
        endif;        
    }    

    public function updateActive(Request $request, $id)
    {         
        $result = User::findOrFail($id);
        if(!empty($result)):
            $actived = $result->is_active;
            $dataapproved = $result->is_approved;              

            if($actived == 404):
                $dataactived = 200; 
                $dataapproved = $dataapproved;              
            else:
                $dataactived = 404;             
                $dataapproved = 404;              
            endif;
        endif; 

        $data = array(
            'is_active' => $dataactived,
            'is_approved' => $dataapproved,
        );          

        $query = User::find($id)->update($data);       

        if($query):
            Alert::toast('Update Status Aktivasi Data User Berhasil', 'success');
            return redirect()->route('administrasi-user');
        else:
            Alert::toast('Update Status Aktivasi Data User Gagal.!', 'error');
            return redirect()->route('administrasi-user');
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
        //
    }

    public function getDatatablesJson()
    {
        $data = DB::table('users')
            ->select([
                'users.id',
                'users.name',
                'users.uid',
                'users.email',
                'users.nip',
                'users.jabatan',
                'users.iduke',
                'users.nama_uke',
                'users.is_approved',
                'users.is_active',
            ])
            ->orderBy('users.id', 'DESC')
            ->get();
        
        return DataTables::of($data)
            ->addColumn('approved', function($data){
                 $route_approved = route('administrasi-user.approved', ['id' =>$data->id]);

                if($data->is_approved == 200):
                    $approved = "<a href='$route_approved' title='Klik untuk membatalkan persetujuan pengguna'><button type='button' class='btn btn-icon btn-round btn-success btn-xs'><i class='fas fa-stamp'></i></button</a>";
                else:
                    $approved = "<a href='$route_approved' title='Klik untuk menyetujui pengguna'><button type='button' class='btn btn-icon btn-round btn-danger btn-xs'><i class='fas fa-stamp'></i></button></a>";
                endif;                     
                
                return $approved;           
            })
            ->addColumn('active', function($data){
                $route_actived = route('administrasi-user.active', ['id' =>$data->id]);

                if($data->is_active == 200):
                    $active = "<a href='$route_actived' title='Klik untuk non-aktifkan pengguna'><button type='button' class='btn btn-icon btn-round btn-success btn-xs'><i class='fas fa-user-check'></i></button</a>";
                else:
                    $active = "<a href='$route_actived' title='Klik untuk aktifkan pengguna'><button type='button' class='btn btn-icon btn-round btn-danger btn-xs'><i class='fas fa-user-check'></i></button></a>";
                endif; 

  
                return $active;            
            })         
            ->rawColumns(['approved', 'active'])
            ->toJson();

    }

}
