<?php

namespace App\Livewire\Jadwal;

use App\Models\Schedule;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = '';

    public $perPage = 5;
    public $hariFilter = '';
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingJenisFilter()
    {
        $this->resetPage();
    }

    public function getHariFilterEnglishProperty()
    {
        $map = [
            'Senin' => 'Monday',
            'Selasa' => 'Tuesday',
            'Rabu' => 'Wednesday',
            'Kamis' => 'Thursday',
            'Jumat' => 'Friday',
            'Sabtu' => 'Saturday',
            'Minggu' => 'Sunday',
        ];

        return $map[$this->hariFilter] ?? null;
    }


    public function render()
    {
        $query = Schedule::query();

        // Pencarian umum
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('tanggal', 'like', '%' . $this->search . '%')
                ->orWhere('jam_mulai', 'like', '%' . $this->search . '%')
                ->orWhere('jam_selesai', 'like', '%' . $this->search . '%')
                ->orWhere('kuota', 'like', '%' . $this->search . '%');
            });
        }

        // Filter berdasarkan Hari (Senin, Selasa, ...)
        if ($this->hariFilter) {
            $query->whereRaw("DAYNAME(tanggal) = ?", [$this->hariFilterEnglish]);
        }

        $jadwal = $query->orderBy('tanggal', 'asc')->paginate($this->perPage);

        return view('livewire.jadwal.index', compact('jadwal'));
    }
}
