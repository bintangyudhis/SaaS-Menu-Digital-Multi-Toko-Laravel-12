<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use App\Models\ProductCategory;
use Dom\Text;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Toko')
                    ->relationship('user', 'name')
                    ->required()
                    ->reactive()
                    ->hidden(fn() => Auth::user() -> role == 'store'),

                Select::make('product_category_id')
                    ->label('Kategori Produk')
                    ->required()
                    ->relationship('productCategory', 'name')
                    ->disabled(fn(callable $get) => $get('user_id') == null) // jika user id nya null maka disable,
                    ->options(function(callable $get) {
                        $userId = $get('user_id'); // ambil user id

                        if(!$userId){
                            return []; //jika gada/belum memilih user id maka tampilan kategori produknya kosong
                        }

                        return ProductCategory::where('user_id', $userId) // muncul kategori produk berdasarkan user id
                        ->pluck('name', 'id');
                    })
                    ->hidden(fn() => Auth::user() -> role === 'store'),

                Select::make('product_category_id')
                    ->label('Kategori Produk')
                    ->required()
                    ->relationship('productCategory', 'name')
                    ->options(function(callable $get) {
                        return ProductCategory::where('user_id', Auth::user()->id)
                        ->pluck('name', 'id');
                    })
                    ->hidden(fn() => Auth::user() -> role === 'admin'),

                FileUpload::make('image')
                    ->label('Foto Menu')
                    ->image()
                    ->required(),

                TextInput::make('name')
                    ->label('Nama Menu')
                    ->required(),

                Textarea::make('description')
                    ->label('Deskripsi Menu')
                    ->required(),

                TextInput::make('price')
                    ->label('Harga Menu')
                    ->numeric()
                    ->required(),

                TextInput::make('rating')
                    ->label('Rating Menu')
                    ->numeric()
                    ->required(),

                Toggle::make('is_popular')
                    ->label('Popular Menu')
                    ->required(),
                Repeater::make('productIngredients')
                    ->label('Bahan Baku Menu')
                    ->relationship('productIngredients')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Bahan')
                            ->required(),
                    ])->columnSpanFull()

            ]);
    }
}
