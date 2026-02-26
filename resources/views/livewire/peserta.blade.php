<div class="flex gap-4">
    <div class="w-5/12">
        <div class="bg-white p-4 rounded-lg">
            <div class="mx-auto border-b border-gray-200 pb-2">
                <h2 class="text-center text-xl/9 font-bold tracking-tight ">
                    @if ($isEditing)
                        Update Peserta
                    @else
                        Create New Peserta
                    @endif
                </h2>
            </div>
            <div class="mt-10">
                @if (session('success'))
                    <div class="p-4 mt-6 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
            </div>

            <form wire:submit='createNewPeserta' action="#" method="POST" class="space-y-6">
                <div class="flex gap-5">
                    <div class="w-1/2">
                        <div>
                            <label for="nik" class="block text-sm/6 font-medium text-gray-900">NIK</label>
                            <div class="mt-2">
                                <input wire:model="nik" id="nik" type="number" name="nik" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('nik')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="nama" class="block text-sm/6 font-medium text-gray-900">Nama</label>
                            <div class="mt-2">
                                <input wire:model="nama" id="nama" type="text" name="nama" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('nama')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                            <div class="mt-2">
                                <input wire:model="email" id="email" type="email" name="email" required autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('email')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="mt-5">
                            <label for="telepon" class="block text-sm/6 font-medium text-gray-900">Telepon</label>
                            <div class="mt-2">
                                <input wire:model="telepon" id="telepon" type="number" name="telepon" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('telepon')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="tempat_lahir" class="block text-sm/6 font-medium text-gray-900">Tempat Lahir</label>
                            <div class="mt-2">
                                <input wire:model="tempat_lahir" id="tempat_lahir" type="text" name="tempat_lahir" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('tempat_lahir')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="tanggal_lahir" class="block text-sm/6 font-medium text-gray-900">Tanggal Lahir</label>
                            <div class="mt-2">
                                <input wire:model="tanggal_lahir" id="tanggal_lahir" type="date" name="tanggal_lahir" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('tanggal_lahir')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <div class="">

                            <label for="sertifikat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sertifikat</label>
                            <select wire:model.live="sertifikat_id" id="sertifikat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Pilih Sertifikat</option>
                                @foreach ($sertifikats as $sertifikat)
                                    <option value="{{ $sertifikat->id }}">{{ $sertifikat->judul }}</option>
                                @endforeach
                            </select>

                            @error('sertifikat_id')
                                <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <label for="batch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Batch</label>
                            <select wire:model.live="batch_id" wire:key='batch-{{ $sertifikat_id }}' id="batch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Pilih Batch</option>
                                @foreach ($batches as $batch)
                                    {{-- <option value="{{ (string) $batch->id }}">{{ $batch->kode_batch }}</option> --}}
                                    <option value="{{ $batch->id }}">{{ $batch->kode_batch }}</option>
                                @endforeach
                            </select>
                            @error('batch_id')
                                <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <label for="no_sertifikat" class="block text-sm/6 font-medium text-gray-900">Nomor Sertifikat</label>
                            <div class="mt-2">
                                <input wire:model="no_sertifikat" id="no_sertifikat" type="text" name="no_sertifikat" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('no_sertifikat')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 col-span-full">
                            <label for="foto-peserta" class="block text-sm/6 font-medium text-gray-900">Foto Peserta</label>

                            @if ($isEditing && $oldFoto)
                                <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <p class="text-sm text-blue-900 font-medium mb-2">Current Avatar:</p>
                                    <img src="{{ asset('storage/' . $oldFoto) }}" class="rounded w-20 h-20 object-cover">
                                </div>
                            @endif

                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-6">
                                <div class="text-center">
                                    <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                        <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm/6 text-gray-600">
                                        <label for="foto" class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input wire:model="foto" id="foto" type="file" name="foto" class="sr-only" accept="image/png, image/jpg, image/jpeg" />
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs/5 text-gray-600">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>
                            @error('foto')
                                <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div wire:loading wire:target="foto" class="flex items-center justify-center w-20 h-20 border border-gray-200 rounded-lg bg-gray-50 ">
                            <div class="px-2 py-1 text-[10px] font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse">loading...</div>
                        </div> {{-- wire loading untuk menampilkan animasi loading sementara wire target hanya akan tampil animasinya untuk updating property foto saja tidak semua --}}

                        @if ($foto)
                            <p class="my-2 text-sm/6 font-medium fw-bold">Preview</p>
                            <img src="{{ $foto->temporaryUrl() }}" class="rounded w-20 h-20 block object-cover">{{-- temporaryUrl untuk mengambil nilai temporary URL dari file foto yang diupload sebelum distore ke storage --}}
                        @endif


                    </div>
                </div>

                <div class="flex gap-2">
                    <button wire:click.prevent='createNewPeserta' class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg wire:loading wire:target='createNewPeserta' aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-blue-600 self-center me-2" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                        @if ($isEditing)
                            Update Peserta
                        @else
                            Create New Peserta
                        @endif
                    </button>
                    @if ($isEditing)
                        <button wire:click="cancelEdit" type="button" class="flex flex-1 justify-center rounded-md bg-gray-300 px-3 py-1.5 text-sm/6 font-semibold text-gray-900 shadow-xs hover:bg-gray-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                            Cancel
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="w-7/12">
        <div class="bg-white p-4 rounded-lg">
            <div class="mx-auto border-b border-gray-200 pb-2">
                <h2 class="text-center text-xl/9 font-bold tracking-tight">Daftar Peserta</h2>
            </div>

            <div class="mt-10 mb-4">
                <input wire:model.live="search" type="text" placeholder="Search by nama or email..." class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600" />
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table wire:loading.delay.class='opacity-50' class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                NIK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                No Sertifikat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sertifikat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Batch
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Telepon
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesertas as $peserta)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $peserta->nik }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $peserta->nama }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $peserta->no_sertifikat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $peserta->batch->sertifikat->judul }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $peserta->batch->kode_batch }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $peserta->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $peserta->telepon }}
                                </td>
                                <td class="px-6 py-4">


                                    <a href="{{ route('sertifikat.download', ['no_sertifikat' => $peserta->no_sertifikat]) }}" class="px-3 py-1 text-xs font-medium text-yellow-600 bg-yellow-50 rounded hover:bg-yellow-100" target="_blank">
                                        Sertifikat
                                    </a>

                                    <button wire:click="editPeserta({{ $peserta->id }})" class="mt-2 px-3 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 rounded hover:bg-indigo-100">Edit</button>
                                    {{-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                                    <button wire:click="deletePeserta({{ $peserta->id }})" wire:confirm="Yakin hapus peserta ini?" class="px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded hover:bg-red-100 mt-1">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <p class="text-center text-gray-500">
                                    @if ($search)
                                        Tidak ada peserta yang cocok dengan "<strong>{{ $search }}</strong>"
                                    @else
                                        Tidak ada peserta
                                    @endif
                                </p>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $pesertas->onEachSide(0)->links() }}
            </div>
        </div>
    </div>

</div>
