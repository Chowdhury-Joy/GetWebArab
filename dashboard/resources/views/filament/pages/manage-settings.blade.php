<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament::button type="submit" size="lg">
            Save Changes
        </x-filament::button>
    </x-filament-panels::form>
</x-filament-panels::page>
