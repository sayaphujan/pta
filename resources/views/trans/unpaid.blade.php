@extends('layouts.adminlte.layout')

@section('content')
<style type="text/css">
  .btn-secondary{
    background-color: transparent!important;
    margin: 5px;
  }

  .btn-excel:hover {
    color: #FFF!important;
    border-color: #28a745!important;
    background-color: #28a745!important;
    text-decoration: none;
  }

  .btn-pdf:hover {
    color: #FFF!important;
    border-color: #ffc107!important;
    background-color: #ffc107!important;
    text-decoration: none;
  }
</style>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Data Transaksi Belum Terbayar') }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-sm-12 col-md-8">
                       @if ($message = Session::get('success'))
                          <div class="alert alert-success" role="alert">
                            {{ $message }}
                          </div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-4">
                        &nbsp;
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row mt-3">
                      <div class="col-sm-12">
                        <div class="table-responsive">
                          <table id="tb_user" class="table table-bordered table-hover dataTable dtr-inline collapsed" aria-describedby="tb_user_info" width="100%">
                            <thead>
                              <tr>
                                <th class="sorting">No</th>
                                <th class="sorting">Kode Transaksi</th>
                                <th class="sorting">Nama Pemohon</th>
                                <th class="sorting">No. Telepon</th>
                                <th>Pembayaran</th>
                                <th>Verifikasi</th>
                                <th>Pengiriman</th>
                                <th>Action</th>
                              </tr> 
                            </thead>
                            <tbody>
                            </tbody> 
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
<script src="{{ asset( 'assets/js/jquery-1.9.1.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function () {   
    setTimeout(() => {
      //$('.alert').attr('style','display:none');
      $('.alert').hide(1000);
    }, 1000); // 👈️ time in milliseconds

    var isAdmin = {{ Auth::user()->level }};
    var i=1;
    $('#tb_user').DataTable({
         /*"dom": 'Bfrtip',
                    "buttons": [
                        //'copyHtml5',
                        //'excelHtml5',
                        //'csvHtml5',
                        //'pdfHtml5',
                        {
                            "extend": 'pdf', 
                            "className": 'btn btn-outline-warning btn-pdf',
                            "text": '<i class=\'fa fa-file-pdf\'></i> Eport Pdf',
                            "titleAttr": 'PDF',
                            "exportOptions": {
                                columns: [ 0, 1, 2, 3, 4, 5, 6]
                            },
                            "action": newexportaction
                        },
                        {
                            "extend": 'excel',
                            "className": 'btn btn-outline-success btn-excel',
                            "text": '<i class=\'fa fa-file-excel\'></i> Export Excel',
                            "titleAttr": 'Excel',
                            "exportOptions": {
                                columns: [ 0, 1, 2, 3, 4, 5, 6]
                            },
                            "action": newexportaction
                        },
                    ],*/
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "order": [[0, 'desc']],
        ajax: "{{ route('trans.unpaid') }}",
        responsive: {
          details: {
            type: 'column'
          }
        },
        columns: [
            //{data: 'id', render: function( data, type, row, meta ) {
            //  return i++;
            //},name: 'id'},
            {data: 'trans_id', name: 'trans_id'},
            {data: 'order_id', name: 'order_id'},
            {data: 'fullname', name: 'fullname'},
            {data: 'trans_phone', name: 'trans_phone'},
            {data: 'payment_photo', render: function ( data, type, row, meta ) {
                if(row.payment == 'Tunai' || row.payment_photo != null)   
                {
                  return '<span class="badge bg-success">Terbayar</span>';    
                }
                else if(row.payment_photo == null)   
                {
                  return '<span class="badge bg-danger">Belum Terbayar</span>'; 
                }

            }, name: 'payment_photo'},
            {data: 'payment_status', render: function ( data, type, row, meta ) {
                if(row.payment == 'Tunnai' || row.payment_status == '1')   
                {
                  return '<span class="badge bg-info">Terverifikasi</span>';    
                }
                else if(row.payment_status == '0')   
                {
                  return '<span class="badge bg-danger">Belum Terverifikasi</span>'; 
                }
            }, name: 'payment_status'},
            {data: 'trans_delivery', render: function ( data, type, row, meta ) {
              if(row.trans_delivery == '0')   
                {
                  if(isAdmin == 4){
                    return '<a class="delete" href="trans/delivery_send/'+row.trans_id+'" onclick="return confirm(\'Terkirim?\')" style="color:#dc3545"><span class="badge bg-danger">Belum Terkirim</span></a>';
                  }else{
                    return '<span class="badge bg-danger">Belum Terkirim</span>';    
                  }
                }
                else if(row.trans_delivery == '1' && row.trans_sent == '0')   
                {
                     return '<span class="badge bg-info">Terkirim</span>';    
                }
                else if(row.trans_delivery == '1' && row.trans_sent == '1')   
                {
                     return '<span class="badge bg-warning">Pesanan Telah Diterima</span>';    
                }
            }, name: 'trans_delivery'},

            {data: 'action', render: function ( data, type, row, meta ) {
              if(row.trans_destination == 'Pengambilan Sendiri')    
                {
                  return  '<div style="text-align: center">' + 
                          '<a class="show" href="trans/detail/'+row.order_id+'" style="color:#17a2b8"><i class="fas fa-eye" title="Detail"></i></a></div>';
                }
                else if(row.payment_status == '0' && row.payment_photo == '')   
                {
                  if(isAdmin == 3){
                   return  '<div style="text-align: center">' + 
                          '<a class="show" href="trans/detail/'+row.order_id+'/#bukti" style="color:#17a2b8"><span class="badge bg-danger">Upload Bukti Pembayaran</span></a></div>';
                  }else if(isAdmin == 1){
                      return  '<div style="text-align: center">' + 
                          '<a class="show" href="trans/detail/'+row.order_id+'/#verifikasi" style="color:#17a2b8"><span class="badge bg-danger">Verifikasi</span></a></div>';
                  }else{
                    return  '<div style="text-align: center">' + 
                          '<a class="show" href="trans/detail/'+row.order_id+'" style="color:#17a2b8"><i class="fas fa-eye" title="Detail"></i></a></div>';
                  }
                }
                else
                {
                return  '<div style="text-align: center">' + 
                          '<a class="show" href="trans/detail/'+row.order_id+'" style="color:#17a2b8"><i class="fas fa-eye" title="Detail"></i></a></div>';    
                }
            }, name: 'action', orderable: false, searchable: false},
        ],
        createdRow: function ( row, data, index ) {
                    $('td', row).eq(4).addClass('text-right');
                }
    });
     
  });
</script>
@endsection
