<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Site Settings';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')
                ->required()->unique(ignoreRecord: true)->disabled(fn($record) => $record !== null),
            Forms\Components\Select::make('group')
                ->options([
                    'general' => 'General',
                    'hero'    => 'Hero Section',
                    'stats'   => 'Statistics',
                    'contact' => 'Contact',
                    'social'  => 'Social Media',
                ])->required(),
            Forms\Components\Textarea::make('value')->rows(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('group')->badge()->sortable(),
                Tables\Columns\TextColumn::make('key')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('value')->limit(60)->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'hero'    => 'Hero Section',
                        'stats'   => 'Statistics',
                        'contact' => 'Contact',
                        'social'  => 'Social Media',
                    ]),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->defaultSort('group');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit'   => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}