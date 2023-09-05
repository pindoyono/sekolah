<div>
    <x-filament::breadcrumbs :breadcrumbs="[
        '/' => 'Home',
        '/admin/sekolahs' => 'Sekolah',
    ]" />
    {{-- <h1>
        Sinkron
    </h1> --}}
    {{-- <div class="flex justify-between mt-1 ">
        <div class="text-3xl font-bold ">
            Sinkronisasi Data Sekolah
        </div>
    </div> --}}
    <div class="flex justify-between mt-1 ">
        <div>
            <form wire:submit="generate_siswa" class="">
                {{-- <input type="text" placeholder="NPSN" wire:model='npsn' class="px-120"> --}}
                {{-- <input type="text" placeholder="Token Dapodik" wire:model='token' class="px-120"> --}}

                <x-filament::button type="submit" size="xl">
                    generate
                </x-filament::button>
            </form>
        </div>
        <div>
            {{ $data }}
        </div>
    </div>
</div>
