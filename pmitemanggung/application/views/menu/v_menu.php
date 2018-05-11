   <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/DataTables/datatables.min.css"/>
 
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>  -->

  <!-- Content Wrapper. Contains page content -->
  <link href="<?php echo base_url('assets/assets/css/jquery.dataTables.min.css');?>" rel="stylesheet" />
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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
            <!-- <div class="card-header">
              <h3 class="card-title">Hover Data Table</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
            <!-- <table id="book-table2" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <td>Menu</td>
                        <td>URL</td>
                        <td>Icon</td>
                        <td>Is Parent</td>
                    </tr>
                </thead>
                <tbody>
            </tbody>
            </table> -->
            <table id="example2" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>MENU</th>
                        <th>URL</th>
                        <th>ICON</th>
                        <th>Is Parent</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>MENU</th>
                        <th>URL</th>
                        <th>ICON</th>
                        <th>Is Parent</th>
                    </tr>
                </tfoot>
            </table>
            <br>
            <br>

            <table id="table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr><th>FOTO</th><th>FIRSTNAME</th><th>LASTNAME</th><th>OFFICE</th><th>STARTDATE</th><th>ACTION</th></tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <br>

            <br>
            
            <div class="row">
                <h1 class="page-header">
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah Barang</a></div>
                </h1>
            </div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  		<!-- MODAL ADD -->
        <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Barang</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kode Barang</label>
                        <div class="col-xs-9">
                            <input name="kobar" id="kode_barang" class="form-control" type="text" placeholder="Kode Barang" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Barang</label>
                        <div class="col-xs-9">
                            <input name="nabar" id="nama_barang" class="form-control" type="text" placeholder="Nama Barang" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Harga</label>
                        <div class="col-xs-9">
                            <input name="harga" id="harga" class="form-control" type="text" placeholder="Harga" style="width:335px;" required>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_simpan">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->
  
  <script src="<?php echo base_url('assets/assets/js/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('assets/assets/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/assets/js/jquery.dataTables.min.js');?>"></script>
  <script type="text/javascript"> 
        $(document).ready(function(){
          tampil_data_barang();   //pemanggilan fungsi tampil barang.
          
          $('#mydata').dataTable();
            
          //fungsi tampil barang
          function tampil_data_barang(){
              $.ajax({
                  type  : 'ajax',
                  url   : '<?php echo site_url('menu/data_barang'); ?>',
                  async : false,
                  dataType : 'json',
                  success : function(data){
                      var html = '';
                      var i;
                      for(i=0; i<data.length; i++){
                          html += '<tr>'+
                                  '<td>'+data[i].barang_kode+'</td>'+
                                  '<td>'+data[i].barang_nama+'</td>'+
                                  '<td>'+data[i].barang_harga+'</td>'+
                                  '<td style="text-align:right;">'+
                                      '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+data[i].barang_kode+'">Edit</a>'+' '+
                                      '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="'+data[i].barang_kode+'">Hapus</a>'+
                                  '</td>'+
                                  '</tr>';
                      }
                      $('#show_data').html(html);
                  }
  
              });
          }
        });




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
                    "url": '<?php echo site_url('menu/json'); ?>',
                    "type": "POST"
                },
                //Set column definition initialisation properties.
                "columns": [
                    {"data": "foto", width:100},
                    {"data": "first_name",width:170},
                    {"data": "last_name",width:100},
                    {"data": "office",width:100},
                    {"data": "start_date",width:100},
                    {"data": "action", width:100}
                ],

            });

        });
    </script>
  <!-- <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script> -->
 <!-- <script type="text/javascript">
    $(document).ready(function(){
        $('#book-table2').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "pagingType": "full_numbers",
            "paging": true,
            "aaSorting": [[ 0, "asc"]],
            "lengthMenu": [10, 25, 50, 75, 100],
            "ajax": {
                "url": '<?php echo base_url('menu/menus_page'); ?>',
                "type": "GET"
            },
            columns: [
                { "data": "menu" },
                { "data": "url" },
                { "data": "icon_nav" },
                { "data": "isParent" }
            ],
            "order": [[1, 'asc']],
            })
    });
</script>  -->

<script>
 /**
  * Gunaknan ini jika TIDAK ingin menggunakan pencarian perkolom
  */
  // $(document).ready(function() {
  //    $('#example').DataTable({
  //        "processing": true,
  //        "serverSide": true,
  //        "ajax": {
  //            "url": "<?php echo base_url('Menu/datatables_ajax');?>",
  //            "type": "POST"
  //        }
  //    });
  //  });
    
  
  /**
   * Gunaknan ini jika ingin menggunakan pencarian perkolom 
   */
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example2 tfoot th').each( function () {
        var title = $(this).text();
        var inp   = '<input type="text" class="form-control" placeholder="Search '+ title +'" />';
        $(this).html(inp);
    } );
 
    // DataTable
    var table = $('#example2').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "pagingType": "full_numbers",
                    "paging": true,
                    "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url(); ?>assets/img/bx_loader.gif'>"
                    },      
                    "ajax": {
                        "url": "<?php echo base_url('Menu/datatables_ajax');?>",
                        "type": "POST"
                    }
                });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
  </script>