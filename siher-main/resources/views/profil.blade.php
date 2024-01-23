@extends('layout.BaseView',['title'=>''.$u->fname.' | Sistem Heregistarsi Mahasiswa'])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>{{$u->fname}}</h3>
    </div>
    <section class="section">
        <div class="row flex-lg-nowrap">
            <div class="col">
                <div class="row">
                    @if (session()->has('pesan'))
                    {!!session()->get('pesan')!!}
                    @endif
                    <div class="col mb-3">
                        <div class="card">
                            <form class="form" action="/profil/simpan/{{$u->nim}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <div class="card-body">
                                <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                            <div class="mx-auto" style="width: 140px;">
                                                <div class="d-flex justify-content-center align-items-center rounded"
                                                    style="height: 140px;">
                                                    <img id="output" src="{{asset('images/avatar/'.$u->avatar)}}"
                                                        class="img-fluid" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{Auth::user()->fname." ".Auth::user()->lname}}</h4>
                                                <p class="mb-0">{{Auth::user()->email}}</p>
                                                <div class="text-muted"><small>{{Auth::user()->created_at->diffForHumans()}}</small></div>
                                                <div class="mt-2">
                                                    <input type="file" accept="image/*" name="avatar" onchange="loadFile(event)">
                                                </div>
                                            </div>
                                            <div class="text-center text-sm-right">
                                                <span class="badge badge-secondary">{{Auth::user()->role}}</span>
                                                <div class="text-muted"><small>Joined {{Auth::user()->created_at->format('d M Y')}}</small></div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                                    </ul>
                                    <div class="tab-content pt-3">
                                        <div class="tab-pane active">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 mb-3">
                                                        <div class="mb-2"><b>Change Password</b></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>New Password</label>
                                                                    <input class="form-control" type="password"
                                                                        placeholder="••••••" name="password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                                                        <div class="mb-2"><b>Catatan</b></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <ul>
                                                                    <li>Pastikan kamu sudah membaca format foto yang diterima</li>
                                                                    <li>Lengkapi Password jika ingin mengganti password kamu</li>
                                                                    <li>Jika terdapat kesalahan data diri silahkan hubungi Administrator terkait</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col d-flex justify-content-end">
                                                        <button class="btn btn-primary" type="submit">Save
                                                            Changes</button>
                                                    </div>
                                                </div>
                                            </form>
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
<script>
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

</script>
@endsection
