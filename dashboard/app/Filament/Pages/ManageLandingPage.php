<?php

namespace App\Filament\Pages;

use App\Models\LandingContent;
use App\Models\LandingSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ManageLandingPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.manage-landing-page';

    public ?array $data = [];

    protected static array $sectionLabels = [
        'header' => 'Navigation & Header',
        'hero' => 'Hero Section',
        'trust_bar' => 'Trust Bar',
        'problem' => 'Problem / Comparison Section',
        'pillars' => 'Pillars — What You Get',
        'pricing_calculator' => 'Pricing Calculator',
        'team' => 'Team Section',
        'faq' => 'FAQ Section',
        'footer' => 'Footer & Final CTA',
        'booking_modal' => 'Booking Modal',
    ];

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

    public function getTitle(): string
    {
        return 'Landing Page Content';
    }

    public function mount(): void
    {
        $this->data = LandingContent::orderBy('sort_order')
            ->get()
            ->mapWithKeys(fn (LandingContent $row) => [
                $row->key => ['en' => $row->en, 'ar' => $row->ar],
            ])
            ->toArray();

        $setting = LandingSetting::current();
        $this->data['_seo'] = [
            'meta_title' => $setting->meta_title,
            'meta_description' => $setting->meta_description,
            'whatsapp_number' => $setting->whatsapp_number,
            'og_image_url' => $setting->og_image_url,
        ];

        $this->form->fill($this->data);
    }

    public function form(Schema $schema): Schema
    {
        $rows = LandingContent::orderBy('sort_order')->get()->groupBy('section');

        $sections = [
            Section::make('SEO & Contact')
                ->description('The browser tab title, search engine snippet, and the WhatsApp number the booking form messages.')
                ->schema([
                    TextInput::make('_seo.meta_title')
                        ->label('Page Title (browser tab / search results)')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('_seo.meta_description')
                        ->label('Meta Description (search engine snippet)')
                        ->rows(2)
                        ->required()
                        ->maxLength(500),
                    TextInput::make('_seo.whatsapp_number')
                        ->label('WhatsApp Number')
                        ->helperText('Digits only, with country code, no + or spaces — e.g. 971501234567')
                        ->required()
                        ->rule('regex:/^[0-9]+$/'),
                    TextInput::make('_seo.og_image_url')
                        ->label('Social Share Image (Open Graph)')
                        ->url()
                        ->helperText('Shown when the site is shared on WhatsApp, Facebook, LinkedIn, etc. Leave blank to omit.')
                        ->columnSpanFull(),
                ])
                ->collapsible(),
        ];

        foreach ($rows as $sectionKey => $sectionRows) {
            $fields = [];
            foreach ($sectionRows as $row) {
                $fields[] = Grid::make(2)
                    ->schema([
                        Textarea::make("{$row->key}.en")
                            ->label($this->fieldLabel($row->key).' (English)')
                            ->rows(2)
                            ->required(),
                        Textarea::make("{$row->key}.ar")
                            ->label($this->fieldLabel($row->key).' (Arabic)')
                            ->rows(2)
                            ->extraInputAttributes(['dir' => 'rtl'])
                            ->required(),
                    ]);
            }

            $sections[] = Section::make(static::$sectionLabels[$sectionKey] ?? $sectionKey)
                ->schema($fields)
                ->collapsible()
                ->collapsed(false);
        }

        return $schema
            ->components($sections)
            ->statePath('data');
    }

    protected function fieldLabel(string $key): string
    {
        return ucwords(str_replace('_', ' ', $key));
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
        $state = $this->form->getState();

        $seo = $state['_seo'];
        unset($state['_seo']);

        LandingSetting::current()->update($seo);

        foreach ($state as $key => $values) {
            LandingContent::where('key', $key)->update([
                'en' => $values['en'],
                'ar' => $values['ar'],
            ]);
        }

        Notification::make()
            ->title('Landing page content updated successfully')
            ->success()
            ->send();
    }
}
