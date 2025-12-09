<div class="tabel">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th colspan="3">Antrian Belum Dipanggil</th>
            </tr>
            <tr>
                <th>Nomor Antrian</th>
                <th>Loket</th>
                <th>Panggil</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select class="form-select" aria-label="Default select example" id="kodeantrian1">
                        <option selected disabled>Pilih Antrian</option>
                        @foreach ($antrian as $antrians)
                        <option value="{{ $antrians->id }}">{{ $antrians->no_antrian }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-select" aria-label="Default select example" id="loket">
                        <option selected disabled>Pilih Loket</option>
                        @foreach ($loket as $loket)
                        <option value="{{ $loket->id }}">{{ $loket->nama_loket }}</option>
                        @endforeach
                    </select>
                </td>
                <td><button class="panggil" id="panggil"><span class="icomoon-free--mic"></span></button></td>
            </tr>
        </tbody>


        <thead>
            <tr>
                <th colspan="3">Panggil Ulang</th>
            </tr>
            <tr>
                <th>Nomor Antrian</th>
                {{-- <th>Loket</th> --}}
                <th>Panggil</th>
                <th>Selesai</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    <select class="form-select" aria-label="Default select example" id="kodeantrian11">
                        <option selected disabled>Pilih Antrian</option>
                        @foreach ($antriansudahpanggil as $antriansudahpanggil)
                        <option value="{{ $antriansudahpanggil->id }}">{{ $antriansudahpanggil->no_antrian }}</option>
                        @endforeach
                    </select>
                </td>
                {{-- <td>
                        <select class="form-select" aria-label="Default select example" id="loket1">
                            <option selected disabled>Pilih Loket</option>
                            @foreach ($loket1 as $lokets)
                            <option value="{{ $lokets->id }}">{{ $lokets->nama_loket }}</option>
                @endforeach
                </select>
                </td> --}}
                <td><button class="panggil" id="call"><span class="icomoon-free--mic"></span></button></td>
                <td><button class="selesai" id="selesai">Selesai</button></td>
            </tr>
        </tbody>
    </table>

</div>