<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id') // memilih user id
                ->label('Toko')
                    ->options(User::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->hidden(fn() => Auth::user() -> role === 'store'), // tidak akan di tampilkan jika user role nya store
                Toggle::make('is_active')
                    ->required()
                    ->hidden(fn() => Auth::user() -> role === 'store'),
                Repeater::make('subscriptionPayment') // pembayaran
                    ->relationship()
                    ->schema([
                        FileUpload::make('proof') // bukti pembayaran
                            ->label('Bukti Transfer Ke Rekening 1234567 (BRI) A/N Bintang Yudhistira Sebesar Rp. 50.000')
                            ->required()
                            ->columnSpanfull(),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'success' => 'Success',
                                'failed' => 'Failed',
                            ])
                            ->required()
                            ->label('Status Pembayaran')
                            ->columnSpanFull()
                            ->hidden(fn() => Auth::user() -> role === 'store'),
                    ])
                    ->columnSpanFull()
                    ->addable(false)
            ]);
    }
}
