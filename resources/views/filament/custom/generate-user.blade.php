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
            <x-filament::button wire:click="generate_siswa" type="submit" size="xl">
                {{-- <x-filament::loading-indicator class="w-5 h-5 p-0 m-0" /> --}}
                <div wire:loading.remove wire:target="generate_siswa">
                    Generate Siswa
                    {{-- Processing Payment... --}}
                </div>
                <div wire:loading wire:target="generate_siswa">
                    {{-- <x-filament::loading-indicator class="inline-flex w-5 h-5" /> --}}
                    Loading....
                    {{-- Processing Payment... --}}
                </div>
            </x-filament::button>

            <x-filament::button wire:click="generate_gtk" type="submit" size="xl">
                {{-- <x-filament::loading-indicator class="w-5 h-5 p-0 m-0" /> --}}
                <div wire:loading.remove wire:target="generate_gtk">
                    Generate Gtk
                </div>
                <div wire:loading wire:target="generate_gtk">
                    {{-- <x-filament::loading-indicator class="inline-flex w-5 h-5" /> --}}
                    Loading....
                    {{-- Processing Payment... --}}
                </div>
            </x-filament::button>

        </div>
        <div>
            {{ $data }}
        </div>
    </div>
</div>
