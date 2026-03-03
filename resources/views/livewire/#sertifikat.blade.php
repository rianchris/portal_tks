<div class="flex gap-4">
    <div class="w-8/12">
        <div class="bg-white rounded-lg p-4">
            <div class="mx-auto border-b border-gray-200 pb-2">
                <h2 class="text-center text-xl/9 font-bold tracking-tight">
                    @if ($isEditing)
                        Update Sertifikat
                    @else
                        Create Sertifikat
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


            {{-- <div class="mt-2"> --}}
            <form wire:submit='createNewSertifikat' action="#" method="POST" class="space-y-6">
                <div class="flex gap-5">
                    <div class="w-2/4">
                        @if ($isEditing)
                            <input type="hidden" wire:model="editingSertifikatId" name="sertifikat_id" value="{{ $editingSertifikatId }}">
                        @endif

                        <div>
                            <label for="judul_program" class="block text-sm/6 font-medium text-gray-900">Judul</label>
                            <div class="mt-2">
                                <input wire:model="judul_program" id="judul_program" type="text" name="judul_program" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('judul_program')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="mt-5">
                            <label for="deskripsi_page1" class="block text-sm/6 font-medium text-gray-900">Deskripsi Page 1</label>
                            <div class="mt-2">
                                <textarea wire:model="deskripsi_page1" rows="5" id="deskripsi_page1" name="deskripsi_page1" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                </textarea>

                                @error('deskripsi_page1')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="deskripsi_page2" class="block text-sm/6 font-medium text-gray-900">Deskripsi Page 2</label>
                            <div class="mt-2">
                                <textarea wire:model="deskripsi_page2" rows="5" id="deskripsi_page2" type="text" name="deskripsi_page2" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </textarea>
                                @error('deskripsi_page2')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="mt-5">
                            <label for="left_nama_pejabat" class="block text-sm/6 font-medium text-gray-900">Nama Pejabat Kiri</label>
                            <div class="mt-2">
                                <input wire:model="left_nama_pejabat" id="left_nama_pejabat" type="text" name="left_nama_pejabat" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('left_nama_pejabat')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="right_nama_pejabat" class="block text-sm/6 font-medium text-gray-900">Nama Pejabat Kanan</label>
                            <div class="mt-2">
                                <input wire:model="right_nama_pejabat" id="right_nama_pejabat" type="text" name="right_nama_pejabat" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('right_nama_pejabat')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="left_nama_jabatan" class="block text-sm/6 font-medium text-gray-900">Nama Jabatan Kiri</label>
                            <div class="mt-2">
                                <input wire:model="left_nama_jabatan" id="left_nama_jabatan" type="text" name="left_nama_jabatan" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('left_nama_jabatan')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="left_nama_jabatan" class="block text-sm/6 font-medium text-gray-900">Nama Jabatan Kanan</label>
                            <div class="mt-2">
                                <input wire:model="left_nama_jabatan" id="left_nama_jabatan" type="text" name="left_nama_jabatan" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                @error('left_nama_jabatan')
                                    <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="w-2/4 space-y-6">

                        {{-- ================= LOGO KANAN ================= --}}
                        <div>
                            <label for="background" class="block text-sm font-medium text-gray-900">Background @if ($isEditing)
                                    <span class="text-xs text-gray-500">(Optional - leave empty to keep current)</span>
                                @endif
                            </label>

                            @if ($isEditing && $old_background)
                                <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <p class="text-sm text-blue-900 font-medium mb-2">Current Background:</p>
                                    <img src="{{ asset('storage/' . $old_background) }}" class="rounded w-20 h-20 object-cover">
                                </div>
                            @endif

                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-4">
                                <div class="text-center">
                                    <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                        <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                        <label for="background" class="relative cursor-pointer font-semibold text-indigo-600 hover:text-indigo-500">
                                            <span>Upload file</span>
                                            <input wire:model="background" id="background" type="file" name="background" @if (!$isEditing) required @endif class="sr-only" accept="image/png, image/jpg, image/jpeg" />
                                        </label>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG (max 5MB)</p>
                                </div>
                            </div>

                            {{-- Error --}}
                            @error('background')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror

                            {{-- Loading --}}
                            <div wire:loading wire:target="background" class="flex items-center justify-center w-20 h-20 mt-3 border rounded-lg bg-gray-50">
                                <span class="text-xs text-blue-600 animate-pulse">Loading...</span>
                            </div>

                            {{-- Preview --}}
                            @if ($background)
                                <p class="my-2 text-sm/6 font-medium fw-bold">Preview (New)</p>
                                <img src="{{ $background->temporaryUrl() }}" class="rounded w-20 h-20 block object-cover">
                            @endif
                        </div>


                        {{-- ================= LOGO KIRI ================= --}}
                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-900">Logo Kiri @if ($isEditing)
                                    <span class="text-xs text-gray-500">(Optional - leave empty to keep current)</span>
                                @endif
                            </label>

                            @if ($isEditing && $old_logo)
                                <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <p class="text-sm text-blue-900 font-medium mb-2">Current Logo Kiri:</p>
                                    <img src="{{ asset('storage/' . $old_logo) }}" class="rounded w-20 h-20 object-cover">
                                </div>
                            @endif

                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-4">
                                <div class="text-center">
                                    <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                        <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                        <label for="logo" class="relative cursor-pointer font-semibold text-indigo-600 hover:text-indigo-500">
                                            <span>Upload file</span>
                                            <input wire:model="logo" id="logo" type="file" name="logo" @if (!$isEditing) required @endif class="sr-only" accept="image/png, image/jpg, image/jpeg" />
                                        </label>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG (max 5MB)</p>
                                </div>
                            </div>

                            {{-- Error --}}
                            @error('logo')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror

                            {{-- Loading --}}
                            <div wire:loading wire:target="logo" class="flex items-center justify-center w-20 h-20 mt-3 border rounded-lg bg-gray-50">
                                <span class="text-xs text-blue-600 animate-pulse">Loading...</span>
                            </div>

                            {{-- Preview --}}
                            @if ($logo)
                                <p class="my-2 text-sm/6 font-medium fw-bold">Preview (New)</p>
                                <img src="{{ $logo->temporaryUrl() }}" class="rounded w-20 h-20 block object-cover">
                            @endif
                        </div>

                        {{-- ================= Tanda Tangan ================= --}}
                        <div>
                            <label for="left_ttd_pejabat" class="block text-sm font-medium text-gray-900">Tanda Tangan @if ($isEditing)
                                    <span class="text-xs text-gray-500">(Optional - leave empty to keep current)</span>
                                @endif
                            </label>

                            @if ($isEditing && $old_left_ttd_pejabat)
                                <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <p class="text-sm text-blue-900 font-medium mb-2">Current Tanda Tangan:</p>
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
                                            <input wire:model="left_ttd_pejabat" id="left_ttd_pejabat" type="file" name="left_ttd_pejabat" @if (!$isEditing) required @endif class="sr-only" accept="image/png, image/jpg, image/jpeg" />
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
                                <p class="my-2 text-sm/6 font-medium fw-bold">Preview (New)</p>
                                <img src="{{ $left_ttd_pejabat->temporaryUrl() }}" class="rounded w-20 h-20 block object-cover">
                            @endif
                        </div>

                    </div>
                </div>

                <h1 class="text-start text-lg/4 font-bold tracking-tight border-b border-gray-200 py-4">
                    Sertifikat Detail
                </h1>

                {{-- <div class="flex gap-5"> --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                    @foreach ($details as $index => $detail)
                        <div wire:key="detail-{{ $index }}" class="mb-2">
                            @if ($isEditing)
                                <input type="hidden" wire:model="details.{{ $index }}.id">
                            @endif
                            <div class="flex gap-2">
                                <div class="w-2/6">
                                    <label class="block text-xs font-medium text-gray-900">
                                        Unit Number
                                    </label>
                                    <input wire:model="details.{{ $index }}.unit_number" type="text" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>

                                <div class="w-4/6">
                                    <label class="block text-xs font-medium text-gray-900">
                                        Unit Title
                                    </label>
                                    <input wire:model="details.{{ $index }}.unit_title" type="text" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- </div> --}}

                <div class="flex gap-2">
                    <button wire:click.prevent='createNewSertifikat' class="flex flex-1 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg wire:loading wire:target='createNewSertifikat' aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-blue-600 self-center me-2" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                        @if ($isEditing)
                            Update Sertifikat
                        @else
                            Create New Sertifikat
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


    <div class="w-4/12">
        <div class="bg-white p-4 rounded-lg">
            <div class="mx-auto mb-4 border-b border-gray-200 pb-2">
                <h2 class="text-center text-xl/9 font-bold tracking-tight">Daftar sertifikat</h2>
            </div>

            <div class="mb-4">
                <input wire:model.live="search" type="text" placeholder="Search by Judul Program" class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600" />
            </div>

            <ul role="list" class="divide-y divide-gray-100" wire:loading.delay.class="opacity-50">
                @forelse ($sertifikats as $sertifikat)
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            {{-- <img src="{{ $sertifikat->logo ? asset('storage/' . $sertifikat->logo) : asset('img/default-avatar.png') }}" alt="" class="size-12 flex-none rounded-full bg-gray-50" /> --}}
                            <div class="min-w-0 flex-auto self-center">
                                <p class="text-sm/6 font-semibold text-gray-900">{{ $sertifikat->judul_program }}</p>
                            </div>
                            {{-- <img src="{{ $sertifikat->background ? asset('storage/' . $sertifikat->background) : asset('img/default-avatar.png') }}" alt="" class="size-12 flex-none rounded-full bg-gray-50" /> --}}
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end self-center">
                            <p class="mt-1 text-xs/5 text-gray-500">Created {{ $sertifikat->created_at->diffForHumans() ?? '' }}</p>
                            <p class="mt-1 text-xs/5 text-gray-500">Updated {{ $sertifikat->updated_at->diffForHumans() ?? '' }}</p>

                            <div class="flex gap-2 mt-2">
                                <button wire:click="editSertifikat({{ $sertifikat->id }})" class="px-3 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 rounded hover:bg-indigo-100">Edit</button>
                                <button wire:click="deleteSertifikat({{ $sertifikat->id }})" wire:confirm="Yakin hapus sertifikat ini?" class="px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded hover:bg-red-100">Delete</button>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="py-8">
                        <p class="text-center text-gray-500">
                            @if ($search)
                                Tidak ada sertifikat yang cocok dengan "<strong>{{ $search }}</strong>"
                            @else
                                Tidak ada sertifikat
                            @endif
                        </p>
                    </li>
                @endforelse
            </ul>
            <div class="mt-6">
                {{ $sertifikats->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

</div>
