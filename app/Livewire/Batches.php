<?php

namespace App\Livewire;

use App\Models\Batch;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title('Batch')]

class Batches extends Component
{
    use WithFileUploads, WithPagination;

    public $sertifikat_id = '';
    public $kode_batch = '';
    public $left_nama_pejabat;
    public $left_ttd_pejabat;
    public $left_nama_jabatan;
    public $left_stamp;
    public $right_nama_pejabat;
    public $right_ttd_pejabat;
    public $right_nama_jabatan;
    public $right_stamp;
    public $deskripsi;

    public $date_issued = '';
    public $tanggal_mulai = '';
    public $tanggal_selesai = '';
    public $search = '';

    // Edit mode properties
    public $editingBatchId = null;
    public $isEditing = false;
    public $old_left_ttd_pejabat = null;
    public $old_left_stamp = null;
    public $old_right_ttd_pejabat = null;
    public $old_right_stamp = null;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createNewBatch()
    {
        if ($this->isEditing) {
            // Update batch
            $validated = $this->validate([
                'sertifikat_id' => 'required|numeric',
                'kode_batch' => 'required|unique:batch,kode_batch,' . $this->editingBatchId,
                'tanggal_mulai' => 'required|date',
                'date_issued' => 'required|date',
                'tanggal_selesai' => 'nullable',
                'deskripsi' => 'nullable',
                'left_nama_pejabat' => 'nullable|string|max:255',
                'left_nama_jabatan' => 'nullable|string|max:255',
                'left_ttd_pejabat' => 'nullable|image|max:1000',
                'left_stamp' => 'nullable|image|max:1000',
                'right_nama_pejabat' => 'nullable|string|max:255',
                'right_nama_jabatan' => 'nullable|string|max:255',
                'right_ttd_pejabat' => 'nullable|image|max:1000',
                'right_stamp' => 'nullable|image|max:1000',
            ]);

            $batch = Batch::findOrFail($this->editingBatchId);

            foreach (['left_ttd_pejabat', 'left_stamp', 'right_ttd_pejabat', 'right_stamp'] as $field) {
                if ($this->$field) {
                    if ($batch->$field) {
                        Storage::disk('public')->delete($batch->$field);
                    }
                    $validated[$field] = $this->$field->store($field, 'public');
                } else {
                    unset($validated[$field]);
                }
            }

            $batch->update($validated);
            $this->cancelEdit();
            session()->flash('success', 'Batch updated successfully!');
        } else {
            // Create batch baru
            $validated = $this->validate([
                'sertifikat_id' => 'required|numeric',
                'date_issued' => 'required|date',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'nullable',
                'deskripsi' => 'nullable',
                'left_nama_pejabat' => 'nullable|string|max:255',
                'left_nama_jabatan' => 'nullable|string|max:255',
                'left_ttd_pejabat' => 'nullable|image|max:1000',
                'left_stamp' => 'nullable|image|max:1000',
                'right_nama_pejabat' => 'nullable|string|max:255',
                'right_nama_jabatan' => 'nullable|string|max:255',
                'right_ttd_pejabat' => 'nullable|image|max:1000',
                'right_stamp' => 'nullable|image|max:1000',
            ]);

            $validated['kode_batch'] = Str::upper(Str::random(6));

            foreach (['left_ttd_pejabat', 'left_stamp', 'right_ttd_pejabat', 'right_stamp'] as $field) {
                if ($this->$field) {
                    $validated[$field] = $this->$field->store($field, 'public');
                }
            }

            $validated['tanggal_selesai'] = $this->tanggal_selesai ?: null;
            Batch::create($validated);
            $this->reset(); // untuk reset semua inputan
            session()->flash('success', 'Batch created successfully!');
        }
    }

    public function cancelEdit()
    {
        $this->reset();
    }

    public function editBatch($batchId)
    {
        $batch = Batch::findOrFail($batchId);
        $this->editingBatchId       = $batchId;
        $this->isEditing            = true;
        $this->kode_batch           = $batch->kode_batch;
        $this->sertifikat_id        = $batch->sertifikat_id;
        $this->date_issued          = $batch->date_issued;
        $this->tanggal_mulai        = $batch->tanggal_mulai;
        $this->tanggal_selesai      = $batch->tanggal_selesai;
        $this->deskripsi            = $batch->deskripsi;
        // ✅ Tambahkan ini
        $this->left_nama_pejabat    = $batch->left_nama_pejabat;
        $this->left_nama_jabatan    = $batch->left_nama_jabatan;
        $this->right_nama_pejabat   = $batch->right_nama_pejabat;
        $this->right_nama_jabatan   = $batch->right_nama_jabatan;
        $this->old_left_ttd_pejabat  = $batch->left_ttd_pejabat;
        $this->old_left_stamp        = $batch->left_stamp;
        $this->old_right_ttd_pejabat = $batch->right_ttd_pejabat;
        $this->old_right_stamp       = $batch->right_stamp;

        session()->flash('info', 'Edit batch: ' . $batch->kode_batch);
    }

    public function clearImage($field)
    {
        $allowedFields = ['left_ttd_pejabat', 'left_stamp', 'right_ttd_pejabat', 'right_stamp'];

        if (!in_array($field, $allowedFields)) return;

        $oldField = 'old_' . $field;

        if ($this->$oldField) {
            Storage::disk('public')->delete($this->$oldField);

            // Update database langsung
            Batch::where('id', $this->editingBatchId)->update([$field => null]);

            $this->$oldField = null;
        }
    }

    public function deleteBatch($batchId)
    {
        $batch = Batch::findOrFail($batchId);

        foreach (['left_ttd_pejabat', 'left_stamp', 'right_ttd_pejabat', 'right_stamp'] as $field) {
            if ($batch->$field) {
                Storage::disk('public')->delete($batch->$field);
            }
        }

        $batch->delete();
        session()->flash('success', 'Batch deleted successfully!');
    }

    public function render()
    {
        $query = Batch::latest();


        if ($this->search) {
            $query->where('kode_batch', 'like', '%' . $this->search . '%')
                ->orWhereHas('sertifikat', function ($q) {
                    $q->where('judul_program', 'like', '%' . $this->search . '%');
                });
        }

        $data = [
            'batches' => $query->paginate(6),
            'sertifikats' => \App\Models\Sertifikat::all(),
        ];

        return view('livewire.batch', $data);
    }
}
