<?php

namespace App\Filament\Pages;

use App\Models\Settings;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-cog-6-tooth';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

    public function getTitle(): string 
    {
        return 'Global Settings';
    }

    protected string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Settings::first();
        if ($settings) {
            $this->form->fill($settings->toArray());
        }
    }

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->schema([
                Section::make('Partner Splits')
                    ->description('Define the revenue sharing percentages.')
                    ->schema([
                        TextInput::make('partner_setup_pct')
                            ->label('Partner Setup Fee Split (%)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100),
                        TextInput::make('partner_monthly_pct')
                            ->label('Partner Monthly Split (%)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100),
                    ])->columns(2),
                
                Section::make('Founder Rules')
                    ->description('Rules for founder tier clients.')
                    ->schema([
                        TextInput::make('founder_discount_pct')
                            ->label('Founder Monthly Discount (%)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100),
                        TextInput::make('founder_client_cap')
                            ->label('Founder Client Cap')
                            ->required()
                            ->integer()
                            ->minValue(0),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->submit('save')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $settings = Settings::current();
        $settings->update($this->form->getState());

        Notification::make()
            ->title('Settings updated successfully')
            ->success()
            ->send();
    }
}
