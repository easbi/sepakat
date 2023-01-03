@extends('layouts.template')

@section('content')
<!-- Content -->

<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
	<div class="row align-items-center">
		<div class="col-md-6 col-8 align-self-center">
			<h3 class="page-title mb-0 p-0">Sepakat</h3>
			<div class="d-flex align-items-center">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Rapat</a></li>
						<li class="breadcrumb-item active" aria-current="page">Update Konten Rapat</li>
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
					<form method="POST" action="{{ route('rapat.update', $rapat->id) }}" enctype="multipart/form-data" class="form-horizontal form-material mx-2">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label class="col-md-12 mb-0"><b>Nama Rapat</b></label>
							<div class="col-md-12">
								<input type="text" name="nama_rapat" value="{{ $rapat->nama_rapat }}" required
								class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12 mb-0">Tanggal</label>
							<div class="col-md-12">
								<input type="date" name="tgl" value="{{ $rapat->tgl }}" required class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12 mb-0">Waktu</label>
							<div class="col-md-12">
								<input type="time" name="waktu" value="{{ $rapat->waktu }}" required class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12 mb-0">Tempat</label>
							<div class="col-md-12">
								<input type="text" name="tempat" value="{{ $rapat->tempat }}" required class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12 mb-0">Pimpinan Rapat</label>
							<div class="col-md-12">
								<input type="text" name="pimpinan_rapat" value="{{ $rapat->pimpinan_rapat }}" required class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12 mb-0">Notulis</label>
							<div class="col-md-12">
								<input type="text" name="notulis" value="{{ $rapat->notulis }}" required class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12 mb-0">Undangan Rapat</label>
							<div class="col-md-12">
								<input type="file" name="undangan" value="{{ $rapat->undangan }}" class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12 mb-0">Daftar Hadir (Scan)</label>
							<div class="col-md-12">
								<input type="file" name="daftar_hadir" class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12 mb-0">Hasil Notulen</label>
							<div class="col-md-12">
								<input type="file" name="notulen" class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12 mb-0">Dokumentasi</label>
							<div class="col-md-12">
								<input type="file" name="dokumentasi" class="form-control ps-0 form-control-line">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 d-flex">
								<button type="submit" class="btn btn-success mx-auto mx-md-0 text-white" >Kirim</button>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- End of Container fluid  -->




<!-- End of Content -->

@endsection
