<?php

namespace App\Livewire;

use App\Models\Sertifikat;
use App\Models\SertifikatDetail;
use Illuminate\Support\Facades\Storage;
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
    public $kode_program;
    public $logo;
    public $background_page_one;
    public $background_page_two;

    // sertifikat detail
    // public $sertifikat_id;
    public $details = [];
    // public $unit_number = [];
    // public $unit_title = [];

    // untuk edit sertifikat
    public $editingSertifikatId = null;
    public $isEditing = false;
    public $old_logo = null;
    public $old_background_page_one = null;
    public $old_background_page_two = null;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createNewSertifikat()
    {
        if ($this->isEditing) {
            $validated = $this->validate([
                'jenis_sertifikat'    => 'required|string|max:255',
                'judul_program'       => 'required|string|max:255',
                'kode_program'        => 'required|string|max:255',
                'logo'                => 'nullable|image|max:5000',
                'background_page_one' => 'nullable|image|max:5000',
                'background_page_two' => 'nullable|image|max:5000',
            ]);

            $sertifikat = Sertifikat::findOrFail($this->editingSertifikatId);

            if ($this->logo) {
                if ($sertifikat->logo) {
                    Storage::disk('public')->delete($sertifikat->logo);
                }
                $validated['logo'] = $this->logo->store('logo', 'public');
            } else {
                unset($validated['logo']);
            }

            if ($this->background_page_one) {
                if ($sertifikat->background_page_one) {
                    Storage::disk('public')->delete($sertifikat->background_page_one);
                }
                $validated['background_page_one'] = $this->background_page_one->store('background_page_one', 'public');
            } else {
                unset($validated['background_page_one']);
            }

            if ($this->background_page_two) {
                if ($sertifikat->background_page_two) {
                    Storage::disk('public')->delete($sertifikat->background_page_two);
                }
                $validated['background_page_two'] = $this->background_page_two->store('background_page_two', 'public');
            } else {
                unset($validated['background_page_two']);
            }

            $sertifikat->update($validated);

            $existingIds = $sertifikat->details()->pluck('id')->toArray();
            $incomingIds = collect($this->details)->pluck('id')->filter()->toArray();

            $idsToDelete = array_diff($existingIds, $incomingIds);
            SertifikatDetail::whereIn('id', $idsToDelete)->delete();

            foreach ($this->details as $detail) {
                if (trim($detail['unit_number'] ?? '') === '' && trim($detail['unit_title'] ?? '') === '') {
                    continue;
                }

                if (!empty($detail['id'])) {
                    $detailModel = SertifikatDetail::find($detail['id']);
                    if ($detailModel) {
                        $detailModel->update([
                            'unit_number' => $detail['unit_number'],
                            'unit_title'  => $detail['unit_title'],
                        ]);
                    }
                } else {
                    // New detail row added during edit
                    $sertifikat->details()->create([
                        'unit_number' => $detail['unit_number'],
                        'unit_title'  => $detail['unit_title'],
                    ]);
                }
            }

            $this->resetForm();
            session()->flash('success', 'Sertifikat updated successfully!');
        } else {
            $validated = $this->validate([
                'jenis_sertifikat'    => 'required|string|max:255',
                'judul_program'       => 'required|string|max:255',
                'kode_program'        => 'required|string|max:255',
                'logo'                => 'nullable|image|max:5000',
                'background_page_one' => 'nullable|image|max:5000',
                'background_page_two' => 'nullable|image|max:5000',
            ]);

            if ($this->logo) {
                $validated['logo'] = $this->logo->store('logo', 'public');
            }
            if ($this->background_page_one) {
                $validated['background_page_one'] = $this->background_page_one->store('background_page_one', 'public');
            }
            if ($this->background_page_two) {
                $validated['background_page_two'] = $this->background_page_two->store('background_page_two', 'public');
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

            $this->resetForm();
            session()->flash('success', 'Saved successfully!');
        }
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    // ✅ Centralized reset — always reinitializes the 16-row details array
    private function resetForm()
    {
        $this->reset();
        $this->initDetails();
    }

    private function initDetails()
    {
        $this->details = collect(range(1, 16))->map(fn() => [
            'id'          => null,
            'unit_number' => '',
            'unit_title'  => '',
        ])->toArray();
    }

    public function mount()
    {
        $this->initDetails();
    }

    public function editSertifikat($sertifikatId)
    {
        $sertifikat = Sertifikat::findOrFail($sertifikatId);
        $this->editingSertifikatId = $sertifikatId;
        $this->jenis_sertifikat = $sertifikat->jenis_sertifikat;
        $this->judul_program = $sertifikat->judul_program;
        $this->kode_program = $sertifikat->kode_program;
        $this->old_logo = $sertifikat->logo;
        $this->old_background_page_one = $sertifikat->background_page_one;
        $this->old_background_page_two = $sertifikat->background_page_two;
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
        session()->flash('info', 'Editing sertifikat: ' . $sertifikat->judul_program);
    }

    public function deleteSertifikat($sertifikatId)
    {
        $sertifikat = Sertifikat::findOrFail($sertifikatId);

        foreach (['logo', 'background_page_one', 'background_page_two'] as $field) {
            if ($sertifikat->$field) {
                Storage::disk('public')->delete($sertifikat->$field);
            }
        }

        $sertifikat->delete();
        session()->flash('success', 'Sertifikat deleted successfully!');
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
