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
    <div class="col-lg-12 col-xlg-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Daftar Agenda Rapat</h4>
          <h6 class="card-subtitle">Rapat yang sudah dan <code>yang akan berlangsung</code></h6>
          <div class="table-responsive">
            <table id="example" class="display responsive nowrap" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nama Rapat</th>
                  <th>Tempat</th>
                  <th>Pimpinan Rapat</th>
                  <th>Aksi</th>
                </tr>    
              </thead>
              <tbody>
                @foreach ($rapats as $rp)
                <tr>
                  <td class="text-center">{{ ++$i }}</td>
                  <td>{{ $rp->tgl }}</td>
                  <td>{{ $rp->nama_rapat }}</td>
                  <td>{{ $rp->tempat  }}</td>
                  <td>{{ $rp->nama_pimpinan }}</td>

                  <td class="text-center">
                    @if (Auth::user()->id == 1)
                    <form action="{{route('rapat.destroy',$rp->id)}}" method="POST">

                      <a class="btn btn-primary btn-sm" href="{{ route('rapat.edit',$rp->id) }}">Edit</a>

                      @csrf
                      @method('DELETE')

                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>

                    </form>
                    @else
                    <a class="btn btn-primary btn-sm" href="{{ route('rapat.edit',$rp->id) }}">Lengkapi</a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>        
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
