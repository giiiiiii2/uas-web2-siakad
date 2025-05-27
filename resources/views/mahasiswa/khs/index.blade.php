<x-layouts.app>
    <div class="max-w-7xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-semibold text-indigo-700 mb-6">Kartu Hasil Studi (KHS)</h2>

        <table class="min-w-full bg-white shadow-md rounded">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Mata Kuliah</th>
                    <th class="py-3 px-4 text-left">SKS</th>
                    <th class="py-3 px-4 text-left">Semester</th>
                    <th class="py-3 px-4 text-left">Nilai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($khs as $item)
                    <tr class="border-b {{ $loop->even ? 'bg-gray-50' : '' }}">
                        <td class="py-3 px-4">{{ $item['mata_kuliah'] }}</td>
                        <td class="py-3 px-4">{{ $item['sks'] }}</td>
                        <td class="py-3 px-4">{{ $item['semester'] }}</td>
                        <td class="py-3 px-4">{{ $item['nilai'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-3 px-4 text-center text-gray-500">Belum ada data KHS.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
