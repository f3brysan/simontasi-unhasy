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
                                    <div class="col-lg-12 table table-responsive">
                                        <table class="table table-sm table-bordered table-striped" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Aksi</th>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">NIM</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Prodi</th>
                                                    <th class="text-center">Dosen</th>
                                                    <th class="text-center">Judul Proposal</th>
                                                    <th class="text-center">Disetujui</th>
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

    <!-- Modal -->
    <div class="modal fade" id="viewDetailModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
@endsection

@push('js')
    {{-- Data Tables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
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
                        data: 'dosen',
                        name: 'dosen'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'approved',
                        name: 'approved'
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                columnDefs: [{
                        className: 'text-end',
                        targets: [1]
                    },
                    {
                        className: 'text-center',
                        targets: [2, 4, 7]
                    },
                    {
                        className: 'text-justify',
                        targets: [6]
                    },
                ],
            });

            $(document).on("click", ".edit", function() {
                var id = $(this).data("id");
                $("#viewDetailModal").modal('show');
            });

            $(document).on("click", ".approve", function() {
                var id = $(this).data("id");
                var nim = $(this).data("nim");
                var name = $(this).data("name");
                Swal.fire({
                    title: "Perhatian",
                    text: "Setujui pendaftaran Proposal " + nim + " - " + name + "?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, approve"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.get("{{ URL::to('proposal/approve/') }}/" + id,
                            function (data) {
                                table.ajax.reload(null, false);
                                iziToast.success({
                                    title: 'Berhasil',
                                    message: 'Proposal berhasil disetujui.',
                                    position: 'topRight'
                                });
                            });                        
                    }
                });
            });
        })
    </script>
@endpush
