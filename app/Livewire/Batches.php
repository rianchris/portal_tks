<?php

namespace App\Livewire;

use App\Models\Batch;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Batch')]

class Batches extends Component
{
    use WithPagination;

    public $kode_batch = '';
    public $sertifikat_id = '';
    public $tanggal_mulai = '';
    public $tanggal_selesai = '';
    public $search = '';

    // Edit mode properties
    public $editingBatchId = null;
    public $isEditing = false;

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
                'kode_batch' => 'required|unique:batches,kode_batch',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'nullable',
            ]);

            $batch = Batch::findOrFail($this->editingBatchId);

            $batch->update($validated);
            $this->cancelEdit();
            session()->flash('success', 'Batch updated successfully!');
        } else {
            // Create batch baru
            $validated = $this->validate([
                'sertifikat_id' => 'required|numeric',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'nullable',
            ]);


            $validated['kode_batch'] = Str::upper(Str::random(6));

            Batch::create($validated);
            $this->reset(); // untuk reset semua inputan
            $this->search = ''; // reset search juga
            session()->flash('success', 'Batch created successfully!');
        }
    }

    public function cancelEdit()
    {
        $this->editingBatchId = null;
        $this->isEditing = false;
        $this->reset(['kode_batch', 'sertifikat_id', 'tanggal_mulai', 'tanggal_selesai']);
    }

    public function editbatch($batchId)
    {
        $batch = Batch::findOrFail($batchId);
        $this->editingBatchId = $batchId;
        $this->isEditing = true;
        $this->kode_batch = $batch->kode_batch;
        $this->sertifikat_id = $batch->sertifikat_id;
        $this->tanggal_mulai = $batch->tanggal_mulai;
        $this->tanggal_selesai = $batch->tanggal_selesai;
        session()->flash('info', 'Edit batch: ' . $batch->kode_batch);
    }

    public function deletebatch($batchId)
    {
        Batch::findOrFail($batchId)->delete();
        session()->flash('success', 'Batch deleted successfully!');
    }

    public function render()
    {
        $query = Batch::latest();


        if ($this->search) {
            $query->where('kode_batch', 'like', '%' . $this->search . '%')
                ->orWhereHas('sertifikat', function ($q) {
                    $q->where('judul', 'like', '%' . $this->search . '%');
                });
        }

        $data = [
            'batches' => $query->paginate(6),
            'sertifikats' => \App\Models\Sertifikat::all(),
        ];

        return view('livewire.batch', $data);
    }
}
