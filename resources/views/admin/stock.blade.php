@extends('layouts.admin')

@section('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div id="controller">
      <div class="container">
        <div class="card">
            <div class="card-header">
              <a href="#" class="btn btn-primary" @click="addData()">Tambah Stok</a>
            </div>
            <div class="card-body">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 20px">No.</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Tanggal Input</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                
              </table>
            </div>
          </div>

          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <form :action="actionUrl" method="post" autocomplete="off" @submit="submitForm($event, data.id)">
                  <div class="modal-header">
                    <h4 class="modal-title">Produk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @csrf

                    <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                    <div class="form-group">
                        <label class="col-md-3">Nama Barang</label>
                        <select name="id_product" class="form-control" required="">
                            @foreach($products as $product)
                            <option :selected="data.id_product == {{ $product->id }}" value="{{ $product->id }} ">
                                {{ $product->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input type="number" class="form-control" name="qty" :value="data.qty" placeholder="Jumlah Tambahan" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
    </div>
    </div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script type="text/javascript">
  var actionUrl = '{{ url('stocks') }}';
  var apiUrl = '{{ url('api/stocks') }}';
  
  var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable: false},
    {data: 'products.name', class: 'text-center', orderable: true},
    {data: 'qty', class: 'text-center', orderable: true},
    {data: 'date', class: 'text-center', orderable: true},
    {render: function (index, row, data, meta) {
      return `
      
        <a href="#" class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">Delete</a>
      `;
    }, orderable: false, width: '200px', class: 'text-center'},
  ];
</script>
<script src="{{ asset('js/data.js')}}"></script>
@endsection