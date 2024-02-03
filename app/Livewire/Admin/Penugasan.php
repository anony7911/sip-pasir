<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Penjualan;
use App\Models\Penugasan as ModelsPenugasan;
use Livewire\Attributes\On; // Add this import statement

class Penugasan extends Component
{
    public $month;
    public $year;
    public $daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    public $calendar = [];
    public $selectedDate;
    public $keterangan;
    public $holidays = [];
    public $listHariLibur;
    public $isPrevMonth = false;
    public $isNextMonth = false;

    // public $listPenjualan;

    // protected $listeners = ['openModal' => 'showModal', 'closeModal' => 'hideModal'];
    // protected $listeners = ['selectDate'];


    public function mount()
    {
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->loadHolidays();
        $this->generateCalendar();
    }

    public function loadHolidays()
    {

        $this->holidays = Penjualan::whereYear('tanggal_pengantaran', $this->year)->whereMonth('tanggal_pengantaran', $this->month)->pluck('tanggal_pengantaran')->toArray();
        $this->generateCalendar();

    }

    // Metode untuk menangani klik tanggal
    #[On('selectDate')]
    public function selectDate($day)
    {
        $this->selectedDate = $day;
        $this->dispatch('openModal');
    }

    public function hapusHariLibur($day)
    {
        // $hariLibur = Kalenderkerja::whereYear('tanggal_libur', $this->year)->whereMonth('tanggal_libur', $this->month)->whereDay('tanggal_libur',$day)->first();
        // $hariLibur->delete();
        // $this->loadHolidays();

    }

    public function generateCalendar()
    {
        $firstDayOfMonth = Carbon::createFromDate($this->year, $this->month, 1);
        $lastDayOfMonth = Carbon::createFromDate($this->year, $this->month, 1)->endOfMonth();

        $startOfWeek = $firstDayOfMonth->dayOfWeek;

        $this->calendar = [];

        $currentDay = $firstDayOfMonth->copy()->subDays($startOfWeek);

        while ($currentDay->lte($lastDayOfMonth)) {
            $week = [];

            for ($i = 0; $i < 7; $i++) {
                $day = [
                    'day' => $currentDay->day,
                    'events' => [], // Placeholder for events, you can replace this with your event data
                    'isHoliday' =>$this->isHoliday($currentDay->format('Y-m-d')),
                    'nextMonth' => $currentDay->month != $firstDayOfMonth->month,
                    'isPrevMonth' => $currentDay->month != $firstDayOfMonth->month,
                    'isNextMonth' => $currentDay->month != $firstDayOfMonth->month,
                ];

                //Tandai bulan sebelumnya
                // if ($currentDay->lt($firstDayOfMonth)) {
                //     $day['prevMonth'] = true;
                // }

                // Tandai tanggal hari ini
                if ($currentDay->isToday()) {
                    $day['today'] = true;
                }

                $week[] = $day;

                $currentDay->addDay();
            }

            $this->calendar[] = $week;
        }
    }

    private function isHoliday($date)
    {
        return in_array($date, $this->holidays);
    }
    public function previousMonth()
    {
        $this->month--;
        if ($this->month < 1) {
            $this->month = 12;
            $this->year--;
        }

        // $this->generateCalendar();
        $this->loadHolidays();
    }

    public function nextMonth()
    {
        $this->month++;
        if ($this->month > 12) {
            $this->month = 1;
            $this->year++;
        }

        // $this->generateCalendar();
        $this->loadHolidays();
    }

    public function render()
    {
        // $monthName = Carbon::createFromDate($this->year, $this->month, 1)->format('F');
        $monthName = Carbon::createFromDate($this->year, $this->month, 1)->isoFormat('MMMM');
        $listPenjualan = Penjualan::whereYear('tanggal_pengantaran', $this->year)->whereMonth('tanggal_pengantaran', $this->month)
                    ->where('status', '!=', 'batal')
                    ->where('status', '!=', 'menunggu')
                    ->get();

        return view('livewire.admin.penugasan', compact('monthName', 'listPenjualan'))->title('Penugasan');
    }

    // public function simpanHariLibur()
    // {
    //     $this->validate([
    //         'selectedDate' => 'required',
    //         'keterangan' => 'required',
    //     ]);

    //     $tanggal = Carbon::createFromDate($this->year, $this->month, $this->selectedDate)->format('Y-m-d');
    //     $libur = new Kalenderkerja;
    //     $libur->tanggal_libur       = $tanggal;
    //     $libur->tahun               = $this->year;
    //     $libur->bulan               = $this->month;
    //     $libur->keterangan_libur    = $this->keterangan;
    //     $libur->save();

    //     $this->loadHolidays();
    //     session()->flash('message', 'Hari libur berhasil ditambahkan.');
    //     $this->emit('closeModal'); // Tutup modal
    //     $this->keterangan = ''; // Reset inputan
    // }

    public function selesai($id)
    {
        // Update task status to 'selesai'
        ModelsPenugasan::where('penjualan_id', $id)->update(['status' => 'selesai']);

        // Check if all tasks for the given sale are completed
        $penjualanStatus = ModelsPenugasan::where('penjualan_id', $id)->where('status', '!=', 'selesai')->doesntExist();

        // dd($penjualanStatus);
        // If all tasks are completed, update sale status to 'selesai'
        if ($penjualanStatus) {
            Penjualan::find($id)->update(['status' => 'selesai']);
        }

        session()->flash('message', 'Penugasan berhasil diselesaikan.');
    }

}
