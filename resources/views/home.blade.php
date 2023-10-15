@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $total_user }}</sup></h3>

                <p>Jumlah User</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" onclick="alert('Info User belum tersedia!')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $total_category }}</h3>
  
                  <p>Kategori Barang</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ url('categories') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
          
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $total_product }}</h3>

                <p>Jumlah Product</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ url('products') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
          
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $total_transaction }}</h3>

                <p>Jumlah Transaksi</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ url('transactions') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Pie Chart</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
        </div>
    </div>


</div>
@endsection

@section('js')
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script>
    var label_donut = '{!! json_encode($label_pie) !!}';
    var data_pie = '{!! json_encode($data_pie) !!}';

    $(function () {
        var pieData        = {
        labels: JSON.parse(label_donut),
        datasets: [
            {
                data: JSON.parse(data_pie),
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
        ]}

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData        = pieData;
        
        var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }

        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })
    });
</script>
@endsection