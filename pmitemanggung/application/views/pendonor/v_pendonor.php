<link href="<?php echo base_url('assets/assets/css/jquery.dataTables.min.css');?>" rel="stylesheet" />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Pendonor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pendonor</li>
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
            <div class="row">
              <h1>
              <button type="button" class="btn btn-success" onClick="open_container();" data-toggle="modal" data-target="#modal-success">
                Add Pendonor
              </button>
              </h1>
            </div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor</th>
                        <th>Nama Pendonor</th>
                        <th>Alamat</th>
                        <th>Golongan Darah</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>
            </table>

            <br>
            <br>
            <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>

            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th style="width:125px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
    
                <tfoot>
                  <tr>
                      <th>Nomor</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>Tanggal Lahir</th>
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
<div class="modal fade bs-example-modal-lg" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="pendonorId"/> 
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
                            <label class="control-label col-md-3">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <select name="pendonorGender" class="form-control">
                                    <option value="">--Select Gender--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <textarea name="pendonorAddress" placeholder="Alamat" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Lahir</label>
                            <div class="col-md-9">
                                <input name="pendonorBirthDate" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Golongan Darah</label>
                            <div class="col-md-9">
                                <?php
                                $style0='class="form-control input-sm"';
                                $value = 'value=""';
                                $tests = $this->mGolongandarah->get_data();
                                $options = array('' => 'Select One...');
                                foreach($tests as $test) {
                                    $options[$test->comGolonganDarahId] = $test->comGolonganDarahName;
                                }
                                echo form_dropdown('pendonorGolonganDarah', $options, '', $style0); 
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
              "url": "<?php echo site_url('pendonor/person_ajax_list') ?>",
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

  function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}
 
function edit_person(pendonorId)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('pendonor/ajax_edit/')?>/" + pendonorId,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="pendonorId"]').val(data.pendonorId);
            $('[name="pendonorNo"]').val(data.pendonorNo);
            $('[name="pendonorName"]').val(data.pendonorName);
            $('[name="pendonorGender"]').val(data.pendonorGender);
            $('[name="pendonorAddress"]').val(data.pendonorAddress);
            $('[name="pendonorBirthDate"]').datepicker('update',data.pendonorBirthDate);
            $('[name="pendonorGolonganDarah"]').val(data.comGolonganDarahName);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('pendonor/ajax_add')?>";
    } else {
        url = "<?php echo site_url('pendonor/ajax_update')?>";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('pendonor/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

  </script>

  <script type="text/javascript"> 
  
  $(document).ready(function(){
    tampil_data_barang();   //pemanggilan fungsi tampil barang.
    
    $('#mydata').dataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "pagingType": "full_numbers",
      "paging": true,
      "oLanguage": {
      "sProcessing": "<img src='<?php echo base_url(); ?>assets/img/bx_loader.gif'>"
      }, 
    });
      
    //fungsi tampil barang
    function tampil_data_barang(){
        $.ajax({
            type  : 'ajax',
            url   : '<?php echo site_url('pendonor/data_pendonor'); ?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                var no = 1;
                for(i=0; i<data.length; i++){
                    html += '<tr>'+
                            '<td>'+no+'</td>'+
                            '<td>'+data[i].pendonorNo+'</td>'+
                            '<td>'+data[i].pendonorName+'</td>'+
                            '<td>'+data[i].pendonorAddress+'</td>'+
                            '<td>'+data[i].comGolonganDarahName+'</td>'+
                            '<td style="text-align:right;">'+
                                '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+data[i].barang_kode+'">Edit</a>'+' '+
                                '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="'+data[i].barang_kode+'">Hapus</a>'+
                            '</td>'+
                            '</tr>';
                            no++;
                }
                $('#show_data').html(html);
            }

        });
    }
  });
</script>

<script language="javascript">
  function open_container(){
    // var size=document.getElementById(' ').value;
    var size = 'standart';
    var content = '<form role="form"><div class="form-group"><label for="exampleInputEmail1">Email address</label><input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"></div><div class="form-group"><label for="exampleInputPassword1">Password</label><input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"></div><div class="form-group"><label for="exampleInputFile">File input</label><input type="file" id="exampleInputFile"><p class="help-block">Example block-level help text here.</p></div><div class="checkbox"><label><input type="checkbox"> Check me out</label></div><button type="submit" class="btn btn-default">Submit</button></form>';
    var title = 'My dynamic modal dialog form with bootstrap';
    var footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary">Save changes</button>';
    setModalBox(title,content,footer,size);
      $('#myModal').modal('show');
  }
    
  function setModalBox(title,content,footer,$size){
    document.getElementById('modal-bodyku').innerHTML=content;
    document.getElementById('myModalLabel').innerHTML=title;
    document.getElementById('modal-footerq').innerHTML=footer;
    // if($size == 'large')
    // {
    //   $('#myModal').attr('class', 'modal fade bs-example-modal-lg')
    //       .attr('aria-labelledby','myLargeModalLabel');
    //   $('.modal-dialog').attr('class','modal-dialog modal-lg');
    // }
    if($size == 'standart')
    {
      $('#myModal').attr('class', 'modal fade')
          .attr('aria-labelledby','myModalLabel');
      $('.modal-dialog').attr('class','modal-dialog');
    }
    // if($size == 'small')
    // {
    //   $('#myModal').attr('class', 'modal fade bs-example-modal-sm')
    //       .attr('aria-labelledby','mySmallModalLabel');
    //   $('.modal-dialog').attr('class','modal-dialog modal-sm');
    // }
  }
 </script>