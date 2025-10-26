<?php

namespace App\Filament\Resources\Products\Pages;

use App\Models\Product;
use App\Models\Subscription;
use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\Action;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        if (Auth::user()->role === 'admin') {
            return [
                CreateAction::make(),
            ];
        }

        $subscription = Subscription::where('user_id', Auth::user()->id)
            ->where('end_date', '>', now())
            ->where('is_active', true)
            ->latest()
            ->first();

        $countProduct = Product::where('user_id', Auth::user()->id)->count();

        return [
            Action::make('alert')
                ->label('Produk Kamu Melebihi Batas Penggunaan Gratis, Silahkan Berlangganan')
                ->color('danger')
                ->icon('heroicon-s-exclamation-triangle')
                ->visible(!$subscription && $countProduct >= 5),
            CreateAction::make()
                ->visible($countProduct < 5 || $subscription),
        ];
    }
}
