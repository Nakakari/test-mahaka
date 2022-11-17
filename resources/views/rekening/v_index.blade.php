@extends('layouts.mainBE')
@section('css')
    <style type="text/css">
        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .hidden {
            display: none;
        }

        .simpan {
            display: none;
        }
    </style>
@stop
@section('isi')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ $title }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-md-12 ">
                <button class="btn btn-info mb-2" onClick="tambahData()" id="tambah-SKIM"><i
                        class="mdi mdi-plus-circle-outline"></i>
                    Tambah Data</button>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('pesan'))
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong>Success - </strong> {{ session('pesan') }}!
                                </div>
                            @elseif (session('hapus'))
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('hapus') }}</strong>.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                            @elseif(count($errors) > 0)
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        <strong>
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </strong>
                                    </div>
                                </div>
                        @endif
                        <table id="mytable"
                            class="table dt-responsive nowrap scroll-vertical scroll-horizontal text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Rekening</th>
                                    <th>Nama Rekening</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
    </div>
    <!-- end row -->
@stop
@section('modal')
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah Data</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah" enctype="multipart/form-data" action="/add_rekening" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="inputCity" class="form-label">Kode Rekening</label>
                                    <input type="number" class="form-control" id="kode_rekening" name="kode_rekening"
                                        min="0" step="0.01" required>
                                    <div class="invalid-feedback-kode_rekening feedback"></div>
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="inputCity" class="form-label">Nama Rekening</label>
                                    <input type="text" class="form-control" id="nama_rekening" name="nama_rekening"
                                        required>
                                    <div class="invalid-feedback-nama_rekening feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="btnSave" disabled>Simpan</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Data</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="inputCity" class="form-label">Kode Rekening</label>
                                    <input type="hidden" name="id" id="id" />
                                    <input type="number" class="form-control" id="kode_rekeningedit"
                                        name="kode_rekening" min="0" step="0.01" required>
                                    <div class="invalid-feedback-kode_rekening feedback"></div>
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="inputCity" class="form-label">Nama Rekening</label>
                                    <input type="text" class="form-control" id="nama_rekeningedit"
                                        name="nama_rekening" required>
                                    <div class="invalid-feedback-nama_rekening feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="btnEdit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="modal-sukses" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-success">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-checkmark h1"></i>
                        <h4 class="mt-2">Sukses!</h4>
                        <p class="mt-3" id="kata-sukses"></p>
                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="mdi mdi-trash-can h1"></i>
                        <h4 class="mt-2">Oh wow!</h4>
                        <p class="mt-3">Apakah Anda yakin hapus data?</p>
                        <form id="form-hapus">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id" />
                            <button type="submit" class="btn btn-light my-2" data-bs-dismiss="modal">Lanjut</button>
                            <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal"
                                aria-hidden="true">Batal</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('js')
    <script type="text/javascript">
        let list_rekening = [];
        const table = $("#mytable").DataTable({
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "order": [
                [1, "asc"]
            ],
            "ajax": {
                url: "{{ url('list_rekening') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}"
                }
            },
            "columnDefs": [{
                "targets": 0,
                "data": "id",
                "render": function(data, type, row, meta) {
                    list_rekening[row.id] = row;
                    return meta.row + meta.settings._iDisplayStart + 1;
                    // console.log(list_siswa)
                }
            }, {
                "targets": 1,
                "data": "kode_rekening",
                "render": function(data, type, row, meta) {
                    return data;

                }
            }, {
                "targets": 2,
                "data": "nama_rekening",
                "render": function(data, type, row, meta) {
                    return data;

                }
            }, {
                "targets": 3,
                "data": "id",
                "render": function(data, type, row, meta) {
                    return `
                              <a class="action-icon" onclick="edit(${row.id})"><i class="mdi mdi-square-edit-outline"></i></a>
                              <a class="action-icon" onclick="hapus(${row.id})"><i class="mdi mdi-trash-can"></i></a>
                                `;
                }
            }]
        });

        function tambahData() {
            $('#modal-tambah').modal('show')

            // Reset form & validasi
            $('#form-tambah')[0].reset();
            $('.feedback').empty();
            $('#kode_rekening').removeClass('is-invalid').removeClass('is-valid');
            $('#nama_rekening').removeClass('is-invalid').removeClass('is-valid');
            $('#btnSave').attr('disabled');

            // Validasi Form
            $('#kode_rekening').on('input', function() {
                var firstName = $(this).val();
                if (firstName.length > 8) {
                    $('.invalid-feedback-kode_rekening').addClass('invalid-msg').text(
                        "Kode Rekening hanya delapan karakter!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else if (firstName.length == 0) {
                    $('.invalid-feedback-kode_rekening').addClass('invalid-msg').text(
                        "Perhatikan data Anda!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else {
                    $('.invalid-feedback-kode_rekening').empty();
                    $(this).addClass('is-valid').removeClass('is-invalid');
                }

            });
            $('#nama_rekening').on('input', function() {
                var instansi = $(this).val();
                if (instansi.length == 0) {
                    $('.invalid-feedback-nama_rekening').addClass('invalid-msg').text(
                        "Data dimohon tidak boleh kosong!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else {
                    $('.invalid-feedback-nama_rekening').empty();
                    $(this).addClass('is-valid').removeClass('is-invalid');
                }
            });
            $('input').on('input', function(e) {
                if ($('#form-tambah').find('.is-valid').length == 2) {
                    $('#btnSave').removeAttr('disabled');
                } else {
                    e.preventDefault();
                    $('#btnSave').attr('disabled');
                }
            });
        }

        //Hapus Data
        function hapus(id) {
            $('#modal-hapus').modal('show')
            $("#form-hapus [name='id']").val(id)
        }

        $('#form-hapus').on('submit', function(event) {
            event.preventDefault() //jangan disubmit
            hapusData()
        });

        function hapusData() {
            let form = $('#form-hapus');
            const url = "{{ url('delete_rekening') }}";
            $.ajax({
                url,
                method: "POST",
                data: form.serialize(),
                success: function(response) {
                    if (response === true) {
                        table.ajax.reload(null, false)
                        $('#modal-hapus').modal('hide')
                        $('#modal-sukses').modal('show')
                        $('#modal-sukses #kata-sukses').html('Data berhasil dihapus.');
                    }
                },
                error: function(e) {
                    alert('Whops!')
                }
            })
        }

        function edit(id) {
            const data = list_rekening[id]
            $('#modal-edit').modal('show');
            $("#form-edit [name='id']").val(id)
            $("#form-edit [name='kode_rekening']").val(data.kode_rekening)
            $("#form-edit [name='nama_rekening']").val(data.nama_rekening)

            $('.feedback').empty();
            $('#kode_rekeningedit').removeClass('is-invalid').removeClass('is-valid');
            $('#nama_rekeningedit').removeClass('is-invalid').removeClass('is-valid');

            // Validasi Form
            $('#kode_rekeningedit').on('input', function() {
                var firstName = $(this).val();
                if (firstName.length > 8) {
                    $('.invalid-feedback-kode_rekening').addClass('invalid-msg').text(
                        "Kode Rekening hanya delapan karakter!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else if (firstName.length == 0) {
                    $('.invalid-feedback-kode_rekening').addClass('invalid-msg').text(
                        "Perhatikan data Anda!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else {
                    $('.invalid-feedback-kode_rekening').empty();
                    $(this).addClass('is-valid').removeClass('is-invalid');
                }
            });

            $('#nama_rekeningedit').on('input', function() {
                var instansi = $(this).val();
                if (instansi.length == 0) {
                    $('.invalid-feedback-nama_rekening').addClass('invalid-msg').text(
                        "Data dimohon tidak boleh kosong!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else {
                    $('.invalid-feedback-nama_rekening').empty();
                    $(this).addClass('is-valid').removeClass('is-invalid');
                }
            });

        }

        $('#form-edit').on('submit', function(event) {
            event.preventDefault() //jangan disubmit
            editdata()
        });

        function editdata() {
            let form = $('#form-edit');
            const url = "{{ url('edit_rekening') }}";
            $.ajax({
                url,
                method: "POST",
                data: form.serialize(),
                success: function(response) {
                    if (response === true) {
                        table.ajax.reload(null, false)
                        $('#modal-edit').modal('hide')
                        $('#modal-sukses').modal('show')
                        $('#modal-sukses #kata-sukses').html('Data berhasil diupdate.');
                    }
                },
                error: function(e) {
                    alert('Something wrong!')
                }
            })
        }
    </script>
@stop
