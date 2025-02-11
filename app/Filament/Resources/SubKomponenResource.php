<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SubKomponen;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SubKomponenResource\Pages;
use App\Filament\Resources\SubKomponenResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class SubKomponenResource extends Resource
{
    protected static ?string $model = SubKomponen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $sort = 6;
    protected static ?int $navigationSort = 5;

    public static function getModelLabel(): string
    {
        return 'Sub Komponen';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Sub Komponen';
    }

    public static function getSlug(): string
    {
        return 'sub-komponen';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('komponen_id')
                    ->label('Komponen')
                    ->relationship('komponen', 'komponen')
                    ->required()
                    ->placeholder('Pilih komponen'),
                TextInput::make('sub_komponen')
                    ->label('Sub Komponen')
                    ->required()
                    ->placeholder('Masukkan nama sub komponen'),
                TextInput::make('kode')
                    ->label('Kode')
                    ->required()
                    ->placeholder('Masukkan kode sub komponen'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('komponen.kode')
                    ->label('Kode Komponen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('komponen.komponen')
                    ->label('Komponen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sub_komponen')
                    ->label('Sub Komponen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kode')
                    ->label('Kode Sub Komponen')
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
            'index' => Pages\ListSubKomponens::route('/'),
            'create' => Pages\CreateSubKomponen::route('/create'),
            'edit' => Pages\EditSubKomponen::route('/{record}/edit'),
        ];
    }
}
