<div class="col">
        <div class="card card-statistic">
            <div class="card-body p-0">
                <div class="d-flex flex-column">
                    <div class='px-3 py-3 d-flex justify-content-between'>
                        <h3 class='card-title'>Total Mahasiswa</h3>
                        <div class="card-right d-flex align-items-center">
                            <p>{{$query->count()}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<div class="row mb-2">
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body p-0">
                <div class="d-flex flex-column">
                    <div class='px-3 py-3 d-flex justify-content-between'>
                        <h3 class='card-title'>Terdaftar Pada Sistem</h3>
                        <div class="card-right d-flex align-items-center">
                            <p>{{$terdaftar->count()}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body p-0">
                <div class="d-flex flex-column">
                    <div class='px-3 py-3 d-flex justify-content-between'>
                        <h3 class='card-title'>Proses Verifikasi</h3>
                        <div class="card-right d-flex align-items-center">
                            <p>{{$verifikasi->count()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body p-0">
                <div class="d-flex flex-column">
                    <div class='px-3 py-3 d-flex justify-content-between'>
                        <h3 class='card-title'>Heregistrasi Sukses</h3>
                        <div class="card-right d-flex align-items-center">
                            <p>{{$sukses->count()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body p-0">
                <div class="d-flex flex-column">
                    <div class='px-3 py-3 d-flex justify-content-between'>
                        <h3 class='card-title'>Heregistrasi Gagal</h3>
                        <div class="card-right d-flex align-items-center">
                            <p>{{$gagal->count()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>