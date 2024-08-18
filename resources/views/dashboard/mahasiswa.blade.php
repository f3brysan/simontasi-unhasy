@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active"><span>Beranda</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg">
            <div class="row">
                {{-- START DAFTAR PROPOSAL --}}
                <div class="col-6 col-lg-6">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-primary text-white p-3 me-3">
                                <span class="fa fa-book"></span>
                            </div>
                            <div>
                                <div class="fs-6 fw-semibold text-primary">Sidang Proposal</div>
                                @if (isset($getProposal))
                                    <p class="text-info">Anda telah mendaftar Sidang Proposal</p>
                                    <p class="text-primary">{!! $getProposal->title !!}</p>
                                @else
                                    <p class="text-info">Anda Belum mendaftar Sidang Proposal</p>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2"><a
                                class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                                href="{{ URL::to('daftar/proposal') }}"><span
                                    class="small fw-semibold text-info">{{ isset($getProposal) ? 'Lihat Disini' : 'Daftar Disini' }}</span>
                                <span class="fa fa-chevron-right"></span></a></div>
                    </div>
                </div>
                {{-- END DAFTAR PROPOSAL --}}

                {{-- START DAFTAR SIDANG --}}
                <div class="col-6 col-lg-6">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-primary text-white p-3 me-3">
                                <span class="fa fa-book"></span>
                            </div>
                            <div>
                                <div class="fs-6 fw-semibold text-primary">Sidang Skripsi/TA/Tesis</div>
                                <p class="text-danger">Anda Belum mendaftar Sidang Proposal</p>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2"><a
                                class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                                href="{{ URL::to('daftar/sidang') }}"><span class="small fw-semibold">Daftar Disini</span>
                                <span class="fa fa-arrow"></span></a></div>
                    </div>
                </div>
                {{-- END DAFTAR SIDANG --}}

                {{-- START LOGBOOK --}}
            </div>
        </div>
    </div>
@endsection
