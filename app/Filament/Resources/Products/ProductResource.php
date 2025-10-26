<?php

namespace App\Filament\Resources\Products;

use UnitEnum;
use BackedEnum;
use App\Models\Product;
use Filament\Tables\Table;
use App\Models\Subscription;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag;

    protected static ?string $navigationLabel = 'Manajemen Produk';

    protected static string | UnitEnum |null $navigationGroup = 'Manjemen Menu';

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user(); // panggil user yang sedang login

        if ($user->role === 'admin') {
            return parent::getEloquentQuery(); // kalau user role nya admin  dia akan menampilkan semua data yang ada
        }

        return parent::getEloquentQuery()->where('user_id', $user->id); // ketika selain admin dia akan melakukan filter berdasarkan user id
    }

    public static function canCreate(): bool
    {
        // jika admin bisa mengcreate
        if (Auth::user()-> role === 'admin') {
            return true;
        }

        // kalau bukan admin di cek subscriptionnya berdasarkan id
        $subscription = Subscription::where('user_id', Auth::user()->id)
            ->where('end_date', '>', now())
            ->where('is_active', true)
            ->latest()
            ->first();

            $countProduct = Product::where('user_id', Auth::user()->id)->count(); // cek jumlah produk user

            return !($countProduct >= 5 && !$subscription); // mereturn user yang sudah melebihi 5 produk dan tidak ada subscription maka user tidak bisa membuat produk
    }

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
