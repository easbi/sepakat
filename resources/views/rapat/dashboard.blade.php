@extends('layouts.template')
@section('content')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
   <div class="row align-items-center">
      <div class="col-md-6 col-8 align-self-center">
         <h3 class="page-title mb-0 p-0">Sepakat</h3>
         <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Rapat</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Daftar Rapat</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-12">
                     <div class="d-flex flex-wrap align-items-center">
                        <div>
                           <h3 class="card-title">Kuantitas Rapat</h3>
                           <h6 class="card-subtitle">Berdasarkan Bulan</h6>
                        </div>
                     </div>
                  </div>
                  <div class="col-12">
                     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
                     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
                     <div class="chart">
                        <canvas id="myChart1"></canvas>
                        <script>
                           var url = "{{url('rapat/chart')}}";
                           var Month = new Array();
                           var Labels = new Array();
                           var Count = new Array();
                           function toMonthName(monthNumber) {
                             const date = new Date();
                             date.setMonth(monthNumber - 1);
                           
                             return date.toLocaleString('en-US', {
                               month: 'long',
                             });
                           }
                               $(document).ready(function(){
                                 $.get(url, function(response){
                                   response.forEach(function(data){
                                       Month.push(data.bulan_tahun);
                                       Labels.push(data.year);
                                       Count.push(data.count);
                                   });
                                   var ctx = document.getElementById("myChart1").getContext('2d');
                                       var myChart = new Chart(ctx, {
                                         type: 'bar',
                                         data: {
                                             labels:Month,
                                             datasets: [{
                                                 label: 'Jumlah Rapat (kegiatan)',
                                                 data: Count,
                                                 backgroundColor: 'rgb(255, 99, 132)',
                                                 borderWidth: 1
                                             }]
                                         },
                                         options: {
                                             scales: {
                                                 yAxes: [{
                                                     ticks: {
                                                         beginAtZero:true
                                                     }
                                                 }]
                                             }
                                         }
                                     });
                                 });
                               });
                             
                        </script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End of Container fluid  -->
@endsection
@push('scripts')
<script type="text/javascript">
   $(document).ready(function() {
     $('#example').DataTable({
       "scrollX": true,
       responsive: true
     });
   } );
</script>
@endpush