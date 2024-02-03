@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show mt-2" role="alert" wire:poll.2000ms>
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" wire:click="$set('message', null)">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
