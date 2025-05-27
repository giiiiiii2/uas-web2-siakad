<x-layouts.app>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-6">Ganti Mata Kuliah KRS</h2>

        <div class="mb-4">
            <p class="text-gray-700">Mata kuliah saat ini: <strong>{{ $krs->mata_kuliah }}</strong></p>
            <p class="text-gray-700">Semester: <strong>{{ $krs->semester }}</strong></p>
        </div>

        <div class="bg-white shadow-md rounded p-6">
            <table class="min-w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Kode</th>
                        <th class="py-2 px-4 border-b">Mata Kuliah</th>
                        <th class="py-2 px-4 border-b">SKS</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliah as $mk)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $mk->kode }}</td>
                            <td class="py-2 px-4 border-b">{{ $mk->nama }}</td>
                            <td class="py-2 px-4 border-b">{{ $mk->sks }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <form action="{{ route('krs.update', $krs->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="mata_kuliah" value="{{ $mk->nama }}">
                                    <input type="hidden" name="sks" value="{{ $mk->sks }}">
                                    <input type="hidden" name="semester" value="{{ $krs->semester }}">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                        Ganti
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                <a href="{{ route('krs.index') }}" class="text-blue-500 hover:underline">Kembali ke daftar KRS</a>
            </div>
        </div>
    </div>
</x-layouts.app>
