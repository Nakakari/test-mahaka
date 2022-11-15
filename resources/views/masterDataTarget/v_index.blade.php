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
                    <h4 class="page-title">Halo</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- end page title -->
        <div class="row">
            <div class="col-md-12 ">
                <button class="btn btn-success mb-2" onClick="tambahData()" id="tambah-SKIM"><i
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
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" onchange="filter()" id="filter-tanggal-dari">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" onchange="filter()" id="filter-tanggal-sampai">
                            </div>
                            {{-- <div class="col-md-4 mb-2">
                                <label for="status-select" class="form-label">Via Bayar</label>
                                <select class="form-select filter select2" id="filter-via-bayar" data-toggle="select2"
                                    onchange="filter()">
                                    <option value="" selected>Semua Pembeli</option>
                                    {{-- @foreach ($pembeli as $p)
                                        <option value="{{ $p->id_pembeli }}">[{{ $p->kode_pembeli }}] {{ $p->nama_pembeli }}
                                        </option>
                                    @endforeach --}}
                            {{-- </select>
                            </div><!-- end col--> --}}
                        </div>
                        <hr>

                        <table id="mytable" class="table dt-responsive nowrap scroll-vertical scroll-horizontal">
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
                        </table>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
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
                    <form id="form-tambah" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <label for="inputCity" class="form-label">Nama Karyawan</label>
                                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan"
                                        required>
                                    <input type="hidden" class="form-control" id="id_karyawan" name="id_karyawan">
                                </div>
                                <div class="col-4">
                                    <label for="inputCity" class="form-label">Kode Karyawan</label>
                                    <input type="text" class="form-control" id="kode_karyawan" name="kode_karyawan"
                                        required>
                                </div>
                                <div class="col-4">
                                    <label for="inputCity" class="form-label">Nomor Telephone</label>
                                    <input type="text" class="form-control" id="no_tlp_karyawan" name="no_tlp_karyawan"
                                        required>
                                </div>
                            </div>
                            <label for="inputCity" class="form-label">Alamat</label>
                            <textarea class="form-control" id="almt_karyawan" rows="5" name="almt_karyawan" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
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
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah Data</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <label for="inputCity" class="form-label">Nama Karyawan</label>
                                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan"
                                        required>
                                    <input type="hidden" class="form-control" id="id_karyawan" name="id_karyawan">
                                </div>
                                <div class="col-4">
                                    <label for="inputCity" class="form-label">Kode Karyawan</label>
                                    <input type="text" class="form-control" id="kode_karyawan" name="kode_karyawan"
                                        required>
                                </div>
                                <div class="col-4">
                                    <label for="inputCity" class="form-label">Nomor Telephone</label>
                                    <input type="text" class="form-control" id="no_tlp_karyawan"
                                        name="no_tlp_karyawan" required>
                                </div>
                            </div>
                            <label for="inputCity" class="form-label">Alamat</label>
                            <textarea class="form-control" id="almt_karyawan" rows="5" name="almt_karyawan" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('js')
    <script type="text/javascript">
        let list_data = [];
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
            'dom': "lBfrtip",
            'buttons': [

                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    },
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt')
                            .prepend(
                                '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAAuCAYAAACxkOBzAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OTEzRTdEQkUxM0U1MTFFNTg3REFBQzExQTNBQTE1MTgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OTEzRTdEQkYxM0U1MTFFNTg3REFBQzExQTNBQTE1MTgiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5MTNFN0RCQzEzRTUxMUU1ODdEQUFDMTFBM0FBMTUxOCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5MTNFN0RCRDEzRTUxMUU1ODdEQUFDMTFBM0FBMTUxOCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pmq0p78AAArESURBVHjarFl5bBTn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" style="position:absolute; top:0; left:0;" />'
                            );

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    },



                },
                {
                    extend: "collection",
                    text: "Save",
                    buttons: [{
                            extend: 'csv',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            },

                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            },
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                $('row c[r*="2"]', sheet).attr('s', '25');
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                var numrows = 3;
                                var clR = $('row', sheet);

                                //update Row
                                clR.each(function() {
                                    var attr = $(this).attr('r');
                                    var ind = parseInt(attr);
                                    ind = ind + numrows;
                                    $(this).attr("r", ind);
                                });

                                // Create row before data
                                $('row c ', sheet).each(function() {
                                    var attr = $(this).attr('r');
                                    var pre = attr.substring(0, 1);
                                    var ind = parseInt(attr.substring(1, attr.length));
                                    ind = ind + numrows;
                                    $(this).attr("r", pre + ind);
                                });

                                function Addrow(index, data) {
                                    msg = '<row r="' + index + '">'
                                    for (i = 0; i < data.length; i++) {
                                        var key = data[i].key;
                                        var value = data[i].value;
                                        msg += '<c t="inlineStr" r="' + key + index + '">';
                                        msg += '<is>';
                                        msg += '<t>' + value + '</t>';
                                        msg += '</is>';
                                        msg += '</c>';
                                    }
                                    msg += '</row>';
                                    return msg;
                                }


                                //insert
                                var r1 = Addrow(2, [{
                                    key: 'A',
                                    value: 'gdgsgds'
                                }, {
                                    key: 'B',
                                    value: 'sgsdgd'
                                }]);
                                var r2 = Addrow(3, [{
                                    key: 'A',
                                    value: 'dga'
                                }, {
                                    key: 'B',
                                    value: ''
                                }]);
                                var r3 = Addrow(4, [{
                                    key: 'A',
                                    value: 'dsg'
                                }, {
                                    key: 'B',
                                    value: 'dsgsds'
                                }]);

                                sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2 + r3 + sheet
                                    .childNodes[0].childNodes[1].innerHTML;
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            },
                            customize: function(doc) {
                                doc.content.splice(1, 0, {
                                    margin: [0, 0, 0, 12],
                                    alignment: 'center',
                                    image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAAuCAYAAACxkOBzAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OTEzRTdEQkUxM0U1MTFFNTg3REFBQzExQTNBQTE1MTgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OTEzRTdEQkYxM0U1MTFFNTg3REFBQzExQTNBQTE1MTgiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5MTNFN0RCQzEzRTUxMUU1ODdEQUFDMTFBM0FBMTUxOCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5MTNFN0RCRDEzRTUxMUU1ODdEQUFDMTFBM0FBMTUxOCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pmq0p78AAArESURBVHjarFl5bBTn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'
                                });
                            }


                        },
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            },
                        }

                    ]


                }
            ],
            "order": [
                [1, "asc"]
            ],
            "ajax": {
                url: "{{ url('list_master_data_target') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}",
                        d.dari = $("#filter-tanggal-dari").val(),
                        d.sampai = $("#filter-tanggal-sampai").val()
                }
            },
            "columnDefs": [{
                "targets": 0,
                "data": "id",
                "sortable": false,
                "render": function(data, type, row, meta) {
                    list_data[row.id_karyawan] = row;
                    return meta.row + meta.settings._iDisplayStart + 1;
                    // console.log(list_siswa)
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
                "data": "tgl_mulai",
                "sortable": false,
                "render": function(data, type, row, meta) {
                    return data + ` sd ` + row.tgl_akhir;

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
            }]
        });

        function filter() {
            table.ajax.reload(null, false)
        }
    </script>
@stop
