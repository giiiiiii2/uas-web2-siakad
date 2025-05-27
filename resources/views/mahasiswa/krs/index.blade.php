<x-layouts.app>
    <div class="max-w-7xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-indigo-700 mb-6">Daftar KRS</h2>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('krs.create') }}" class="mb-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah KRS
        </a>

        <table class="w-full bg-white rounded shadow-md">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Mata Kuliah</th>
                    <th class="py-3 px-4 text-left">SKS</th>
                    <th class="py-3 px-4 text-left">Semester</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($krs as $item)
                    <tr class="border-b">
                        <td class="py-3 px-4">
                            {{ $item->mata_kuliah ?? $item->matakuliah->nama ?? '-' }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $item->sks ?? $item->matakuliah->sks ?? '-' }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $item->semester ?? $item->matakuliah->semester ?? '-' }}
                        </td>
                        <td class="py-3 px-4 space-x-2 flex">
                            <a href="{{ route('krs.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('krs.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>az
    </div>
</x-layouts.app>
