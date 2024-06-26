@extends('layouts.main')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active"><span>Proposal</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg">
            {{-- START DAFTAR PROPOSAL --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Pendaftaran Proposal</h5></span>
                </div>
                <div class="card-body">
                    @if (empty($dataProposal))
                        <div class="alert alert-danger text-center" role="alert">
                            Anda belum mendaftarkan Proposal Anda.
                        </div>
                        <div>
                            <a href="javascript:void(0)" class="btn btn-primary float-end"
                                onclick="daftarProposal()">Daftar</a>
                        </div>
                    @endif

                    @if (!empty($dataProposal))
                        <div class="table container-fluid">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td style="width: 20%"><strong>NIM</strong></td>
                                    <td>{{ auth()->user()->no_induk }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NAMA</strong></td>
                                    <td>{{ auth()->user()->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Program Studi</strong></td>
                                    <td>{{ $prodi->prodi }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Judul</strong></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-10">{!! $dataProposal->title !!}</div>
                                            @if ($dataProposal->is_ok == NULL)
                                            <div class="col-md-2"><a href="javascript:void(0)"
                                                onclick="approveJudul('{{ Crypt::encrypt($dataProposal->id) }}')"
                                                class="btn btn-sm btn-primary float-end"><i class="fas fa-check"></i>
                                                Setujui</a></div>
                                            @else
                                            <div class="col-md-2"><a href="javascript:void(0)"
                                                onclick="approveJudul('{{ Crypt::encrypt($dataProposal->id) }}')"
                                                class="btn btn-sm btn-warning float-end"><i class="fas fa-refresh"></i>
                                                Batal Setujui</a></div>
                                            @endif                                            
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dosen Pembimbing</strong></td>
                                    <td>
                                        <div class="row">
                                            @foreach ($pembimbing as $item)
                                                <div class="col-md-9">
                                                    <u>{{ $item->nama }}</u><br>NIP: {{ $item->nip }}
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($item->is_ok == 1)
                                                        <span class="text-center badge text-bg-success text-light"><i
                                                                class="fa-solid fa-check"></i> Disetujui</span>

                                                        <p class="text-muted">{{ $item->is_ok_at }}</p>                                                   
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dosen Penguji</strong></td>
                                    <td>
                                        <div class="row">
                                            @foreach ($penguji as $item)
                                                <div class="col-md-9">
                                                    <u>{{ $item->nama }}</u>
                                                    <br>NIP: {{ $item->nip }}
                                                    <br>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($berkas as $item)
                                    <tr>
                                        <td><strong>{{ $item->nama }}</strong></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    @if ($item->file)
                                                        <a href="{{ URL::to('/') }}/{{ $item->file }}" target="_blank"
                                                            class="btn btn-sm btn-info text-light">{{ $item->file }}</a>
                                                    @else
                                                    @endif
                                                </div>                                                
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            {{-- END DAFTAR PROPOSAL --}}

             {{-- START JADWAL PROPOSAL --}}
             <div class="card mb-4">
                <div class="card-header">
                    <h5>Jadwal Sidang</h5></span>
                </div>
                <div class="card-body">
                    @if (!empty($dataProposal))
                        <div class="table container-fluid">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tanggal dan Waktu</th>
                                        <th class="text-center">Lokasi</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($jadwal))
                                        <tr>
                                            <td class="text-center" colspan="2"><span class="badge bg-warning">Jadwal
                                                    belum diset !</span></td>                                            
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($jadwal->awal)) }}<br>
                                                {{ date('H:i', strtotime($jadwal->awal)) }} -
                                                {{ date('H:i', strtotime($jadwal->akhir)) }} WIB
                                            </td>
                                            <td class="text-center">Di {{ $jadwal->lokasi }}</td>                                            
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            {{-- END JADWAL PROPOSAL --}}

            {{-- START LOGBOOK --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Log Book Bimbingan</h5>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 table table-responsive">
                        <table class="table table-sm table-bordered table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-center">Aksi</th>
                                    <th class="text-center">Tanggal Bimbingan</th>
                                    <th class="text-center" style="width: 50%">Catatan</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- END LOGBOOK --}}
        </div>
    </div>

    {{-- MODAL LOG BOOK --}}
    <div class="modal fade" id="modalLogBook" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Log Book Kegiatan</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="storeLogBook">
                    <div class="modal-body">
                        <input type="hidden" name="idLogBook" id="idLogBook">
                        <input type="hidden" name="idProposal" id="idProposal">
                        <input type="hidden" name="nimLogBook" id="nimLogBook">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Tanggal Bimbingan</label>
                            <input type="date" class="form-control" id="tgl_bimbingan" name="tgl_bimbingan">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatanLogBook" rows="3" name="catatanLogBook"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveBtnLogBook">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL LOG BOOK --}}
@endsection
@push('js')
    {{-- Summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- JQuery Validate --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    {{-- TOAST JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
        integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Data Tables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    {{-- SWAL --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script>
        table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ URL::to('dosen/log-bimbingan/detil/' . Crypt::encrypt($dataProposal->id)) }}",
                type: 'GET'
            },
            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tgl_bimbingan',
                    name: 'tgl_bimbingan'
                },
                {
                    data: 'catatan',
                    name: 'catatan'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ],
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                className: 'text-center',
                targets: [0, 1, 3]
            }, ],
        });

        function addKegiatanLogBook(id, nim) {
            $("#idProposal").val(id);
            $("#nimLogBook").val(nim);
            $("#modalLogBook").modal('show');
            console.log(id, nim);
        }

        $(document).on('click', '.approve', function() {
            var id = $(this).data("id");
            var status = $(this).data("status");
            if (status == "1") {
                var msg = 'menolak';
            } else {
                var msg = 'menyetujui'
            }
            Swal.fire({
                title: "Perhatian",
                text: "Apakah Anda "+msg+" log bimbingan ini?",
                icon: "warning",
                showDenyButton: true,                
                confirmButtonText: "Iya",
                denyButtonText: `Batal`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.get("{{ URL::to('dosen/log-bimbingan/approve/') }}/" + id,
                        function (data) {
                            if (data == '0') {
                                var msg = 'batal setujui';
                            } else {
                                var msg = 'disetujui';
                            }
                            iziToast.success({
                                    title: 'Berhasil',
                                    message: 'Log Book '+msg+'.',
                                    position: 'topRight'
                                });
                                table.ajax.reload(null, false);                            
                        });
                    
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });

        function approveJudul(id) {
            console.log(id); 
            $.get("{{ URL::to('dosen/proposal/approval-dosen/') }}/" + id,
                function (data) {
                    iziToast.success({
                                    title: 'Berhasil',
                                    message: 'Data tersimpan.',
                                    position: 'topRight'
                                });
                                location.reload();
                });           
        }
    </script>
@endpush
