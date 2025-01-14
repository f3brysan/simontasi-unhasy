@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active"><span>Status VA</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg">
            <div class="row">
                {{-- START DAFTAR PROPOSAL --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Status VA</h5></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Timestamp</th>
                                        <th class="text-center">No Induk<br>Nama</th>
                                        <th class="text-center">No VA</th>
                                        <th class="text-center">Prodi</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Status</th>
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
@endsection
@push('js')
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- JQuery Validate --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>

    {{-- Data Tables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

    {{-- Swal --}}
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
                    url: "{{ URL::to('setting/pembayaran') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'created_at',
                        name: 'created_at',
                        className: 'text-center'
                    },
                    {
                        data: 'detil_mhs',
                        name: 'detil_mhs',
                        className: 'text-center'
                    },
                    {
                        data: 'nomor_va',
                        name: 'nomor_va'
                    },
                    {
                        data: 'prodi',
                        name: 'prodi'
                    },
                    {
                        data: 'typePendaftaran',
                        name: 'typePendaftaran',
                        className: 'text-center'

                    },
                    {
                        data: 'statusVA',
                        name: 'statusVA',
                        className: 'text-center'

                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [5, 'asc'],
                    [0, 'desc'],
                ],
            });
        });
    </script>
    <script>
        $(document).on('click', '.accept', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan menyetujui pembayaran ini.",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, setujui"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('setting/terima-pembayaran') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            table.ajax.reload(null, false);
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });

                }
            });

        });
    </script>
@endpush
