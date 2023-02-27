<table class="table col-7">
    <tr class="text-center">
        <th>NO</th>
        <th>NAMA ANGGOTA</th>
        <th>TANGGAL MASUK</th>
        <th>SIMPANAN WAJIB</th>
        <th>SIMPANAN POKOK</th>
        <th>SIMPANAN SUKARELA</th>
        <th>ACTION</th>
    </tr>
    @foreach ($anggotas as $anggota)
        <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $anggota->name }}</td>
            <td>{{ $anggota->created_at }}</td>
            <td>{{ $anggota->simpanan_wajib }}</td>
            <td> @format($anggota->simpanan_pokok) </td>
            <td> @format($anggota->simpanan_sukarela) </td>

            <td>
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/anggota/{{ Crypt::encryptString($anggota->id) }}">Lihat
                                Detail</a>
                        </li>
                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#edit{{ $anggota->id }}">Edit</button>
                        </li>

                        <li><button type="button" class="dropdown-item disable"
                                @if (intval($anggota->simpanan_pokok) !== 0) @disabled(true) @endif data-bs-toggle="modal"
                                data-bs-target="#simpananpokok{{ $anggota->id }}">Setor Simpanan
                                Pokok</button></li>
                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#simpananwajib{{ $anggota->id }}">Setor Simpanan
                                Wajib</button></li>
                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#simpanansukarela{{ $anggota->id }}">Setor Simpanan
                                Sukarela</button></li>
                        <li><a class="dropdown-item" href="#">Keluar ?</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        <!-- Modal simpanan Pokok -->
        <div class="modal fade" id="simpananpokok{{ $anggota->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <form action="{{ route('simpanan.pokok.store') }}" method="post">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Simpanan Pokok</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ID</label>
                                <input readonly type="text" name="id" placeholder="Contoh: 500000 "
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    value="{{ $anggota->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input readonly type="text" name="name"
                                    placeholder="Contoh: KOPERASI SUBUR MAKMUR" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $anggota->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Simpanan Pokok</label>
                                <input type="text" name="simpanan_pokok" placeholder="Contoh: 500000 "
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal simpanan wajib -->
        <div class="modal fade" id="simpananwajib{{ $anggota->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{ route('simpanan.wajib.store') }}" method="post">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Simpanan wajib</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ID</label>
                                <input readonly type="text" name="id" placeholder="Contoh: 500000 "
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    value="{{ $anggota->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input readonly type="text" name="name"
                                    placeholder="Contoh: KOPERASI SUBUR MAKMUR" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                    value="{{ $anggota->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Simpanan wajib</label>
                                <input type="text" name="simpanan_wajib" placeholder="Contoh: 500000 "
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal simpanan sukarela -->
        <div class="modal fade" id="simpanansukarela{{ $anggota->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{ route('simpanan.sukarela.store') }}" method="post">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Simpanan sukarela</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ID</label>
                                <input readonly type="text" name="id" placeholder="Contoh: 500000 "
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    value="{{ $anggota->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input readonly type="text" name="name"
                                    placeholder="Contoh: KOPERASI SUBUR MAKMUR" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                    value="{{ $anggota->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Simpanan
                                    sukarela</label>
                                <input type="text" name="simpanan_sukarela" placeholder="Contoh: 500000 "
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal edit anggota -->
        <div class="modal fade" id="edit{{ $anggota->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <form action="{{ route('anggota.update') }}" method="post">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Anggota</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input type="text" name="name" placeholder="Contoh: KOPERASI SUBUR MAKMUR"
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    value="{{ $anggota->name }}">
                            </div>
                            <input type="hidden" value="{{ $anggota->id }}" name="id">
                            {{-- <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Simpanan Wajib</label>
                                <input type="text" name="simpanan_Wajib" placeholder="Contoh: 500000 "
                                    class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $anggota->simpanan_Wajib }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Simpanan Pokok</label>
                                <input type="text" name="simpanan_pokok" placeholder="Contoh: 500000 "
                                    class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $anggota->simpanan_pokok }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">SImpanan
                                    Sukarela</label>
                                <input type="text" name="simpanan_sukarela"
                                    placeholder="Contoh: 500000 " class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                    value="{{ $anggota->simpanan_sukarela }}">
                            </div> --}}
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Masuk</label>
                                <input type="date" name="created_at" placeholder="Contoh: 500000 "
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    value="{{ \Carbon\Carbon::parse($anggota->created_at)->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </tr>
    @endforeach
</table>
