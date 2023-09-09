@php
    if(empty(Session::get('csirtsso'))):
        $avatar = CSIRTHelper::csirt_asset('assets/back-office/assets/img/profile.jpg');
        $nama = NULL;
        $email = NULL;
        $jabatan = NULL;
    else:
        if(empty(Session::get('csirtsso')['avatar'])):
            $avatar = CSIRTHelper::csirt_asset('assets/back-office/assets/img/profile.jpg');
        else:
            $avatar = 'https://akun.bappenas.go.id/bp-um/avatar/'.Session::get('csirtsso')['avatar'];
        endif;
        
        $nama = Session::get('csirtsso')['nama'];
        $email = Session::get('csirtsso')['email'];
        $jabatan = Session::get('csirtsso')['jabatan'];
    endif;
@endphp

<!-- Modal -->
<div class="modal fade" id="modalProfil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    My Profile</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Nama</label>
                                <span>{{ $nama }}</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Email</label>
                                <span>{{ $email }}</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Jabatan</label>
                                <span>{{ $jabatan }}</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>    

    <!--   Core JS Files   -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/core/jquery.3.2.1.min.js')}}"></script>
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/core/popper.min.js')}}"></script>
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>


    <!-- Chart JS -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/chart.js/chart.min.js')}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/datatables/datatables.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Atlantis JS -->
    <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/atlantis.min.js')}}"></script>

    <!-- CK-Editor -->
    <script src="{{CSIRTHelper::csirt_asset('assets/general/ckeditor/ckeditor.js')}}"></script>

    <!-- <script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/moment.min.js')}}"></script> -->

    <!-- Datepicker Js -->
    <script src="{{CSIRTHelper::csirt_asset('assets/general/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <!-- Laravel File Manager Js -->
    <script src="{{CSIRTHelper::csirt_asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>