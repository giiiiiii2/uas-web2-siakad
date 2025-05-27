<x-layouts.app>
    <div class="max-w-7xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-semibold text-indigo-700 mb-6">Pilih Mata Kuliah</h2>

        <table class="min-w-full bg-white shadow-md rounded">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Kode</th>
                    <th class="py-3 px-4 text-left">Mata Kuliah</th>
                    <th class="py-3 px-4 text-left">SKS</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matakuliah as $mk)
                    <tr class="border-b {{ $loop->even ? 'bg-gray-50' : '' }}">
                        <td class="py-3 px-4">{{ $mk->kode }}</td>
                        <td class="py-3 px-4">{{ $mk->nama }}</td>
                        <td class="py-3 px-4">{{ $mk->sks }}</td>
                        <td class="py-3 px-4">
                            <form method="POST" action="{{ route('mahasiswa.krs.simpan') }}">
                                @csrf
                                <input type="hidden" name="mata_kuliah_id" value="{{ $mk->id }}">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                                    Ambil
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-3 px-4 text-center text-gray-500">Tidak ada mata kuliah tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
