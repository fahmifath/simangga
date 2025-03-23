<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Komponen;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KomponenResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KomponenResource\RelationManagers;

class KomponenResource extends Resource
{
    protected static ?string $model = Komponen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Tabel Cascading';

    public static function getModelLabel(): string
    {
        return 'Komponen';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Komponen';
    }

    public static function getSlug(): string
    {
        return 'komponen';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ro_id')
                    ->label('RO')
                    ->relationship('ro', 'ro',
                    fn ($query) => $query->orderBy('id', 'asc'))
                    ->required()
                    ->placeholder('Pilih RO'),

                TextInput::make('komponen')
                    ->label('Komponen')
                    ->required()
                    ->placeholder('Masukkan nama komponen'),
                TextInput::make('kode')
                    ->label('Kode')
                    ->required()
                    ->placeholder('Masukkan kode komponen'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ro.kode')
                    ->label('Kode RO')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('komponen')
                    ->label('Komponen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListKomponens::route('/'),
            'create' => Pages\CreateKomponen::route('/create'),
            'edit' => Pages\EditKomponen::route('/{record}/edit'),
        ];
    }
}
