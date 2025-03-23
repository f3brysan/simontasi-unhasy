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
            <div class="row mb-4">
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
                                    <p class="text-success">Anda telah terdaftar</p>
                                    <p class="text-primary">{!! $getProposal->title !!}</p>
                                @else
                                    <p class="text-info">Anda belum terdaftar</p>
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
                                <div class="fs-6 fw-semibold text-primary">Sidang Akhir/TESIS/MUNAQOSAH</div>
                                @if (isset($proposalAccepted))
                                    @if (isset($getSeminar))
                                        <p class="text-success">Anda telah terdaftar</p>
                                        <p class="text-primary">{!! $getSeminar->title !!}</p>
                                    @else
                                    <p class="text-info">Anda dapat mendaftar</p>
                                    @endif
                                @else
                                    <p class="text-danger">Anda Belum terdaftar pada Sidang Proposal</p>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            @if (isset($proposalAccepted))
                                <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                                    href="{{ URL::to('daftar/sidang') }}"><span class="small fw-semibold text-info">{{ isset($getSeminar) ? 'Lihat Disini' : 'Daftar Disini' }}</span><span class="fa fa-chevron-right"></span></a></a>
                            @else
                                <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                                    href="javascript:void(0)"><span class="small fw-semibold">Belum bisa daftar</span>
                                    <span class="fa fa-warning"></span></a>
                            @endif

                        </div>
                    </div>
                </div>
                {{-- END DAFTAR SIDANG --}}
            </div>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Riwayat Pengajuan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table container-fluid">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allPendaftaran as $item)
                                            <tr>
                                                <td>{!! $item->title !!}</td>
                                                <td class="text-center">
                                                    @switch($item->type)
                                                        @case('P')
                                                            <span class="badge bg-primary">Proposal</span>
                                                        @break

                                                        @case('T')
                                                            <span class="badge bg-info">Sidang AKHIR/TESIS/MUNAQOSAH</span>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->status == null)
                                                        <span class="badge bg-secondary">Menunggu Persetujuan</span>
                                                    @endif
                                                    @if ($item->status == 1 and empty($item->catatan))
                                                        <span class="badge bg-success">Diterima</span>
                                                        <p class="small text-left">Catatan : {{ $item->catatan ?? '-' }}</p>
                                                    @endif
                                                    @if ($item->status == 1 and !empty($item->catatan))
                                                        <span class="badge bg-warning">Diterima dengan Catatan</span>
                                                        <p class="small text-left">Catatan : {{ $item->catatan ?? '-' }}</p>
                                                    @endif
                                                    @if ($item->status === 0)
                                                        <span class="badge bg-danger">Ditolak</span>
                                                        <p class="small text-left">Catatan : {{ $item->catatan ?? '-' }}</p>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ URL::to('detail/pendaftaran/' . Crypt::encrypt($item->id)) }}" target="_blank" class="btn btn-sm btn-info text-light">Lihat</a>
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
    </div>
@endsection
