<?php

namespace App\Filament\Resources\Subscriptions\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Toko')
                    ->hidden(fn() => Auth::user()->role == 'store'), // jika user role nya store maka tidak munculin nama toko
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Tanggal Mulai'),
                TextColumn::make('end_date')
                    ->dateTime()
                    ->label('Tanggal Berakhir'),
                ImageColumn::make('subscriptionPayment.proof')
                    ->label('Bukti Pembayaran'),
                TextColumn::make('subscriptionPayment.status')
                    ->label('Status Pembayaran'),



            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn () => Auth::user()->role === 'admin'), // logo edit hanya akan muncul jika user role nya admin
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
