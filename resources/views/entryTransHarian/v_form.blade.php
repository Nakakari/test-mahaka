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
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tambah Data</h4>
                    <form id="form-tambah" enctype="multipart/form-data" method="POST" action="/add_entry">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="inputCity" class="form-label">Kode Rekening</label>
                                <!-- Multiple Select -->
                                <select class="select2 form-control select2-multiple" data-toggle="select2"
                                    multiple="multiple" data-placeholder="Pilih Rekening ..." name="kode_rekening[]"
                                    id="kode_rekening">
                                    @foreach ($rekening as $p)
                                        <option value="{{ $p->id }}"
                                            {{ old('kode_rekening') == $p->id ? 'selected' : '' }}>[{{ $p->kode_rekening }}]
                                            {{ $p->nama_rekening }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback-kode_rekening feedback"></div>
                                @if ($errors->has('kode_rekening'))
                                    <span class="text-danger">{{ $errors->first('kode_rekening') }}</span>
                                @endif
                            </div>
                            <div class="col-4 mb-2">
                                <label for="inputCity" class="form-label">Via Bayar</label>
                                <select class="form-control select2" data-toggle="select2" id="via_bayar" name="via_bayar"
                                    required>
                                    <option disabled selected>--Via Bayar--</option>
                                    @foreach ($via_bayar as $v)
                                        <option value="{{ $v->id }}"
                                            {{ old('via_bayar') == $v->id ? 'selected' : '' }}>{{ $v->via_bayar }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 mb-2">
                                <label for="inputCity" class="form-label">Tanggal Setor</label>
                                <input type="date" class="form-control" id="tgl_setor" name="tgl_setor"
                                    value="{{ old('tgl_setor') }}" required>
                                <div class="invalid-feedback-tgl_setor feedback"></div>
                                @if ($errors->has('tgl_setor'))
                                    <span class="text-danger">{{ $errors->first('tgl_setor') }}</span>
                                @endif
                            </div>
                            <div class="col-4 mb-2">
                                <label for="inputCity" class="form-label">Jumlah Setor</label>
                                <input type="number" class="form-control" id="jml_bayar" name="jml_bayar"
                                    value="{{ old('jml_bayar') }}" required>
                                <div class="invalid-feedback-jml_bayar feedback"></div>
                                @if ($errors->has('jml_bayar'))
                                    <span class="text-danger">{{ $errors->first('jml_bayar') }}</span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" id="btnSave">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Validasi Form
            $('#tgl_setor').on('input', function() {
                var instansi = $(this).val();
                if (instansi.length == 0) {
                    $('.invalid-feedback-tgl_setor').addClass('invalid-msg').text(
                        "Data dimohon tidak boleh kosong!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else {
                    $('.invalid-feedback-tgl_setor').empty();
                    $(this).addClass('is-valid').removeClass('is-invalid');
                }
            });
            $('#jml_bayar').on('input', function() {
                var instansi = $(this).val();
                if (instansi.length == 0) {
                    $('.invalid-feedback-jml_bayar').addClass('invalid-msg').text(
                        "Data dimohon tidak boleh kosong!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else {
                    $('.invalid-feedback-jml_bayar').empty();
                    $(this).addClass('is-valid').removeClass('is-invalid');
                }
            });
            $('#target').on('input', function() {
                var instansi = $(this).val();
                if (instansi.length == 0) {
                    $('.invalid-feedback-target').addClass('invalid-msg').text(
                        "Data dimohon tidak boleh kosong!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else if (instansi <= 0) {
                    $('.invalid-feedback-target').addClass('invalid-msg').text(
                        "Invalid data!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else if (instansi.length >= 20) {
                    $('.invalid-feedback-target').addClass('invalid-msg').text(
                        "Invalid data!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else {
                    $('.invalid-feedback-target').empty();
                    $(this).addClass('is-valid').removeClass('is-invalid');
                }
            });
        });
    </script>
@stop
