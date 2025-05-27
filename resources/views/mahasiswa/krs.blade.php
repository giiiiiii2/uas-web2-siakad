<x-layouts.app>
    <div class="max-w-7xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-4">Kartu Rencana Studi Anda</h2>

        <a href="{{ route('mahasiswa.krs.create') }}" class="bg-green-600 text-white px-3 py-2 rounded mb-4 inline-block">+ Ambil Mata Kuliah</a>

        @if($krs->count() > 0)
        <table class="w-full border bg-white shadow">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="py-2 px-3">Kode</th>
                    <th class="py-2 px-3">Mata Kuliah</th>
                    <th class="py-2 px-3">SKS</th>
                    <th class="py-2 px-3">Dosen</th>
                    <th class="py-2 px-3">Hari</th>
                    <th class="py-2 px-3">Jam</th>
                    <th class="py-2 px-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($krs as $item)
                <tr class="border-b">
                    <td class="py-2 px-3">{{ $item->matakuliah->kode }}</td>
                    <td class="py-2 px-3">{{ $item->matakuliah->nama }}</td>
                    <td class="py-2 px-3">{{ $item->matakuliah->sks }}</td>
                    <td class="py-2 px-3">{{ $item->matakuliah->dosen }}</td>
                    <td class="py-2 px-3">{{ $item->matakuliah->hari }}</td>
                    <td class="py-2 px-3">{{ $item->matakuliah->jam }}</td>
                    <td class="py-2 px-3">
                        <form method="POST" action="{{ route('mahasiswa.krs.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>Belum ada mata kuliah yang diambil.</p>
        @endif
    </div>
</x-layouts.app>
