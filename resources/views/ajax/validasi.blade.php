<table class="table col-7" id="hasil">
    <tr class="text-center">
        <th>NO</th>
        <th>NAMA</th>
        <th>ID PINJAMAN</th>
        <th>TOTAL PINJAMAN</th>
        <th>LAMA PINJAMAN</th>
        <th>BUNGA</th>
        <th>STATUS</th>
        <th>ACTION</th>
    </tr>
    @foreach ($pinjaman as $p)
    <tr class="text-center">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->user->name }}</td>
        <td>{{ $p->id }}</td>
        <td>@currency($p->nominal_pinjaman)</td>
        <td>{{ $p->lama_pinjaman }} Bulan</td>
        <td>{{ $p->bunga }} %</td>
        <td> @if ($p->status_pinjaman == 'Menunggu Verifikasi')
            <button class="btn btn-warning text-white">{{ $p->status_pinjaman }}</button> 
        @elseif($p->status_pinjaman == 'Aktif')
        <button class="btn btn-danger text-white">{{ $p->status_pinjaman }}</button> 
        @elseif($p->status_pinjaman == 'Selesai')
        <button class="btn btn-primary text-white">{{ $p->status_pinjaman }}</button> 
        @endif
            {{-- <button class="btn btn-warning text-white">Aktif</button>  --}}
        </td>
        <td>
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Action
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <form action="/validasi-pinjaman/{{ $p->id }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Validasi</button>
                        </form>
                    </li>
                    <li>
                        <a class="dropdown-item" href="">Lihat Detail</a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
        
    @endforeach
  
</table>