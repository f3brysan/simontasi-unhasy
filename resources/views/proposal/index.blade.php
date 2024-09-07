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
                                    <td><strong>Nama</strong></td>
                                    <td>{{ auth()->user()->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Program Studi</strong></td>
                                    <td>{{ $prodi }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Judul</strong></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-10">{!! $dataProposal->title !!}</div>
                                            @if ($dataProposal->is_ok == null)
                                                <div class="col-md-2"><a href="javascript:void(0)"
                                                        onclick="gantiJudul('{{ Crypt::encrypt($dataProposal->id) }}')"
                                                        class="btn btn-sm btn-primary float-end"><i
                                                            class="fas fa-pencil"></i>
                                                        Ubah</a></div>
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
                                                    <u>{{ $item->nama }}</u><br>NIY: {{ $item->nip }}
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($item->is_ok == 1)
                                                        <span class="text-center badge text-bg-success text-light"><i
                                                                class="fa-solid fa-check"></i> Disetujui</span>

                                                        <p class="small text-muted">{{ $item->is_ok_at }}</p>
                                                    @else
                                                        <span class="badge text-bg-warning text-light"> Menunggu
                                                            Persetujuan</span>
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
                                                    <br>NIY: {{ $item->nip }}
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
                                                <div class="col-md-3">
                                                    @if ($item->is_lock == 1)
                                                        <span class="badge bg-info">Sudah terkunci.</span>
                                                    @else
                                                        @if ($item->doc_id)
                                                            <a href="javascript:void(0)"
                                                                onclick="gantiBerkas('{{ $item->id }}', '{{ $item->nama }}' ,'{{ $dataProposal->id }}', '{{ $item->doc_id }}')"
                                                                class="btn btn-sm btn-info float-end text-light"><i
                                                                    class="fas fa-redo-alt"></i></i>
                                                                Ganti</a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                                onclick="unggahBerkas('{{ $item->id }}', '{{ $item->nama }}' ,'{{ $dataProposal->id }}')"
                                                                class="btn btn-sm btn-primary float-end"><i
                                                                    class="fas fa-upload"></i>
                                                                Unggah</a>
                                                        @endif
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

            @if ($dataProposal)
                @if (empty($statusBayar))
                    <div class="card mb-4" id="checkLogCompleted" style="display: none">
                        <div class="card-header">
                            <h5>Daftar Sidang Proposal</h5></span>
                        </div>
                        <div class="card-body">
                            <div class="table container-fluid">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td class="text-center"><b>Daftar Seminar Proposal disini</b></td>
                                        <td class="text-center"><button class="btn btn-sm btn-primary"
                                                id="btnDaftarSeminarProposal"
                                                onclick="daftarSeminarProposal('{{ Crypt::encrypt($dataProposal->id) }}')"><i
                                                    class="fa-solid fa-right-to-bracket"></i> Daftar</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- INFO VA --}}
                @if (isset($statusBayar))
                    @if ($statusBayar->status !== '1')
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="alert alert-danger" role="alert">
                                    <strong>Maaf, Anda belum lolos syarat administrasi pembayaran.</strong>
                                </div>
                                <div class="table container-fluid">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Informasi</th>
                                                <th class="text-center">No VA</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>No VA Pembayaran <a href="javascript:void(0)"
                                                        class="btn btn-sm btn-info float-end">Cara Pembayaran</a></td>
                                                <td class="text-center"><b>{{ $statusBayar->nomor_va }}</b></td>
                                                <td class="text-center">
                                                    @if ($statusBayar->status == '0')
                                                        <span class="badge bg-warning">Menunggu Pembayaran</span>
                                                    @endif
                                                    @if ($statusBayar->status == '2')
                                                        <span class="badge bg-danger">Invalid</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- END INFO VA --}}

                    @if ($statusBayar->status == 1)
                        {{-- START JADWAL PROPOSAL --}}
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Jadwal Sidang dan Berkas Proposal</h5></span>
                            </div>
                            <div class="card-body">
                                @if (!empty($dataProposal))
                                    <div class="table container-fluid">
                                        <h6>Jadwal Sidang</h6>
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
                                                        <td class="text-center" colspan="2"><span
                                                                class="badge bg-warning">Jadwal
                                                                belum diset !</span></td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ date('d-m-Y', strtotime($jadwal->awal)) }}<br>
                                                            {{ date('H:i', strtotime($jadwal->awal)) }} -
                                                            {{ date('H:i', strtotime($jadwal->akhir)) }} WIB
                                                        </td>
                                                        <td class="text-center">Di {{ $jadwal->gedung }}, Ruang
                                                            {{ $jadwal->ruang }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <h6>Berkas Penunjang Proposal</h6>
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <td>Template Berita Acara </td>
                                                <td class="text-center"><a
                                                        href="{{ URL::to('document/berita-acara-proposal/' . $dataProposal->id) }}"
                                                        target="_blank" class="btn btn-sm btn-info text-white"> Unduh</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- END JADWAL PROPOSAL --}}
                    @endif
                @endif
            @endif

            {{-- START HASIL PROPOSAL --}}
            @if (!empty($jadwal))
                @if ($jadwal->akhir <= date('Y-m-d H:i:s'))
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Hasil Sidang Proposal</h5></span>
                        </div>
                        <div class="card-body">
                            @if (!empty($dataProposal))
                                <div class="table container-fluid">
                                    <h6>Hasil Sidang Proposal</h6>
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <td style="width: 15%" class="text-center"><b>Status Proposal</b></td>
                                            <td class="text-center">
                                                @if ($statusProposal->status == 1 and empty($statusProposal->catatan))
                                                    <span class="badge bg-success">Diterima</span>
                                                    <p class="small">Catatan : {{ $statusProposal->catatan ?? '-' }}</p>
                                                @endif
                                                @if ($statusProposal->status == 1 and !empty($statusProposal->catatan))
                                                    <span class="badge bg-warning">Diterima dengan Catatan</span>
                                                    <p class="small">Catatan : {{ $statusProposal->catatan ?? '-' }}</p>
                                                @endif
                                                @if ($statusProposal->status == 0)
                                                    <span class="badge bg-danger">Ditolak</span>
                                                    <p class="small">Catatan : {{ $statusProposal->catatan ?? '-' }}</p>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                    <h6>Monitoring Berkas Hasil Proposal</h6>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nama Berkas</th>
                                                <th class="text-center">File Berkas</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        @foreach ($berkas_hasil as $item)
                                            <tbody>
                                                <tr>
                                                    <td style="width: 15%">{{ $item->nama }}</td>
                                                    <td>
                                                        @if ($item->file)
                                                            <a href="{{ URL::to('/') }}/{{ $item->file }}"
                                                                target="_blank"
                                                                class="btn btn-sm btn-info text-light">{{ $item->file }}</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center" style="width: 10%">
                                                        @if ($item->doc_id)
                                                            <a href="javascript:void(0)"
                                                                onclick="gantiBerkas('{{ $item->id }}', '{{ $item->nama }}' ,'{{ $dataProposal->id }}', '{{ $item->doc_id }}')"
                                                                class="btn btn-sm btn-info text-light"><i
                                                                    class="fas fa-redo-alt"></i></i>
                                                                Ganti</a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                                onclick="unggahBerkas('{{ $item->id }}', '{{ $item->nama }}' ,'{{ $dataProposal->id }}')"
                                                                class="btn btn-sm btn-primary"><i
                                                                    class="fas fa-upload"></i>
                                                                Unggah</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
            {{-- END HASIL PROPOSAL --}}

            {{-- START LOGBOOK --}}
            @if ($dataProposal)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Log Book Bimbingan</h5>
                    </div>
                    <div class="card-body">
                        <a href="javascript:(0)" class="btn btn-sm btn-primary mb-4"
                            onclick="addKegiatanLogBook('{{ Crypt::encrypt($dataProposal->id) }}', '{{ auth()->user()->no_induk }}')"><i
                                class="fa-solid fa-file-circle-plus"></i></i> Tambah</a>
                        <div class="col-lg-12 table table-responsive">
                            <table class="table table-sm table-bordered table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Tanggal Bimbingan</th>
                                        <th class="text-center" style="width: 50%">Catatan</th>
                                        <th class="text-center">Berkas<br>Pendukung</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            {{-- END LOGBOOK --}}
        </div>
    </div>

    {{-- MODAL PROPOSAL --}}
    <div class="modal fade" id="modalDaftarProposal" data-coreui-backdrop="static" data-coreui-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Proposal</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="storeProposal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Judul Skripsi</label>
                            <textarea class="form-control summernote" id="exampleFormControlTextarea1" rows="3" name="judul"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Dosen Pembimbing</label>
                            <select class="form-select form-select-lg mb-3" id="allDosenPembimbing"
                                name="dosen_pembimbing" style="width: 100%">
                                <option value="">--- Pilih Dosen ---</option>
                                @foreach ($allDosenPembimbing as $item)
                                    <option value="{{ $item['nip'] }}">{{ $item['nip'] }} - {{ $item['nama'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveBtnDaftarProposal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL PROPOSAL --}}

    {{-- MODAL PROPOSAL --}}
    <div class="modal fade" id="modalEditProposal" data-coreui-backdrop="static" data-coreui-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Proposal</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProposal">
                    <input type="hidden" id="pendaftaran_id_edit" name="pendaftaran_id_edit">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Judul Skripsi</label>
                            <textarea class="form-control summernote" id="judul_skripsi" rows="3" name="judul"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveBtnDaftarProposal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL PROPOSAL --}}

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
                    @csrf
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
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">File Lampiran</label>
                            <input class="form-control" type="file" name="formFile" id="formFile">
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

    {{-- MODAL LOG BOOK --}}
    <div class="modal fade" id="modalUnggah" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulUnggah"></h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUnggah">
                    @csrf
                    <input type="hidden" name="pendaftaran_berkas_id" id="pendaftaran_berkas_id">
                    <input type="hidden" name="berkas_id" id="berkas_id">
                    <input type="hidden" name="pendaftaran_id" id="pendaftaran_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Unggah Berkas</label>
                            <p><code>Pastikan ekstensi file adalah .pdf</code></p>
                            <input class="form-control" type="file" id="document" name="document" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveBtnUnggah">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL LOG BOOK --}}
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- Summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    {{-- JQ Validate --}}

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="{{ asset('js/jquery-validate-additional-methods.js') }}"></script>
    {{-- <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script> --}}
    <script src="{{ URL::to('/') }}/js/summernote-ext-rtl.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            countLogBook();

            var options = {
                height: 300,
                placeholder: 'Judul proposal Anda',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['ltr', 'rtl']],
                    ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            };

            $('.summernote').summernote(options);

            $('#catatanLogBook').summernote({
                placeholder: 'Detil catatan bimbingan',
                tabsize: 2,
                height: 100
            });
            // cek ukuran file yg diupload
            $.validator.addMethod('filesize', function(value, element, param) {
                    return this.optional(element) || (element.files[0].size <= param)
                },
                'Ukuran dokumen terlalu besar'); // notifikasi apabila file > 2mb
        });
    </script>
    <script>
        function daftarProposal() {
            $('#allDosenPembimbing').select2({
                dropdownParent: $('#modalDaftarProposal')
            });
            $("#modalDaftarProposal").modal('show');
        }

        function countLogBook() {
            $.ajax({
                type: "GET",
                url: "{{ URL::to('log-book/count/' . Crypt::encrypt($dataProposal->id ?? '')) }}",
                success: function(response) {
                    if (response > 3) {
                        $("#checkLogCompleted").show();
                    }
                }
            });
        }

        if ($("#storeProposal").length > 0) {
            $("#storeProposal").validate({
                submitHandler: function(form) {
                    $('#saveBtnDaftarProposal').html('Menyimpan . .');

                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('daftar/proposal/store') }}",
                        data: $('#storeProposal').serializeArray(),
                        dataType: 'json',
                        success: function(data) {
                            if (data == true) {
                                $('#storeProposal').trigger("reset");
                                $('#modalDaftarProposal').modal("hide");
                                $('#saveBtnDaftarProposal').html('Simpan');
                                iziToast.success({
                                    title: 'Berhasil',
                                    message: 'Proposal tersimpan.',
                                    position: 'topRight'
                                });
                                location.reload();
                            }
                        },
                        error: function(data) {
                            console.log('Error', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            });
        }

        function gantiJudul(id) {
            console.log(id);
            $.get("{{ URL::to('daftar/proposal/get-judul') }}/" + id,
                function(data) {
                    $("#pendaftaran_id_edit").val(data.id);
                    $('#judul_skripsi').summernote('code', data.title);
                    $("#modalEditProposal").modal('show');
                });
        }

        if ($("#editProposal").length > 0) {
            $("#editProposal").validate({
                submitHandler: function(form) {
                    $('#saveBtnDaftarProposal').html('Menyimpan . .');

                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('daftar/proposal/store') }}",
                        data: $('#editProposal').serializeArray(),
                        dataType: 'json',
                        success: function(data) {
                            if (data == true) {
                                $('#editProposal').trigger("reset");
                                $('#modalEditProposal').modal("hide");
                                $('#saveBtnDaftarProposal').html('Simpan');
                                iziToast.success({
                                    title: 'Berhasil',
                                    message: 'Proposal tersimpan.',
                                    position: 'topRight'
                                });
                                location.reload();
                            }
                        },
                        error: function(data) {
                            console.log('Error', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            });
        }

        function unggahBerkas(idjenis, nama, id) {
            console.log(id);

            $("#pendaftaran_id").val(id);
            $("#berkas_id").val(idjenis);
            $("#judulUnggah").html(nama);
            $("#modalUnggah").modal('show');
        }

        function gantiBerkas(idjenis, nama, id, iddoc) {
            $("#pendaftaran_id").val(id);
            $("#pendaftaran_berkas_id").val(iddoc);
            $("#berkas_id").val(idjenis);
            $("#judulUnggah").html(nama);
            $("#modalUnggah").modal('show');
        }

        if ($("#formUnggah").length > 0) {
            $("#formUnggah").validate({
                // validasi mime type
                rules: {
                    document: {
                        required: true, // wajib
                        extension: "pdf|PDF", // ekstensi pdf
                        filesize: 5097152, // ukuran file < 2mb

                    }
                },
                messages: {
                    document: {
                        required: "Tidak Boleh Kosong",
                        extension: "Mohon mengunggah dokumen berekstensi *pdf"
                    }
                },
                submitHandler: function(form) {
                    var actionType = $('#saveBtnUnggah').val();
                    var formData = new FormData(form);
                    $('#saveBtnUnggah').html('Menyimpan . .');
                    console.log(formData);
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('daftar/proposal/berkas/store') }}",
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Berkas berhasil disimpan",
                                icon: "success"
                            });
                            location.reload();
                        },
                        error: function(data) {
                            console.log('Error', data);
                            $('#saveBtnUnggah').html('Simpan');
                        }
                    });
                }
            });
        }
    </script>
    <script>
        table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ URL::to('log-book/get/' . Crypt::encrypt($dataProposal->id ?? '')) }}",
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
                    data: 'attachment',
                    name: 'attachment'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ],
            order: [
                [2, 'desc']
            ],
            columnDefs: [{
                className: 'text-center',
                targets: [0, 1, 3]
            }, ],
        });

        function addKegiatanLogBook(id, nim) {
            $("#idProposal").val(id);
            $("#nimLogBook").val(nim);
            $("#storeLogBook").trigger("reset");
            $('#catatanLogBook').summernote('reset');
            $("#modalLogBook").modal('show');
        }

        function daftarSeminarProposal(id) {
            console.log(id);
            Swal.fire({
                title: "Peringatan",
                text: "Apakah Anda ingin melakukan pengajuan Seminar Proposal?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('daftar/seminar-proposal/store') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $("#btnDaftarSeminarProposal").attr('disabled', true);
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Berhasil mendaftar Seminar Proposal",
                                icon: "success"
                            });
                            location.reload();
                        }
                    });
                }
            });
        }

        $(document).on('click', '.edit', function() {
            var id = $(this).data('id')
            $.get("{{ URL::to('log-book/show-detil') }}/" + id,
                function(data) {
                    $("#idLogBook").val(data.data.id);
                    $("#idProposal").val(data.data.pendaftaran_id);
                    $("#tgl_bimbingan").val(data.data.tgl_bimbingan);
                    $('#catatanLogBook').summernote('code', data.data.catatan);
                    $("#modalLogBook").modal('show');
                });
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).data('id')
            Swal.fire({
                title: "Peringatan",
                text: "Apakah Anda ingin menghapus catatan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ URL::to('log-book/delete-detil') }}/" + id,
                        success: function(data) {
                            table.ajax.reload(null, false);
                            countLogBook();
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Catatan berhasil dihapus",
                                icon: "success"
                            });
                        }
                    });
                }
            });
        });

        if ($("#storeLogBook").length > 0) {
            $("#storeLogBook").validate({
                // validasi mime type
                rules: {
                    formFile: {
                        extension: "pdf|PDF", // ekstensi pdf
                        filesize: 5097152, // ukuran file < 2mb

                    }
                },
                messages: {
                    formFile: {
                        extension: "Mohon mengunggah dokumen berekstensi *pdf"
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    console.log(formData);
                    $('#saveBtnLogBook').html('Menyimpan . .');
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('log-book/store') }}",
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data == true) {
                                $('#storeLogBook').trigger("reset");
                                $('#modalLogBook').modal("hide");
                                $('#saveBtnLogBook').html('Simpan');
                                countLogBook();
                                iziToast.success({
                                    title: 'Berhasil',
                                    message: 'Log Book tersimpan.',
                                    position: 'topRight'
                                });
                                table.ajax.reload(null, false);
                            }
                        },
                        error: function(data) {
                            console.log('Error', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            });
        }
    </script>
@endpush
