<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\Peserta;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;


#[Title('Peserta')]


class Pesertas extends Component
{
    use WithFileUploads, WithPagination;

    public $nik;
    public $nama;
    public $email;
    public $telepon;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $foto;
    public $qr_code;

    public $search = '';

    public $sertifikat_id = null;
    public $batch_id = null;
    public $no_sertifikat = null;
    public $batches = [];
    // Edit mode properties
    public $editingPesertaId = null;
    public $oldFoto = null;
    public $isEditing = false;


    private function generateQr($noSertifikat)
    {
        $png = QrCode::format('png')
            ->size(300)
            ->generate(route('sertifikat.download', ['no_sertifikat' => $noSertifikat]));
        // atau: route('sertifikat.download', $noSertifikat) tergantung definisi route Anda

        $filename = time() . '_qr.png';

        Storage::disk('public')->put('qr/' . $filename, $png);

        return 'qr/' . $filename;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createNewPeserta()
    {
        if ($this->isEditing) {
            // Update peserta
            $validated = $this->validate([
                'nik' => 'required',
                'nama' => 'required|string|max:255',
                'email' => 'required|email',
                'telepon' => 'required',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'sertifikat_id' => 'required|exists:sertifikat,id',
                'batch_id' => 'required|exists:batch,id',
                'no_sertifikat' => 'required|unique:peserta,no_sertifikat,' . $this->editingPesertaId,
                'foto' => 'nullable|image|max:1000',
            ]);

            $validated['qr_code'] = $this->generateQr($this->no_sertifikat);

            $peserta = Peserta::findOrFail($this->editingPesertaId);

            // Update foto jika ada file baru
            if ($this->foto) {
                if ($peserta->foto) {
                    Storage::disk('public')->delete($peserta->foto); // ✅ hapus foto lama
                }
                $validated['foto'] = $this->foto->store('foto', 'public');
            } else {
                unset($validated['foto']); // ✅ jaga foto lama jika tidak upload baru
            }

            $peserta->update($validated);
            session()->flash('success', 'Peserta updated successfully!');
            $this->reset([
                'nik',
                'nama',
                'email',
                'telepon',
                'tempat_lahir',
                'tanggal_lahir',
                'foto',
                'sertifikat_id',
                'batch_id',
                'no_sertifikat'
            ]);

            $this->batches = [];
            $this->isEditing = false;
            $this->editingPesertaId = null;
        } else {
            // Create new peserta
            $validated = $this->validate([
                'nik' => 'required|digits:16',
                'nama' => 'required|string|max:255',
                'email' => 'required|email',
                'telepon' => 'required',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'sertifikat_id' => 'required|exists:sertifikat,id',
                'batch_id' => 'required|exists:batch,id',
                'no_sertifikat' => 'required|unique:peserta,no_sertifikat|string|max:255',
                'foto' => 'required|image|max:1000',
            ]);

            if ($this->foto) {
                $validated['foto'] = $this->foto->store('foto', 'public');
            }
            $validated['qr_code'] = $this->generateQr($this->no_sertifikat);

            Peserta::create($validated);
            session()->flash('success', 'Peserta created successfully!');
            $this->reset([
                'nik',
                'nama',
                'email',
                'telepon',
                'tempat_lahir',
                'tanggal_lahir',
                'foto',
                'sertifikat_id',
                'batch_id',
                'no_sertifikat'
            ]);

            $this->batches = [];
            $this->isEditing = false;
            $this->editingPesertaId = null;
        }
    }

    public function cancelEdit()
    {
        $this->editingPesertaId = null;
        $this->oldFoto = null;
        $this->isEditing = false;
        $this->batches = []; // ✅ tambahkan ini
        $this->reset(['nik', 'nama', 'email', 'telepon', 'tempat_lahir', 'tanggal_lahir', 'foto', 'sertifikat_id', 'batch_id', 'no_sertifikat']);
    }

    public function editPeserta($pesertaId)
    {

        $peserta = Peserta::with('batch')->findOrFail($pesertaId);
        $this->editingPesertaId = $pesertaId;
        $this->isEditing = true;
        $this->nik = $peserta->nik;
        $this->nama = $peserta->nama;
        $this->email = $peserta->email;
        $this->telepon = $peserta->telepon;
        $this->tempat_lahir = $peserta->tempat_lahir;
        $this->tanggal_lahir = $peserta->tanggal_lahir;
        $this->no_sertifikat = $peserta->no_sertifikat;
        $this->oldFoto = $peserta->foto; // simpan foto lama untuk ditampilkan saat edit

        if ($peserta->batch) {
            $this->sertifikat_id = $peserta->batch->sertifikat_id;
            $this->batches = Batch::where('sertifikat_id', $this->sertifikat_id)->get();
            $this->batch_id = $peserta->batch_id;
        }
        session()->flash('info', 'Edit peserta: ' . $peserta->nama);
    }

    public function updatedSertifikatId($value)
    {
        $this->batch_id = null; // reset batch saat sertifikat berubah
        $this->batches = Batch::where('sertifikat_id', $value)->get();
    }


    public function deletePeserta($pesertaId)
    {
        $peserta = Peserta::findOrFail($pesertaId);

        if ($peserta->foto) {
            Storage::disk('public')->delete($peserta->foto);
        }
        if ($peserta->qr_code) {
            Storage::disk('public')->delete($peserta->qr_code);
        }

        $peserta->delete();
        session()->flash('success', 'Peserta deleted successfully!');
    }

    private function resetForm()
    {
        $this->reset([
            'nik',
            'nama',
            'email',
            'telepon',
            'tempat_lahir',
            'tanggal_lahir',
            'foto',
            'sertifikat_id',
            'batch_id',
            'no_sertifikat'
        ]);
        $this->batches = [];
        $this->isEditing = false;
        $this->editingPesertaId = null;
        $this->oldFoto = null;
    }

    public function render()
    {
        $query = Peserta::latest();
        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        }

        $data = [
            'pesertas' => $query->paginate(5),
            'sertifikats' => Sertifikat::all(),
        ];

        // dd($query->first()); // Debug untuk cek relasi batch

        return view('livewire.peserta', $data);
    }
}
