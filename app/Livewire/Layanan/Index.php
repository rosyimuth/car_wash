<?php

namespace App\Livewire\Layanan;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $foto, $nama, $jenis, $deskripsi, $harga;

    public $perPage = 4;

    public $search = '';
    public $jenisFilter = '';
    public $isOpen = false;
    public $selectedLayanan = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingJenisFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Service::query();

        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        }

        if ($this->jenisFilter) {
            $query->where('jenis', $this->jenisFilter);
        }

        $layanan = $query->latest()->paginate($this->perPage);

        return view('livewire.layanan.index', compact('layanan'));
    }

    public function showModal($id)
    {
        $this->selectedLayanan = Service::find($id);
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->selectedLayanan = null;
    }
}
