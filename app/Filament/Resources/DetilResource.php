<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Detil;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DetilResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DetilResource\RelationManagers;

class DetilResource extends Resource
{
    protected static ?string $model = Detil::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Tabel Cascading';

    public static function getModelLabel(): string
    {
        return 'Detil';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Detil';
    }

    public static function getSlug(): string
    {
        return 'detil';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('sub_komponen_id')
                    ->label('Sub Komponen')
                    ->relationship(
                        'subKomponen', 'sub_komponen',
                        fn ($query) => $query->orderBy('id', 'asc'))
                    ->required()
                    ->placeholder('Pilih sub komponen'),
                TextInput::make('detil')
                    ->label('Detil')
                    ->required()
                    ->placeholder('Masukkan nama detil'),
                TextInput::make('kode')
                    ->label('Kode')
                    ->required()
                    ->placeholder('Masukkan kode detil'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subKomponen.kode')
                    ->label('Kode Sub Komponen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subKomponen.sub_komponen')
                    ->label('Sub Komponen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('detil')
                    ->label('Detil')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kode')
                    ->label('Kode Detil')
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
            'index' => Pages\ListDetils::route('/'),
            'create' => Pages\CreateDetil::route('/create'),
            'edit' => Pages\EditDetil::route('/{record}/edit'),
        ];
    }
}
