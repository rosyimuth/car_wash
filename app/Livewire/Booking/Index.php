<?php

namespace App\Livewire\Booking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Service;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterSchedule = '';
    public $filterMerk = '';
    public $perPage = 10;

    public $showModalAdd = false;
    public $showModalDetail = false;
    public $showModalEdit = false;

    public $editBooking = [
        'user_id' => null,
        'plat_nomor' => '',
        'merk' => '',
        'schedule_id' => '',
        'service_id' => '',
    ];

    public $newBooking = [
        'user_id' => null,
        'plat_nomor' => '',
        'merk' => '',
        'schedule_id' => '',
        'service_id' => '',
    ];

    public $selectedBookingId = null;
    public $selectedBooking = null;

    public $jadwalList = [];
    public $merkList = [];
    public $serviceList = [];

    public function mount()
    {
        $this->newBooking['user_id'] = auth()->id();
        $this->editBooking['user_id'] = auth()->id();

        $this->jadwalList = Schedule::orderBy('tanggal')->pluck('tanggal', 'id')->toArray();
        $this->merkList = Booking::select('merk')->distinct()->pluck('merk')->toArray();
        $this->serviceList = Service::orderBy('nama')->pluck('nama', 'id')->toArray();
    }

    public function render()
    {
        $query = Booking::with(['user', 'schedule', 'service'])
            ->when($this->search, function($q) {
                $q->whereHas('user', fn($q2) => $q2->where('name', 'like', "%{$this->search}%"))
                  ->orWhere('plat_nomor', 'like', "%{$this->search}%")
                  ->orWhere('merk', 'like', "%{$this->search}%");
            })
            ->when($this->filterSchedule, fn($q) => $q->where('schedule_id', $this->filterSchedule))
            ->when($this->filterMerk, fn($q) => $q->where('merk', $this->filterMerk))
            ->orderBy('schedule_id', 'asc');

        $bookings = $query->paginate($this->perPage);

        return view('livewire.booking.index', compact('bookings'));
    }

    public function openAddModal()
    {
        $this->resetValidation();
        $this->newBooking = [
            'user_id' => auth()->id(),
            'plat_nomor' => '',
            'merk' => '',
            'schedule_id' => '',
            'service_id' => '',
        ];
        $this->showModalAdd = true;
    }

    public function saveBooking()
    {
        $this->validate([
            'newBooking.plat_nomor' => 'required|string|max:50',
            'newBooking.merk' => 'required|string|max:100',
            'newBooking.schedule_id' => 'required|exists:schedules,id',
            'newBooking.service_id' => 'required|exists:services,id',
        ]);

        Booking::create(array_merge($this->newBooking, [
            'user_id' => auth()->id(),
        ]));

        $this->showModalAdd = false;
        session()->flash('message', 'Booking berhasil ditambahkan.');
        $this->resetPage();
    }

    public function openDetailModal($id)
    {
        $this->selectedBookingId = $id;
        $this->selectedBooking = Booking::with(['user', 'schedule', 'service'])->find($id);
        $this->showModalDetail = true;
    }

    public function openEditModal($id)
    {
        $booking = Booking::findOrFail($id);

        if (auth()->id() !== $booking->user_id) {
            session()->flash('error', 'Anda tidak berhak mengedit booking ini.');
            return;
        }

        $this->selectedBookingId = $id;

        $this->editBooking = [
            'user_id' => auth()->id(),
            'plat_nomor' => $booking->plat_nomor,
            'merk' => $booking->merk,
            'schedule_id' => $booking->schedule_id,
            'service_id' => $booking->service_id,
        ];

        $this->showModalDetail = false;
        $this->showModalEdit = true;
    }

    public function updateBooking()
    {
        $this->validate([
            'editBooking.plat_nomor' => 'required|string|max:50',
            'editBooking.merk' => 'required|string|max:100',
            'editBooking.schedule_id' => 'required|exists:schedules,id',
            'editBooking.service_id' => 'required|exists:services,id',
        ]);

        $booking = Booking::findOrFail($this->selectedBookingId);

        if (auth()->id() !== $booking->user_id) {
            session()->flash('error', 'Anda tidak berhak mengupdate booking ini.');
            return;
        }

        $booking->update($this->editBooking);

        $this->showModalEdit = false;
        session()->flash('message', 'Booking berhasil diperbarui.');
    }

    public function deleteBooking()
    {
        if (auth()->id() !== $this->selectedBooking->user_id) {
            session()->flash('error', 'Anda tidak berhak menghapus booking ini.');
            return;
        }

        $this->selectedBooking->delete();

        $this->showModalDetail = false;
        session()->flash('message', 'Booking berhasil dihapus.');
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModalAdd = false;
        $this->showModalDetail = false;
        $this->showModalEdit = false;
        $this->selectedBooking = null;
        $this->selectedBookingId = null;
        $this->resetValidation();
    }
}
