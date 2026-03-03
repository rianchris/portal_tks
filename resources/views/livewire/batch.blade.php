<div class="flex justify-center gap-4">
    <div class="w-2/3">
        <div class="bg-white p-4 rounded-lg">
            <div class="mx-auto border-b border-gray-200 pb-2">
                <h2 class="text-center text-xl/9 font-bold tracking-tight ">
                    @if ($isEditing)
                        Update Batch
                    @else
                        Create New Batch
                    @endif
                </h2>
            </div>
            <div class="mt-10">
                @if (session('success'))
                    <div class="p-4 mt-6 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                <form wire:submit='createNewBatch' action="#" method="POST" class="space-y-6">
                    {{-- Batch Description --}}
                    <div class="flex gap-5">
                        <div class="w-1/2 space-y-3">
                            <div>
                                <label for="sertifikat" class="block text-sm/6 font-medium text-gray-900">Sertifikat</label>
                                <div class="mt-2">
                                    <select wire:model="sertifikat_id" id="sertifikat" name="sertifikat_id" class="block w-full rounded-md bg-white px-3 py-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        <option value="">Select Option</option>
                                        @foreach ($sertifikats as $sertifikatItem)
                                            <option value="{{ $sertifikatItem->id }}">{{ $sertifikatItem->judul_program }}</option>
                                        @endforeach
                                    </select>
                                    @error('sertifikat_id')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="deskripsi" class="block text-sm/6 font-medium text-gray-900">Deskripsi</label>
                                <div class="mt-2">
                                    {{-- ✅ Tidak  karena nullable di backend --}}
                                    <textarea wire:model="deskripsi" rows="10" id="deskripsi" name="deskripsi" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                    @error('deskripsi')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="w-1/2 space-y-3">
                            <div>
                                <label for="date_issued" class="block text-sm/6 font-medium text-gray-900">Date Issued</label>
                                <div class="mt-2">
                                    <input wire:model="date_issued" id="date_issued" type="date" name="date_issued" class="block w-full rounded-md bg-white px-3 py-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                    @error('date_issued')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="tanggal_mulai" class="block text-sm/6 font-medium text-gray-900">Tanggal Mulai</label>
                                <div class="mt-2">
                                    <input wire:model="tanggal_mulai" id="tanggal_mulai" type="date" name="tanggal_mulai" class="block w-full rounded-md bg-white px-3 py-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                    @error('tanggal_mulai')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="tanggal_selesai" class="block text-sm/6 font-medium text-gray-900">Tanggal Selesai</label>
                                <div class="mt-2">
                                    {{-- ✅ Tidak  karena nullable di backend --}}
                                    <input wire:model="tanggal_selesai" id="tanggal_selesai" type="date" name="tanggal_selesai" class="block w-full rounded-md bg-white px-3 py-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                    @error('tanggal_selesai')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>
                    {{-- Batch  Signature --}}
                    <hr class="border border-gray-300">
                    <div class="flex gap-5">
                        {{-- Pejabat Kiri --}}
                        <div class="w-1/2 space-y-5">
                            <div>
                                <label for="left_nama_pejabat" class="block text-sm/6 font-medium text-gray-900">Nama Pejabat Kiri</label>
                                <div class="mt-2">
                                    <input wire:model="left_nama_pejabat" id="left_nama_pejabat" type="text" name="left_nama_pejabat" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                    @error('left_nama_pejabat')
                                        <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="left_nama_jabatan" class="block text-sm/6 font-medium text-gray-900">Nama Jabatan Kiri</label>
                                <div class="mt-2">
                                    <input wire:model="left_nama_jabatan" id="left_nama_jabatan" type="text" name="left_nama_jabatan" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                    @error('left_nama_jabatan')
                                        <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            {{-- ================= Tanda Tangan ================= --}}
                            <div>
                                <label for="left_ttd_pejabat" class="block text-sm font-medium text-gray-900">TTD Kiri @if ($isEditing)
                                        <span class="text-xs text-gray-500">(Optional - leave empty to keep current)</span>
                                    @endif
                                </label>

                                @if ($isEditing && $old_left_ttd_pejabat)
                                    <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <div>
                                            <p class="text-sm text-blue-900 font-medium mb-2">Current TTD Kiri:</p>
                                            <button wire:click="clearImage('left_ttd_pejabat')" wire:confirm="Yakin hapus stamp kiri ini?" type="button" class="text-xs text-red-600 bg-red-50 hover:bg-red-100 px-2 py-1 rounded border border-red-200">
                                                🗑 Hapus
                                            </button>
                                        </div>
                                        <img src="{{ asset('storage/' . $old_left_ttd_pejabat) }}" class="rounded w-20 h-20 object-cover">
                                    </div>
                                @endif

                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-4">
                                    <div class="text-center">
                                        <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                            <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                            <label for="left_ttd_pejabat" class="relative cursor-pointer font-semibold text-indigo-600 hover:text-indigo-500">
                                                <span>Upload file</span>
                                                <input wire:model="left_ttd_pejabat" id="left_ttd_pejabat" type="file" name="left_ttd_pejabat" @if (!$isEditing)  @endif class="sr-only" accept="image/png, image/jpg, image/jpeg" />
                                            </label>
                                        </div>

                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (max 5MB)</p>
                                    </div>
                                </div>

                                {{-- Error --}}
                                @error('left_ttd_pejabat')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror

                                {{-- Loading --}}
                                <div wire:loading wire:target="left_ttd_pejabat" class="flex items-center justify-center w-20 h-20 mt-3 border rounded-lg bg-gray-50">
                                    <span class="text-xs text-blue-600 animate-pulse">Loading...</span>
                                </div>

                                {{-- Preview --}}
                                @if ($left_ttd_pejabat)
                                    <p class="my-2 text-sm/6 font-medium font-bold">Preview (New)</p>
                                    <img src="{{ $left_ttd_pejabat->temporaryUrl() }}" class="rounded w-20 h-20 block object-cover">
                                @endif
                            </div>
                            {{-- ================= Stamp ================= --}}
                            <div>
                                <label for="left_stamp" class="block text-sm font-medium text-gray-900">Stamp Kiri @if ($isEditing)
                                        <span class="text-xs text-gray-500">(Optional - leave empty to keep current)</span>
                                    @endif
                                </label>

                                @if ($isEditing && $old_left_stamp)
                                    <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <div>
                                            <p class="text-sm text-blue-900 font-medium mb-2">Current Stamp Kiri:</p>
                                            <button wire:click="clearImage('left_stamp')" wire:confirm="Yakin hapus stamp kiri ini?" type="button" class="text-xs text-red-600 bg-red-50 hover:bg-red-100 px-2 py-1 rounded border border-red-200">
                                                🗑 Hapus
                                            </button>
                                        </div>
                                        <img src="{{ asset('storage/' . $old_left_stamp) }}" class="rounded w-20 h-20 object-cover">
                                    </div>
                                @endif

                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-4">
                                    <div class="text-center">
                                        <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                            <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                            <label for="left_stamp" class="relative cursor-pointer font-semibold text-indigo-600 hover:text-indigo-500">
                                                <span>Upload file</span>
                                                <input wire:model="left_stamp" id="left_stamp" type="file" name="left_stamp" @if (!$isEditing)  @endif class="sr-only" accept="image/png, image/jpg, image/jpeg" />
                                            </label>
                                        </div>

                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (max 5MB)</p>
                                    </div>
                                </div>

                                {{-- Error --}}
                                @error('left_stamp')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror

                                {{-- Loading --}}
                                <div wire:loading wire:target="left_stamp" class="flex items-center justify-center w-20 h-20 mt-3 border rounded-lg bg-gray-50">
                                    <span class="text-xs text-blue-600 animate-pulse">Loading...</span>
                                </div>

                                {{-- Preview --}}
                                @if ($left_stamp)
                                    <p class="my-2 text-sm/6 font-medium font-bold">Preview (New)</p>
                                    <img src="{{ $left_stamp->temporaryUrl() }}" class="rounded w-20 h-20 block object-cover">
                                @endif
                            </div>


                        </div>
                        {{-- Pejabat Kanan --}}
                        <div class="w-1/2 space-y-5">
                            <div>
                                <label for="right_nama_pejabat" class="block text-sm/6 font-medium text-gray-900">Nama Pejabat Kanan</label>
                                <div class="mt-2">
                                    <input wire:model="right_nama_pejabat" id="right_nama_pejabat" type="text" name="right_nama_pejabat" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                    @error('right_nama_pejabat')
                                        <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="right_nama_jabatan" class="block text-sm/6 font-medium text-gray-900">Nama Jabatan Kanan</label>
                                <div class="mt-2">
                                    <input wire:model="right_nama_jabatan" id="right_nama_jabatan" type="text" name="right_nama_jabatan" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                    @error('right_nama_jabatan')
                                        <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            {{-- ================= Tanda Tangan ================= --}}
                            <div>
                                <label for="right_ttd_pejabat" class="block text-sm font-medium text-gray-900">TTD Kanan @if ($isEditing)
                                        <span class="text-xs text-gray-500">(Optional - leave empty to keep current)</span>
                                    @endif
                                </label>

                                @if ($isEditing && $old_right_ttd_pejabat)
                                    <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <div>
                                            <p class="text-sm text-blue-900 font-medium mb-2">Current TTD Kanan:</p>
                                            <button wire:click="clearImage('right_ttd_pejabat')" wire:confirm="Yakin hapus tanda tangan kanan ini?" type="button" class="text-xs text-red-600 bg-red-50 hover:bg-red-100 px-2 py-1 rounded border border-red-200">
                                                🗑 Hapus
                                            </button>
                                        </div>
                                        <img src="{{ asset('storage/' . $old_right_ttd_pejabat) }}" class="rounded w-20 h-20 object-cover">
                                    </div>
                                @endif

                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-4">
                                    <div class="text-center">
                                        <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                            <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                            <label for="right_ttd_pejabat" class="relative cursor-pointer font-semibold text-indigo-600 hover:text-indigo-500">
                                                <span>Upload file</span>
                                                <input wire:model="right_ttd_pejabat" id="right_ttd_pejabat" type="file" name="right_ttd_pejabat" @if (!$isEditing)  @endif class="sr-only" accept="image/png, image/jpg, image/jpeg" />
                                            </label>
                                        </div>

                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (max 5MB)</p>
                                    </div>
                                </div>

                                {{-- Error --}}
                                @error('right_ttd_pejabat')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror

                                {{-- Loading --}}
                                <div wire:loading wire:target="right_ttd_pejabat" class="flex items-center justify-center w-20 h-20 mt-3 border rounded-lg bg-gray-50">
                                    <span class="text-xs text-blue-600 animate-pulse">Loading...</span>
                                </div>

                                {{-- Preview --}}
                                @if ($right_ttd_pejabat)
                                    <p class="my-2 text-sm/6 font-medium font-bold">Preview (New)</p>
                                    <img src="{{ $right_ttd_pejabat->temporaryUrl() }}" class="rounded w-20 h-20 block object-cover">
                                @endif
                            </div>
                            {{-- ================= Stamp Kanan ================= --}}
                            <div>
                                <label for="right_stamp" class="block text-sm font-medium text-gray-900">Stamp Kanan @if ($isEditing)
                                        <span class="text-xs text-gray-500">(Optional - leave empty to keep current)</span>
                                    @endif
                                </label>

                                @if ($isEditing && $old_right_stamp)
                                    <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <div>
                                            <p class="text-sm text-blue-900 font-medium mb-2">Current Stamp Kanan:</p>
                                            <button wire:click="clearImage('right_stamp')" wire:confirm="Yakin hapus stamp kanan ini?" type="button" class="text-xs text-red-600 bg-red-50 hover:bg-red-100 px-2 py-1 rounded border border-red-200">
                                                🗑 Hapus
                                            </button>
                                        </div>
                                        <img src="{{ asset('storage/' . $old_right_stamp) }}" class="rounded w-20 h-20 object-cover">
                                    </div>
                                @endif

                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-4">
                                    <div class="text-center">
                                        <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                            <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                            <label for="right_stamp" class="relative cursor-pointer font-semibold text-indigo-600 hover:text-indigo-500">
                                                <span>Upload file</span>
                                                <input wire:model="right_stamp" id="right_stamp" type="file" name="right_stamp" @if (!$isEditing)  @endif class="sr-only" accept="image/png, image/jpg, image/jpeg" />
                                            </label>
                                        </div>

                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (max 5MB)</p>
                                    </div>
                                </div>

                                {{-- Error --}}
                                @error('right_stamp')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror

                                {{-- Loading --}}
                                <div wire:loading wire:target="right_stamp" class="flex items-center justify-center w-20 h-20 mt-3 border rounded-lg bg-gray-50">
                                    <span class="text-xs text-blue-600 animate-pulse">Loading...</span>
                                </div>

                                {{-- Preview --}}
                                @if ($right_stamp)
                                    <p class="my-2 text-sm/6 font-medium font-bold">Preview (New)</p>
                                    <img src="{{ $right_stamp->temporaryUrl() }}" class="rounded w-20 h-20 block object-cover">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button wire:click.prevent='createNewBatch' class="flex flex-1 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg wire:loading wire:target='createNewBatch' aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-blue-600 self-center me-2" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                            @if ($isEditing)
                                Update Batch
                            @else
                                Create New Batch
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
    </div>

    <div class="w-1/3">
        <div class="bg-white p-4 rounded-lg">
            <div class="mx-auto border-b border-gray-200 pb-2">
                <h2 class="text-center text-xl/9 font-bold tracking-tight">Batch List</h2>
            </div>

            <div class="mt-10">
                <div class="my-4">
                    <input wire:model.live="search" type="text" placeholder="Search by judul or kode sertifikat..." class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600" />
                </div>

                <ul role="list" class="divide-y divide-gray-100" wire:loading.delay.class="opacity-50">
                    @forelse ($batches as $batch)
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm/6 font-semibold text-gray-900">{{ $batch->kode_batch }}</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $batch->sertifikat->judul_program }}</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $batch->tanggal_mulai }} - {{ $batch->tanggal_selesai }}</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end self-center gap-2">
                                <p class="mt-1 text-xs/5 text-gray-500">Created {{ $batch->created_at?->diffForHumans() ?? '' }}</p>
                                <div class="flex gap-2 mt-2">
                                    <button wire:click="editBatch({{ $batch->id }})" class="px-3 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 rounded hover:bg-indigo-100">Edit</button>
                                    <button wire:click="deleteBatch({{ $batch->id }})" wire:confirm="Yakin hapus batch ini?" class="px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded hover:bg-red-100">Delete</button>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-8">
                            <p class="text-center text-gray-500">
                                @if ($search)
                                    Tidak ada batch yang cocok dengan "<strong>{{ $search }}</strong>"
                                @else
                                    Tidak ada batch
                                @endif
                            </p>
                        </li>
                    @endforelse
                </ul>
                <div class="mt-6">
                    {{ $batches->onEachSide(1)->links() }}
                </div>
            </div>
        </div>

    </div>
