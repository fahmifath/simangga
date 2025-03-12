<x-filament::page>
    <div>
        <h1 class="text-2xl font-bold mb-4">Hierarki Data</h1>

        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 p-2 w-10"></th> <!-- Tombol Toggle -->
                    <th class="border border-gray-300 p-2 w-40">Kode</th>
                    <th class="border border-gray-300 p-2">Nama</th>
                    <th class="border border-gray-300 p-2 w-20">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop Data RO -->
                @foreach ($ros as $ro)
                    <tr class="bg-white">
                        <td class="border border-gray-300 p-2 text-center">
                            <button wire:click="toggleExpand('ro', {{ $ro->id }})">
                                <span class="text-lg">
                                    {{ $expanded['ro'][$ro->id] ?? false ? '▼' : '▶' }}
                                </span>
                            </button>
                        </td>
                        <td class="border border-gray-300 p-2 text-center">{{ $ro->kode }}</td>
                        <td class="border border-gray-300 p-2">{{ $ro->ro }}</td>
                        <td class="border border-gray-300 p-2 text-center">
                            <button wire:click="openModal(null, 'ro')"
                                class="bg-blue-500 text-black px-2 py-1 rounded">Tambah</button>
                        </td>
                    </tr>

                    @if ($expanded['ro'][$ro->id] ?? false)
                        @foreach ($ro->komponens as $komponen)
                            <tr class="bg-gray-100">
                                <td class="border border-gray-300 p-2 text-center">
                                    <button wire:click="toggleExpand('komponen', {{ $komponen->id }})">
                                        <span class="text-lg">
                                            {{ $expanded['komponen'][$komponen->id] ?? false ? '▼' : '▶' }}
                                        </span>
                                    </button>
                                </td>
                                <td class="border border-gray-300 p-2 text-center">{{ $komponen->kode }}</td>
                                <td class="border border-gray-300 p-2">{{ $komponen->komponen }}</td>
                                <td class="border border-gray-300 p-2 text-center">
                                    <button wire:click="openModal({{ $ro->id }}, 'komponen')"
                                        class="bg-green-500 text-black px-2 py-1 rounded">Tambah</button>
                                </td>
                            </tr>

                            @if ($expanded['komponen'][$komponen->id] ?? false)
                                @foreach ($komponen->subKomponens as $subKomponen)
                                    <tr class="bg-gray-200">
                                        <td class="border border-gray-300 p-2 text-center">
                                            <button wire:click="toggleExpand('subKomponen', {{ $subKomponen->id }})">
                                                <span class="text-lg">
                                                    {{ $expanded['subKomponen'][$subKomponen->id] ?? false ? '▼' : '▶' }}
                                                </span>
                                            </button>
                                        </td>
                                        <td class="border border-gray-300 p-2t text-center">{{ $subKomponen->kode }}</td>
                                        <td class="border border-gray-300 p-2">{{ $subKomponen->sub_komponen }}</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            <button wire:click="openModal({{ $komponen->id }}, 'subKomponen')"
                                                class="bg-yellow-500 text-black px-2 py-1 rounded">Tambah</button>
                                        </td>
                                    </tr>

                                    @if ($expanded['subKomponen'][$subKomponen->id] ?? false)
                                        @foreach ($subKomponen->detils as $detil)
                                            <tr class="bg-gray-300">
                                                <td class="border border-gray-300 p-2 text-center">
                                                    <button wire:click="toggleExpand('detil', {{ $detil->id }})">
                                                        <span class="text-lg">
                                                            {{ $expanded['detil'][$detil->id] ?? false ? '▼' : '▶' }}
                                                        </span>
                                                    </button>
                                                </td>
                                                <td class="border border-gray-300 p-2 text-center">{{ $detil->kode }}</td>
                                                <td class="border border-gray-300 p-2">{{ $detil->detil }}</td>
                                                <td class="border border-gray-300 p-2 text-center">
                                                    <button wire:click="openModal({{ $subKomponen->id }}, 'detil')"
                                                        class="bg-red-500 text-black px-2 py-1 rounded">Tambah</button>
                                                </td>
                                            </tr>

                                            @if ($expanded['detil'][$detil->id] ?? false)
                                                @foreach ($detil->subDetils as $subDetil)
                                                    <tr class="bg-gray-400">
                                                        <td class="border border-gray-300 p-2"></td>
                                                        <td class="border border-gray-300 p-2"></td>
                                                        <td class="border border-gray-300 p-2">
                                                            {{ $subDetil->sub_detil }}</td>
                                                        <td class="border border-gray-300 p-2 text-center">
                                                            <button
                                                                wire:click="openModal({{ $detil->id }}, 'subDetil')"
                                                                class="bg-purple-500 text-black px-2 py-1 rounded">Tambah</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        @if ($modalOpen)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-lg font-semibold mb-4">Tambah {{ ucfirst($modalType) }}</h2>

                    @if ($modalType !== 'subDetil')
                        <label class="block text-sm font-medium mb-1">Kode:</label>
                        <input type="text" wire:model="modalKode" class="w-full p-2 border rounded mb-3">
                    @endif

                    <label class="block text-sm font-medium mb-1">Nama:</label>
                    <input type="text" wire:model="modalName" class="w-full p-2 border rounded mb-3">

                    <div class="flex justify-end space-x-2">
                        <button wire:click="closeModal" class="bg-gray-500 text-black px-4 py-2 rounded">Batal</button>
                        <button wire:click="saveData" class="bg-blue-600 text-black px-4 py-2 rounded">Simpan</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-filament::page>
