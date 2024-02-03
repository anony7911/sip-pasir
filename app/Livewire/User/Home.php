<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Home extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        //tampilkan 2 produk terbaru
        $produk = \App\Models\Produk::latest()->take(2)->get();
        return view('livewire.user.home', compact('produk'))->title('Home');
    }
}
