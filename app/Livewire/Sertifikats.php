<?php

namespace App\Livewire;

use App\Models\Sertifikat;
use App\Models\SertifikatDetail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title('Sertifikat')]

class Sertifikats extends Component
{
    use WithFileUploads, WithPagination;

    // sertifikat
    public $judul;
    public $logo_kiri;
    public $background;
    // public $deskripsi_page1;
    // public $deskripsi_page2;
    public $nama_pejabat;
    public $ttd_pejabat;
    public $nama_jabatan;

    // sertifikat detail
    public $sertifikat_id;
    public $details = [];
    public $unit_number = [];
    public $unit_title = [];

    // untuk edit sertifikat
    public $editingSertifikatId = null;
    public $isEditing = false;
    public $old_logo_kiri = null;
    public $old_background = null;
    public $old_ttd_pejabat = null;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createNewSertifikat()
    {
        if ($this->isEditing) {
            // Update logic here
            $validated = $this->validate([
                'judul' => 'required|string|max:255',
                // 'deskripsi_page1' => 'required|string',
                // 'deskripsi_page2' => 'required|string',
                'nama_pejabat' => 'required|string|max:255',
                'nama_jabatan' => 'required|string|max:255',
            ]);

            $sertifikat = Sertifikat::findOrFail($this->editingSertifikatId);

            if ($this->logo_kiri) {
                $validated['logo_kiri'] = $this->logo_kiri->store('logo_kiri', 'public');
            }

            if ($this->background) {
                $validated['background'] = $this->background->store('background', 'public');
            }

            if ($this->ttd_pejabat) {
                $validated['ttd_pejabat'] = $this->ttd_pejabat->store('ttd_pejabat', 'public');
            }

            $sertifikat->update($validated);

            // ambil semua id lama
            $existingIds = $sertifikat->details()->pluck('id')->toArray();
            $incomingIds = collect($this->details)->pluck('id')->filter()->toArray();

            // hapus detail yang sudah dihapus di form
            $idsToDelete = array_diff($existingIds, $incomingIds);
            SertifikatDetail::whereIn('id', $idsToDelete)->delete();

            // update & create
            // dd($this->details);
            foreach ($this->details as $detail) {
                $detailModel = SertifikatDetail::find($detail['id']);
                if ($detailModel) {
                    if (
                        trim($detail['unit_number'] ?? '') !== '' &&
                        trim($detail['unit_title'] ?? '') !== ''
                    ) {

                        $detailModel->update([
                            'unit_number' => $detail['unit_number'],
                            'unit_title'  => $detail['unit_title'],
                        ]);
                    } else {
                        $detailModel->delete();
                    }
                }
            }

            // $this->reset(['name', 'email', 'role']); // untuk reset beberapa kolom saja
            $this->reset(); // untuk reset semua inputan
            // $this->search = ''; // reset search juga
            session()->flash('success', 'Sertifikat updated successfully!');
        } else {
            // Create logic here
            $validated = $this->validate([
                'judul' => 'required|string|max:255',
                'logo_kiri' => 'image|max:1000',
                'background' => 'image|max:1000',
                // 'deskripsi_page1' => 'required|string',
                // 'deskripsi_page2' => 'required|string',
                'nama_pejabat' => 'required|string|max:255',
                'ttd_pejabat' => 'image|max:1000',
                'nama_jabatan' => 'required|string|max:255',
            ]);

            if ($this->logo_kiri) {
                $validated['logo_kiri'] = $this->logo_kiri->store('logo_kiri', 'public');
            }

            if ($this->background) {
                $validated['background'] = $this->background->store('background', 'public');
            }

            if ($this->ttd_pejabat) {
                $validated['ttd_pejabat'] = $this->ttd_pejabat->store('ttd_pejabat', 'public');
            }

            $sertifikat = Sertifikat::create($validated);

            foreach ($this->details as $detail) {

                if (empty($detail['unit_number']) && empty($detail['unit_title'])) {
                    continue;
                }

                $sertifikat->details()->create([
                    'unit_number' => $detail['unit_number'],
                    'unit_title'  => $detail['unit_title'],
                ]);
            }
            // $this->reset(['name', 'email', 'role']); // untuk reset beberapa kolom saja
            $this->reset(); // untuk reset semua inputan
            $this->search = ''; // reset search juga
            session()->flash('success', 'Saved successfully!');
        }
    }

    public function cancelEdit()
    {
        $this->editingSertifikatId = null;
        $this->old_background = null;
        $this->old_logo_kiri = null;
        $this->old_ttd_pejabat = null;
        $this->isEditing = false;
        $this->reset();
    }

    public function editSertifikat($sertifikatId)
    {
        $sertifikat = Sertifikat::findOrFail($sertifikatId);
        $this->editingSertifikatId = $sertifikatId;
        $this->judul = $sertifikat->judul;
        // $this->deskripsi_page1 = $sertifikat->deskripsi_page1;
        // $this->deskripsi_page2 = $sertifikat->deskripsi_page2;
        $this->nama_pejabat = $sertifikat->nama_pejabat;
        $this->nama_jabatan = $sertifikat->nama_jabatan;
        $this->old_logo_kiri = $sertifikat->logo_kiri;
        $this->old_background = $sertifikat->background;
        $this->old_ttd_pejabat = $sertifikat->ttd_pejabat;
        $this->isEditing = true;

        $this->details = $sertifikat->details->map(function ($detail) {
            return [
                'id' => $detail->id,
                'unit_number' => $detail->unit_number,
                'unit_title' => $detail->unit_title,
            ];
        })->toArray();

        while (count($this->details) < 16) {
            $this->details[] = [
                'id' => null,
                'unit_number' => '',
                'unit_title' => '',
            ];
        }
        // $this->unit_number = $sertifikat->details->pluck('unit_number')->toArray();
        // $this->unit_title = $sertifikat->details->pluck('unit_title')->toArray();
        session()->flash('info', 'Editing sertifikat: ' . $sertifikat->judul);
    }

    public function deleteSertifikat($sertifikatId)
    {
        Sertifikat::findOrFail($sertifikatId)->delete();
        session()->flash('success', 'Sertifikat deleted successfully!');
    }

    public function mount()
    {
        if (empty($this->details)) {
            $this->details = collect(range(1, 16))->map(function () {
                return [
                    'id' => null,
                    'unit_number' => '',
                    'unit_title' => '',
                ];
            })->toArray();
        }
    }

    public function render()
    {
        $query = Sertifikat::latest();
        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%');
        }

        $data = [
            'sertifikats' => $query->paginate(6),
        ];

        return view('livewire.sertifikat', $data);
    }
}
