<?php

namespace App\Filament\Resources\ProductCategories\Tables;

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
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\View;
use Filament\Tables\Filters\SelectFilter;

class ProductCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Toko')
                    ->hidden(fn() => Auth::user()->role == 'store'),

                TextColumn::make('name')
                    ->label('Nama Kategori'),
            ])
            ->filters([
                TrashedFilter::make(),

                SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->label('Toko')
                    ->hidden(fn() => Auth::user()->role == 'store'),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
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
