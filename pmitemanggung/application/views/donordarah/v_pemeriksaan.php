<link href="<?php echo base_url('assets/assets/css/jquery.dataTables.min.css');?>" rel="stylesheet" />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Pemeriksaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pemeriksaan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">          
            <div class="card-body">
            
            <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Periksa</button>
            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>

            <br>
            <br>

            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                     <tr>
                        <th>No</th>
                        <th>Nomor Pendonor</th>
                        <th>Nama</th>  
                        <th>Tanggal Periksa</th>
                        <th>Tensi</th>
                        <th>Suhu</th>
                        <th>Riwayat Medis</th>
                        <th>Keputusan</th>
                        <th style="width:125px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
    
                <tfoot>
                  <tr>
                         <th>Nomor</th>
                        <th>Nama</th> 
                        <th>Tanggal Periksa</th>
                        <th>Tensi</th>
                        <th>Suhu</th>
                        <th>Riwayat Medis</th>
                        <th>Keputusan</th>
                        <th>Action</th>
                  </tr>
                </tfoot>
            </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="periksaId"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor Pendonor</label>
                            <div class="col-md-9">
                                <input name="pendonorNo" placeholder="No Pendonor" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="pendonorName" placeholder="Nama Pendonor" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Pemeriksaan</label>
                            <div class="col-md-9">
                                <input name="periksaTanggal" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tensi</label>
                            <div class="col-md-9">
                                <input name="periksaTensi" placeholder="Tensi" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Suhu</label>
                            <div class="col-md-9">
                                <input name="periksaSuhu" placeholder="Suhu" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Berat Badan</label>
                            <div class="col-md-9">
                                <input name="periksaBerarBadan" placeholder="Berat Badan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Riwayat Medis</label>
                            <div class="col-md-9">
                                <input name="periksaRiwayatMedis" placeholder="Riwayat Medis" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Golongan Darah</label>
                            <div class="col-md-9">
                                <?php
                                $style0='class="form-control input-sm"';
                                $value = 'value=""';
                                $options = $this->mPeriksa->get_enum('periksa', 'periksaKeputusan');
                                $firstItem[''] = '<option>Please select one...</option>';
                                $options = array_merge($firstItem, $options);
                                echo form_dropdown('pemeriksaan', $options, '', $style0); 
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
  

 <script src="<?php echo base_url('assets/assets/js/jquery.min.js');?>"></script> 
  <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>  
 <script src="<?php echo base_url('assets/assets/js/jquery.dataTables.min.js');?>"></script> 
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
 <script type="text/javascript"> 

  var save_method; //for save method string
  var table;
  
  $(document).ready(function() {
  
      //datatables
      table = $('#table').DataTable({ 
  
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.
          "pagingType": "full_numbers",
          "paging": true,
          "oLanguage": {
          "sProcessing": "<img src='<?php echo base_url(); ?>assets/img/bx_loader.gif'>"
          },
  
          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": "<?php echo site_url('pemeriksaanpendonor/periksa_ajax_list') ?>",
              "type": "POST"
          },
  
          //Set column definition initialisation properties.
          "columnDefs": [
          { 
              "targets": [ -1 ], //last column
              "orderable": false, //set not orderable
          },
          ],
  
      });
      
      //datepicker
      $('.datepicker').datepicker({
          autoclose: true,
          format: "yyyy-mm-dd",
          todayHighlight: true,
          orientation: "top auto",
          todayBtn: true,
          todayHighlight: true,  
      });
  
      //set input/textarea/select event when change value, remove class error and remove text help block 
      $("input").change(function(){
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
      });
      $("textarea").change(function(){
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
      });
      $("select").change(function(){
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
      });
  
  });
</script>
