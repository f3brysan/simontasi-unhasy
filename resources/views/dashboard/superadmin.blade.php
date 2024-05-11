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
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Jumlah Pendaftar</h5>
                </div>
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1005">
                                <div class="row">
                                    {{-- Seluruh Proposal --}}
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-primary text-white p-3 me-3">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-list-ol"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-primary">
                                                        {{ count($getDataProposals) }} Proposal</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Seluruh Proposal</div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    {{-- Proposal Menunggu Konfirmasi --}}
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-warning text-white p-3 me-3">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-hourglass-start"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-primary">
                                                        {{ count($getWaitProposals) }} Proposal</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Menunggu Konfirmasi</div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    {{-- Proposal Telah Dikonfirmasi --}}
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-success text-white p-3 me-3">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-thumbs-up"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-primary">
                                                        {{ count($getDoneProposals) }} Proposal</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Telah Konfirmasi</div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Detail Pendaftar</h5>
                </div>
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1005">
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table table-bordered table-striped" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">NIM</th>
                                                    <th class="text-center">Nama</th> 
                                                    <th class="text-center">Prodi</th> 
                                                    <th class="text-center">Dosen Pembimbing</th> 
                                                    <th class="text-center">Disetujui</th> 
                                                    <th class="text-center">Aksi</th>                                                                                                       
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
{{-- Data Tables --}}
<link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ URL::to('/') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'no_induk',
                        name: 'no_induk'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },                   
                    {
                        data: 'prodi_nama',
                        name: 'prodi_nama'
                    },                   
                    {
                        data: 'dosen_pembimbing',
                        name: 'dosen_pembimbing'
                    },                   
                    {
                        data: 'approved',
                        name: 'approved'
                    },                   
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                        className: 'text-end',
                        targets: [0]
                    },
                    {
                        className: 'text-center',
                        targets: [1,3,5,6]
                    },                     
                ],
            });
        })
    </script>
@endpush
