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
    public $jenis_sertifikat;
    public $judul_program;
    public $logo;
    public $background;
    public $left_nama_pejabat;
    public $left_ttd_pejabat;
    public $left_nama_jabatan;
    public $left_stamp;
    public $right_nama_pejabat;
    public $right_ttd_pejabat;
    public $right_nama_jabatan;
    public $right_stamp;

    // sertifikat detail
    public $sertifikat_id;
    public $details = [];
    public $unit_number = [];
    public $unit_title = [];

    // untuk edit sertifikat
    public $editingSertifikatId = null;
    public $isEditing = false;
    public $old_logo = null;
    public $old_background = null;
    public $old_left_ttd_pejabat = null;
    public $old_left_stamp = null;
    public $old_right_ttd_pejabat = null;
    public $old_right_stamp = null;

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
                'judul_program' => 'required|string|max:255',
                'logo' => 'image|max:5000',
                'background' => 'image|max:5000',
                'left_nama_pejabat' => 'nullable|string|max:255',
                'left_nama_jabatan' => 'nullable|string|max:255',
                'left_ttd_pejabat' => 'image|max:1000',
                'left_stamp' => 'image|max:1000',
                'right_nama_pejabat' => 'nullable|string|max:255',
                'right_nama_jabatan' => 'nullable|string|max:255',
                'right_ttd_pejabat' => 'image|max:1000',
                'right_stamp' => 'image|max:1000',
            ]);

            $sertifikat = Sertifikat::findOrFail($this->editingSertifikatId);

            if ($this->logo) {
                $validated['logo'] = $this->logo->store('logo', 'public');
            }

            if ($this->background) {
                $validated['background'] = $this->background->store('background', 'public');
            }

            if ($this->left_ttd_pejabat) {
                $validated['left_ttd_pejabat'] = $this->left_ttd_pejabat->store('left_ttd_pejabat', 'public');
            }
            if ($this->right_ttd_pejabat) {
                $validated['right_ttd_pejabat'] = $this->right_ttd_pejabat->store('right_ttd_pejabat', 'public');
            }
            if ($this->left_stamp) {
                $validated['left_stamp'] = $this->left_stamp->store('left_stamp', 'public');
            }
            if ($this->right_stamp) {
                $validated['right_stamp'] = $this->right_stamp->store('right_stamp', 'public');
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
                'judul_program' => 'required|string|max:255',
                'logo' => 'image|max:5000',
                'background' => 'image|max:5000',
                'left_nama_pejabat' => 'nullable|string|max:255',
                'left_nama_jabatan' => 'nullable|string|max:255',
                'left_ttd_pejabat' => 'image|max:1000',
                'left_stamp' => 'image|max:1000',
                'right_nama_pejabat' => 'nullable|string|max:255',
                'right_nama_jabatan' => 'nullable|string|max:255',
                'right_ttd_pejabat' => 'image|max:1000',
                'right_stamp' => 'image|max:1000',
            ]);

            if ($this->logo) {
                $validated['logo'] = $this->logo->store('logo', 'public');
            }

            if ($this->background) {
                $validated['background'] = $this->background->store('background', 'public');
            }

            if ($this->left_ttd_pejabat) {
                $validated['left_ttd_pejabat'] = $this->left_ttd_pejabat->store('left_ttd_pejabat', 'public');
            }
            if ($this->left_stamp) {
                $validated['left_stamp'] = $this->left_stamp->store('left_stamp', 'public');
            }

            if ($this->right_ttd_pejabat) {
                $validated['right_ttd_pejabat'] = $this->right_ttd_pejabat->store('right_ttd_pejabat', 'public');
            }
            if ($this->right_stamp) {
                $validated['right_stamp'] = $this->right_stamp->store('right_stamp', 'public');
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
        $this->old_logo = null;
        $this->old_left_ttd_pejabat = null;
        $this->old_left_stamp = null;
        $this->old_right_ttd_pejabat = null;
        $this->old_right_stamp = null;
        $this->isEditing = false;
        $this->reset();
    }

    public function editSertifikat($sertifikatId)
    {
        $sertifikat = Sertifikat::findOrFail($sertifikatId);
        $this->editingSertifikatId = $sertifikatId;
        $this->judul_program = $sertifikat->judul_program;
        $this->left_nama_pejabat = $sertifikat->left_nama_pejabat;
        $this->left_nama_jabatan = $sertifikat->left_nama_jabatan;
        $this->right_nama_pejabat = $sertifikat->right_nama_pejabat;
        $this->right_nama_jabatan = $sertifikat->right_nama_jabatan;
        $this->old_logo = $sertifikat->logo;
        $this->old_background = $sertifikat->background;
        $this->old_left_ttd_pejabat = $sertifikat->left_ttd_pejabat;
        $this->old_left_stamp = $sertifikat->left_stamp;
        $this->old_right_ttd_pejabat = $sertifikat->right_ttd_pejabat;
        $this->old_right_stamp = $sertifikat->right_stamp;
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
        session()->flash('info', 'Editing sertifikat: ' . $sertifikat->judul_program);
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
            $query->where('judul_program', 'like', '%' . $this->search . '%');
        }

        $data = [
            'sertifikats' => $query->paginate(6),
        ];

        return view('livewire.sertifikat', $data);
    }
}
