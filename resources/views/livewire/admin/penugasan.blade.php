<div>
    @section('styles')
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan Anda */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .event {
            background-color: #f2f2f2;
            padding: 5px;
            margin-top: 5px;
        }

        /* Gaya untuk bulan sebelumnya */
        td.prev-month {
            color: #aaa;
        }

        /* Gaya untuk bulan setelahnya */
        td.next-month {
            color: #aaa;
            /* Warna abu-abu */
            /* opacity: 0.7; Transparansi rendah */
        }

        /* Gaya untuk tanggal hari ini */
        td.today {
            /* border-radius: 50%; */
            background-color: #8aff8a;
        }

        td:hover {
            cursor: pointer;
            background-color: #6BFFF8;
        }

        /* Gaya untuk hari libur */
        td.holiday {
            background-color: red;
            color: white
                /* Warna merah untuk hari libur */
        }

        td.prev-month.disabled {
            color: #ccc;
            /* Warna abu-abu untuk menunjukkan bahwa tidak dapat diklik */
            cursor: not-allowed;
        }

        /* Gaya untuk bulan setelahnya yang tidak dapat diklik */
        td.next-month.disabled {
            color: #ccc;
            /* Warna abu-abu untuk menunjukkan bahwa tidak dapat diklik */
            cursor: not-allowed;
        }

    </style>
    @endsection
    <div>
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Penugasan</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            @include('livewire.alert')
                        </div>
                    </div>
                    <div>
                        <div class="content-wrapper">
                            <section class="content">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-2 d-flex justify-content-between">
                                            <button class="btn btn-primary mr-2" wire:click="previousMonth">&lt;</button>
                                            <span class="font-weight-bold">{{ $monthName }} {{ $year }}</span>
                                            <button class="btn btn-primary ml-2" wire:click="nextMonth">&gt;</button>
                                        </div>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    @foreach($daysOfWeek as $day)
                                                    <th>{{ $day }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($calendar as $week)
                                                <tr>
                                                    @foreach($week as $day)
                                                    @php
                                                    $isHoliday = $day['isHoliday'];
                                                    $isNextMonth = $day['isNextMonth'];
                                                    $isPrevMonth = $day['isPrevMonth'];
                                                    @endphp
                                                    <td class="{{ $isPrevMonth ? 'prev-month' : '' }}  {{ isset($day['today']) ? 'today' : '' }} {{ $isHoliday ? 'holiday' : '' }} {{ $isNextMonth ? 'next-month' : '' }}" @if (!$isHoliday) wire:show="selectDate('{{ $day['day'] }}')" @elseif ( $isHoliday) wire:click="$dispatch('hapusLibur',{{ $day['day'] }})" @endif>
                                                        <div>
                                                            <span>{{ $day['day'] }}</span>
                                                            @foreach($day['events'] as $event)
                                                            <div class="event">{{ $event }}</div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="my-3">
                                            <span>Keterangan :</span>
                                            @foreach($listPenjualan as $holiday)
                                            <div class="my-2">
                                                <span class="text-{{ $holiday->status == 'selesai' ? 'success' : 'danger' }} text-uppercase">
                                                    {{ date('d-m-Y', strtotime($holiday->tanggal_pengantaran)) }}
                                                </span> :
                                                <span class=" text-uppercase">{{ $holiday->pelanggan->nama }} ({{ $holiday->pelanggan->alamat }}/ {{ $holiday->pelanggan->telepon }})
                                                    || <span class="badge badge-dark text-uppercase">Ke: {{ $holiday->alamat_pengantaran }}</span>
                                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $holiday->lat }},{{ $holiday->long }}" class="btn text-success" target="_blank">
                                                        <span class="badge badge-success text-uppercase"> <i class="fas fa-map-marker-alt"></i>Google Maps</span>
                                                    </a>
                                                </span>
                                                <br>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        @foreach($holiday->penugasan as $penugasan)
                                                        <span class="text-uppercase badge badge-{{ $penugasan->status == 'selesai' ? 'success' : 'danger' }}" data-toggle="tooltip" data-placement="top" title="Status: {{ strtoupper($penugasan->status) }}">
                                                            {{ $penugasan->kendaraan->nama_supir }} - {{ $penugasan->kendaraan->telepon_supir }} ({{ $penugasan->jumlah_truk}} Truk)
                                                        </span>
                                                        @endforeach
                                                    </div>
                                                    @if ($holiday->penugasan->where('status', 'belum')->count() > 0)
                                                    <button class="btn btn-sm btn-danger" wire:click="selesai('{{ $holiday->id }}')">
                                                        <i class="fas fa-check"></i> Selesai
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </section>
                            {{-- @if ($selectedDate) --}}
                            <div wire:ignore.self class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dateModalLabel">Masukkan Event Untuk Tanggal Ini</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="mb-">
                                                <label for="">Keterangan Hari Libur</label>
                                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" wire:model="keterangan" placeholder="Masukkan Keterangan Hari Libur">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-primary" wire:click="simpanHariLibur">Simpan</button>
                                            <!-- Tambahkan tombol atau aksi lainnya sesuai kebutuhan -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('message'))
        <script>
            const Toast = Swal.mixin({
                toast: true
                , position: 'top-end'
                , showConfirmButton: false
                , timer: 3000
            , })

            Toast.fire({
                icon: 'success'
                , title: '{{session('
                message ')}}'
            });

        </script>
        @endif


        @push('script-kalender')
        <script>
            $wire.on('openModal', () => {
                $('#dateModal').modal('show');
            });

        </script>
        @endpush

        @push('hapus')
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                @this.on('hapusLibur', id => {
                    Swal.fire({
                        title: 'Rubah hari libur?'
                        , text: 'Hari Libur ini akan dibatalkan!'
                        , icon: "warning"
                        , showCancelButton: true
                        , confirmButtonColor: '#3085d6'
                        , cancelButtonColor: '#aaa'
                        , confirmButtonText: 'Ya'
                        , cancelButtonText: 'Batal'
                    }).then((result) => {
                        //if user clicks on delete
                        if (result.value) {
                            // calling destroy method to delete
                            @this.call('hapusHariLibur', id)
                            // success response
                            Swal.fire({
                                title: 'Hari libur dibatalkan!'
                                , icon: 'success'
                            });
                        } else {
                            Swal.fire({
                                title: 'Batal!'
                                , icon: 'success'
                            });
                        }
                    });
                });
            })

        </script>
        @endpush
    </div>
