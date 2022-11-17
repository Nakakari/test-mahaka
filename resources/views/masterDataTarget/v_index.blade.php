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
        <!-- end page title -->
        <div class="row">
            <div class="col-md-12 ">
                <button class="btn btn-info mb-2" onClick="tambahData()" id="tambah-SKIM"><i
                        class="mdi mdi-plus-circle-outline"></i>
                    Tambah Data</button>
                <button class="btn btn-outline-danger mb-2" onClick="exportPdf()" id="export-pdf"><i
                        class="mdi mdi-printer-alert"></i>
                    PDF</button>
                <button class="btn btn-outline-success mb-2" onClick="exportExcel()" id="export-data"><i
                        class="mdi mdi-printer-alert"></i>
                    Excell</button>
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
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" onchange="filter()" id="filter-tanggal-dari">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" onchange="filter()" id="filter-tanggal-sampai">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="status-select" class="form-label">Via Bayar</label>
                                <select class="form-select filter select2" id="filter-via-bayar" data-toggle="select2"
                                    onchange="filter()">
                                    <option value="" selected>Semua Via Bayar</option>
                                    @foreach ($via_bayar as $p)
                                        <option value="{{ $p->id }}"> {{ $p->via_bayar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!-- end col-->
                        </div>
                        <hr>

                        <table id="mytable"
                            class="table dt-responsive nowrap scroll-vertical scroll-horizontal text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Rekening</th>
                                    <th>Nama Rekening</th>
                                    <th>Target (Rp.)</th>
                                    <th>Masa Berlaku</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th id="sum_total"></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
    <form action="{{ url('') }}/pdf_master_data_target" method="post" id="form-pdf" class="hidden">
        {{ csrf_field() }}
        <input type="hidden" name="dari" />
        <input type="hidden" name="sampai" />
        <button class="hidden" style="display: none;" type="submit">S</button>
    </form>
@stop
@section('modal')
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
                                <div class="col-4 mb-2">
                                    <label for="inputCity" class="form-label">Target (Rp)</label>
                                    <input type="number" min="0" class="form-control" id="targetedit"
                                        name="target" required>
                                    <div class="invalid-feedback-target feedback"></div>
                                </div>
                                <div class="col-4 mb-2">
                                    <label for="inputCity" class="form-label">Masa Awal Berlaku</label>
                                    <input type="date" class="form-control" id="awal_berlakuedit" name="awal_berlaku"
                                        required>
                                    <div class="invalid-feedback-awal_berlaku feedback"></div>
                                </div>
                                <div class="col-4 mb-2">
                                    <label for="inputCity" class="form-label">Masa Akhir Berlaku</label>
                                    <input type="date" class="form-control" id="akhir_berlakuedit"
                                        name="akhir_berlaku" required>
                                    <div class="invalid-feedback-akhir_berlaku feedback"></div>
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
    <div id="export-excell" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="success-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h4 class="modal-title" id="success-header-modalLabel">Export Data ke Excell</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <p id="kata-modal-excell"></p>
                    <p class="text-muted font-14 hidden" id="pesan-id">
                        Gunakan <code>filter dari tanggal</code> dan <code>filter sampai tanggal</code>
                        untuk mencetak data berdasarkan filter.
                    </p>
                </div>
                <div class="modal-footer">
                    <form id="form-excell" action="{{ url('') }}/excell_master_data_target" method="post"
                        class="hidden">
                        {{ csrf_field() }}
                        <input type="hidden" name="dari" />
                        <input type="hidden" name="sampai" />
                        <input type="hidden" name="via" />
                        <button type="button" class="btn btn-light hidden" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success hidden">Continue</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- Modal Warning --}}
    <div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Ups</h4>
                        <p class="mt-3">Tidak dapat memilih salah satu filter tanggal :D</p>
                        <button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('js')
    <script type="text/javascript">
        let list_data = [];
        $("#export-pdf").prop("disabled", false)

        // Print DataTable
        const table = $("#mytable").DataTable({
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All Data']
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
                url: "{{ url('list_master_data_target') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}",
                        d.dari = $("#filter-tanggal-dari").val(),
                        d.sampai = $("#filter-tanggal-sampai").val(),
                        d.via = $('#filter-via-bayar').val()
                }
            },
            "columnDefs": [{
                "targets": 0,
                "data": "id",
                "sortable": false,
                "render": function(data, type, row, meta) {
                    list_data[row.id] = row;
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }, {
                "targets": 1,
                "data": "kode_rekening",
                "sortable": false,
                "render": function(data, type, row, meta) {
                    return data;

                }
            }, {
                "targets": 2,
                "data": "nama_rekening",
                "sortable": false,
                "render": function(data, type, row, meta) {
                    return data;

                }
            }, {
                "targets": 3,
                "data": "target",
                "sortable": false,
                "render": function(data, type, row, meta) {
                    return String(data).replace(/(.)(?=(\d{3})+$)/g, '$1.');

                }
            }, {
                "targets": 4,
                "data": "tgl_mulai_c",
                "sortable": false,
                "render": function(data, type, row, meta) {
                    return data + ` sd ` + row.tgl_akhir_c;

                }
            }, {
                "targets": 5,
                "data": "id",
                "sortable": false,
                "render": function(data, type, row, meta) {
                    return `
                              <a class="action-icon" onclick="edit(${row.id})"><i class="mdi mdi-square-edit-outline"></i></a>
                              <a class="action-icon" onclick="hapus(${row.id})"><i class="mdi mdi-trash-can"></i></a>
                                `;
                }
            }],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;
                // console.log(data[0].nama_kota)
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                var total = api
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var total_total = String(total).replace(/(.)(?=(\d{3})+$)/g, '$1.');

                $('#sum_total').html(total_total);
            }
        });

        function filter() {
            table.ajax.reload(null, false)
            var dari_tanggal = $('#filter-tanggal-dari').val();
            var sampai_tanggal = $('#filter-tanggal-sampai').val();
            if (dari_tanggal != '' && sampai_tanggal != '') {
                $("#export-pdf").prop("disabled", false)
            } else if (dari_tanggal != '' || sampai_tanggal != '') {
                $("#export-pdf").prop("disabled", true)

            } else {
                $("#export-pdf").prop("disabled", false)
            }
        }

        function tambahData() {
            window.location.href = "/form_add_master_data_target";
        }

        // Jika berhasil menekan submit
        $('#form-tambah').on('submit', function(event) {
            event.preventDefault() //jangan disubmit
            insertData()
        });

        function insertData() {
            let form = $('#form-tambah');
            const url = "{{ url('add_master_data_target') }}";
            $.ajax({
                url,
                method: "POST",
                data: form.serialize(),
                success: function(response) {
                    if (response === true) {
                        table.ajax.reload(null, false)
                        $('#modal-tambah').modal('hide')
                        $('#modal-sukses').modal('show')
                        $('#modal-sukses #kata-sukses').html('Data berhasil ditambah.');
                    }
                },
                error: function(e) {
                    alert('Perhatikan kelengkapan data!')
                    // console.log()
                }
            })
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
            const url = "{{ url('delete_master_data_target') }}";
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
            window.location.href = "/form_edit_master_data_target/" + id;
        }

        function exportExcel() {
            var dari_tanggal = $('#filter-tanggal-dari').val();
            var sampai_tanggal = $('#filter-tanggal-sampai').val();
            var via = $('#filter-via-bayar').val();

            var tamp_via = ``
            if (via == 1) {
                tamp_via += `Bank`
            } else if (via == 2) {
                tamp_via += `Bendahara`
            } else {
                tamp_via += via
            }

            if (dari_tanggal != '' && sampai_tanggal != '' && via != '') {

                $('#export-excell').modal('show')

                $('#export-excell #kata-modal-excell').html(`Exporting data dari tanggal ` + dari_tanggal + ` sd ` +
                    sampai_tanggal + ` & via bayar ` + tamp_via + '...')
                $('#pesan-id').addClass('hidden')

                $("#form-excell [name='dari']").val(dari_tanggal)
                $("#form-excell [name='sampai']").val(sampai_tanggal)
                $("#form-excell [name='via']").val(via)
                $("#form-excell").submit()

                clearTimeout($('#export-excell').data('hideInterval'))
                $('#export-excell').data('hideInterval', setTimeout(function() {
                    $('#export-excell').modal('hide')
                }, 3000));
            } else if (dari_tanggal != '' && sampai_tanggal != '' && via == '') {
                $('#export-excell').modal('show')

                $('#export-excell #kata-modal-excell').html(`Exporting data dari tanggal ` + dari_tanggal + ` sd ` +
                    sampai_tanggal + '...')

                $("#form-excell [name='dari']").val(dari_tanggal)
                $("#form-excell [name='sampai']").val(sampai_tanggal)
                $("#form-excell [name='via']").val(via)

                $('#pesan-id').addClass('hidden')

                clearTimeout($('#export-excell').data('hideInterval'))
                $('#export-excell').data('hideInterval', setTimeout(function() {
                    $('#export-excell').modal('hide')
                }, 3000));
            } else if (dari_tanggal != '' || sampai_tanggal != '') {
                $('#warning-alert-modal').modal('show')
                clearTimeout($('#warning-alert-modal').data('hideInterval'))
                $('#warning-alert-modal').data('hideInterval', setTimeout(function() {
                    $('#warning-alert-modal').modal('hide')
                }, 2000));
            } else if (via != '') {
                $('#export-excell').modal('show')

                $('#export-excell #kata-modal-excell').html(`Exporting data berdasar via ` +
                    tamp_via + '...')
                $('#pesan-id').addClass('hidden')

                $("#form-excell [name='dari']").val(dari_tanggal)
                $("#form-excell [name='sampai']").val(sampai_tanggal)
                $("#form-excell [name='via']").val(via)

                clearTimeout($('#export-excell').data('hideInterval'))
                $('#export-excell').data('hideInterval', setTimeout(function() {
                    $('#export-excell').modal('hide')
                }, 3000));
            } else {
                $('#export-excell').modal('show')
                $('#export-excell #kata-modal-excell').html(`Exporting seluruh data..`)
                $('#pesan-id').removeClass('hidden')

                $("#form-excell [name='dari']").val(dari_tanggal)
                $("#form-excell [name='sampai']").val(sampai_tanggal)
                $("#form-excell [name='via']").val(via)

                $("#form-excell").submit()

                clearTimeout($('#export-excell').data('hideInterval'))
                $('#export-excell').data('hideInterval', setTimeout(function() {
                    $('#export-excell').modal('hide')
                }, 3000));
            }
        }

        function exportPdf() {
            var dari_tanggal = $('#filter-tanggal-dari').val();
            var sampai_tanggal = $('#filter-tanggal-sampai').val();
            if (dari_tanggal != '' && sampai_tanggal != '') {
                $("#form-pdf [name='dari']").val(dari_tanggal)
                $("#form-pdf [name='sampai']").val(sampai_tanggal)
                $("#form-pdf").submit()
            }
        }
    </script>
@stop
