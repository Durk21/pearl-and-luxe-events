<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentBookingsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';
    protected static ?string $heading = 'Recent Bookings';

    public function table(Table $table): Table
    {
        return $table
            ->query(Booking::with('package')->latest()->limit(8))
            ->columns([
                Tables\Columns\TextColumn::make('reference_number')
                    ->label('Reference')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('client_name')
                    ->label('Client')
                    ->searchable(),

                Tables\Columns\TextColumn::make('client_phone')
                    ->label('Phone'),

                Tables\Columns\TextColumn::make('package.name')
                    ->label('Package')
                    ->badge(),

                Tables\Columns\TextColumn::make('event_date')
                    ->label('Event Date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Amount')
                    ->formatStateUsing(fn($state) => 'KES ' . number_format($state)),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match($state) {
                        'pending'   => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default     => 'gray',
                    }),

                Tables\Columns\IconColumn::make('deposit_paid')
                    ->label('Deposit')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn(Booking $record): string => "/admin/bookings/{$record->id}/edit"),
            ]);
    }
}