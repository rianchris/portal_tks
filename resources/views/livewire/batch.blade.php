<div class="flex justify-center gap-4">
    <div class="w-1/3">
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

                    <div>
                        <label for="sertifikat" class="block text-sm/6 font-medium text-gray-900">Sertifikat</label>
                        <div class="mt-2">
                            <select wire:model="sertifikat_id" id="sertifikat" name="sertifikat" required class="block w-full rounded-md bg-white px-3 py-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option>Select Option</option>
                                @foreach ($sertifikats as $sertifikatItem)
                                    <option value="{{ $sertifikatItem->id }}">{{ $sertifikatItem->judul }}</option>
                                @endforeach
                            </select>
                            @error('sertifikat_id')
                                <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="tanggal_mulai" class="block text-sm/6 font-medium text-gray-900">Tanggal Mulai</label>
                        <div class="mt-2">
                            <input wire:model="tanggal_mulai" id="tanggal_mulai" type="date" tanggal_mulai="tanggal_mulai" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            @error('tanggal_mulai')
                                <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="tanggal_selesai" class="block text-sm/6 font-medium text-gray-900">Tanggal Selesai</label>
                        <div class="mt-2">
                            <input wire:model="tanggal_selesai" id="tanggal_selesai" type="date" tanggal_selesai="tanggal_selesai" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            @error('tanggal_selesai')
                                <p class="text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click.prevent='createNewBatch' class="flex flex-1 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg wire:loading wire:target='createNewbatch' aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-blue-600 self-center me-2" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
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

    <div class="w-2/3">
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
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $batch->sertifikat->judul }}</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $batch->tanggal_mulai }} - {{ $batch->tanggal_selesai }}</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end self-center gap-2">
                                <p class="mt-1 text-xs/5 text-gray-500">Created {{ $batch->created_at?->diffForHumans() ?? '' }}</p>
                                <div class="flex gap-2 mt-2">
                                    <button wire:click="editbatch({{ $batch->id }})" class="px-3 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 rounded hover:bg-indigo-100">Edit</button>
                                    <button wire:click="deletebatch({{ $batch->id }})" wire:confirm="Yakin hapus batch ini?" class="px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded hover:bg-red-100">Delete</button>
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
