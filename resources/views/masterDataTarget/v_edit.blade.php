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
                    <h4 class="header-title">Edit Data</h4>
                    <form id="form-tambah" enctype="multipart/form-data" method="POST" action="/edit_master_data_target">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $id }}" />
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="inputCity" class="form-label">Kode Rekening</label>
                                <!-- Multiple Select -->
                                <select class="form-control select2" data-toggle="select2" id="kode_rekening"
                                    name="kode_rekening" required>
                                    <option disabled selected>--Cari Rekening--</option>
                                    @foreach ($rekening as $p)
                                        <option value="{{ $p->id }}"
                                            {{ old('kode_rekening', $items->kode_rekening) == $p->id ? 'selected' : '' }}>
                                            [{{ $p->kode_rekening }}]
                                            {{ $p->nama_rekening }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback-kode_rekening feedback"></div>
                                @if ($errors->has('kode_rekening'))
                                    <span class="text-danger">{{ $errors->first('kode_rekening') }}</span>
                                @endif
                            </div>
                            <div class="col-6 mb-2">
                                <label for="inputCity" class="form-label">Target (Rp)</label>
                                <input type="number" min="0" class="form-control" id="target" name="target"
                                    value="{{ old('target', $items->target) }}" required>
                                <div class="invalid-feedback-target feedback"></div>
                                @if ($errors->has('target'))
                                    <span class="text-danger">{{ $errors->first('target') }}</span>
                                @endif
                            </div>
                            <div class="col-6 mb-2">
                                <label for="inputCity" class="form-label">Masa Awal Berlaku</label>
                                <input type="date" class="form-control" id="awal_berlaku" name="awal_berlaku"
                                    value="{{ old('awal_berlaku', $items->tgl_mulai) }}" required>
                                <div class="invalid-feedback-awal_berlaku feedback"></div>
                                @if ($errors->has('awal_berlaku'))
                                    <span class="text-danger">{{ $errors->first('awal_berlaku') }}</span>
                                @endif
                            </div>
                            <div class="col-6 mb-2">
                                <label for="inputCity" class="form-label">Masa Akhir Berlaku</label>
                                <input type="date" class="form-control" id="akhir_berlaku" name="akhir_berlaku"
                                    value="{{ old('akhir_berlaku', $items->tgl_akhir) }}" required>
                                <div class="invalid-feedback-akhir_berlaku feedback"></div>
                                @if ($errors->has('akhir_berlaku'))
                                    <span class="text-danger">{{ $errors->first('akhir_berlaku') }}</span>
                                @endif
                            </div>
                        </div>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
            $('#awal_berlaku').on('input', function() {
                var instansi = $(this).val();
                if (instansi.length == 0) {
                    $('.invalid-feedback-awal_berlaku').addClass('invalid-msg').text(
                        "Data dimohon tidak boleh kosong!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else {
                    $('.invalid-feedback-awal_berlaku').empty();
                    $(this).addClass('is-valid').removeClass('is-invalid');
                }
            });
            $('#akhir_berlaku').on('input', function() {
                var instansi = $(this).val();
                if (instansi.length == 0) {
                    $('.invalid-feedback-akhir_berlaku').addClass('invalid-msg').text(
                        "Data dimohon tidak boleh kosong!");
                    $(this).addClass('is-invalid').removeClass('is-valid');
                } else {
                    $('.invalid-feedback-akhir_berlaku').empty();
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
