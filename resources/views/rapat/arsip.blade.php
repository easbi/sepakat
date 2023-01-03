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
            <li class="breadcrumb-item active" aria-current="page">Arsip Rapat</li>
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
          <h4 class="card-title">Daftar Arsip Rapat</h4>
          <h6 class="card-subtitle">Diperoleh dari Rapat <code>yang telah selesai</code></h6>
          <div class="table-responsive">
            <table id="example" class="display responsive nowrap" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nama Rapat</th>
                  <th>Undangan</th>
                  <th>Daftar hadir</th>
                  <th>Notulen</th>
                  <th>Dokumentasi</th>
                  <th>Aksi</th>
                </tr>    
              </thead>
              <tbody>
                @foreach ($rapats as $rp)
                <tr>
                  <td class="text-center">{{ ++$i }}</td>
                  <td>{{ $rp->tgl }}</td>
                  <td>{{ $rp->nama_rapat }}</td>
                  <td>
                    @if( $rp->undangan != null )
                    <a href="{{  url('/public/rapat/undangan', $rp->undangan) }}">
                      <i class="mdi mdi-numeric-1-box-multiple-outline"></i>
                    </a>
                    @else
                      <a href="#">
                        <i class="mdi mdi-close-box" data-toggle="tooltip" title="Belum di upload!"></i>
                      </a>
                    @endif
                  </td>
                  <td>
                    @if( $rp->daftar_hadir != null )
                    <a href="{{  url('/public/rapat/daftar_hadir', $rp->daftar_hadir) }}">
                      <i class="mdi mdi-numeric-2-box-multiple-outline"></i>
                    </a>
                    @else
                      <a href="#">
                        <i class="mdi mdi-close-box" data-toggle="tooltip" title="Belum di upload!"></i>
                      </a>
                    @endif
                  </td>
                  <td>
                    @if( $rp->notulen != null )
                    <a href="{{  url('/public/rapat/notulen', $rp->notulen) }}">
                      <i class="mdi mdi-numeric-3-box-multiple-outline"></i>
                    </a>
                    @else
                      <a href="#">
                        <i class="mdi mdi-close-box" data-toggle="tooltip" title="Belum di upload!"></i>
                      </a>
                    @endif
                  </td>
                  <td>
                    @if( $rp->dokumentasi != null )
                      <a href="{{  url('/public/rapat/dokumentasi', $rp->dokumentasi) }}">
                        <i class="mdi mdi-numeric-4-box-multiple-outline"></i>
                      </a>
                    @else
                      <a href="#">
                        <i class="mdi mdi-close-box" data-toggle="tooltip" title="Belum di upload!"></i>
                      </a>
                    @endif
                  </td>
                  <td class="text-center">
                    @if (Auth::user()->id == 1)
                    <form action="{{route('rapat.destroy',$rp->id)}}" method="POST">

                      <a class="btn btn-primary btn-sm" href="{{ route('rapat.edit',$rp->id) }}">Edit</a>

                      @csrf
                      @method('DELETE')

                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                    @else
                      <a class="btn btn-primary btn-sm" href="{{ route('rapat.edit',$rp->id) }}">Edit</a>
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
