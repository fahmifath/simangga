<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubDetilResource\Pages;
use App\Filament\Resources\SubDetilResource\RelationManagers;
use App\Models\SubDetil;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubDetilResource extends Resource
{
    protected static ?string $model = SubDetil::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationGroup = 'Tabel Cascading';

    public static function getModelLabel(): string
    {
        return 'Sub Detil';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Sub Detil';
    }

    public static function getSlug(): string
    {
        return 'sub-detil';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('detil_id')
                    ->label('Detil')
                    ->relationship('detil', 'detil')
                    ->required()
                    ->placeholder('Pilih detil'),
                TextInput::make('sub_detil')
                    ->label('Sub Detil')
                    ->required()
                    ->placeholder('Masukkan nama sub detil'),
                // TextInput::make('quantity') // Pastikan ini sesuai dengan kolom yang ada di database
                //     ->numeric()
                //     ->required()
                //     ->label('Quantity')
                //     ->placeholder('Masukkan quantity'),
                // TextInput::make('satuan')
                //     ->label('Satuan')
                //     ->required()
                //     ->placeholder('Masukkan satuan'),
                // TextInput::make('harga_satuan')
                //     ->label('Harga Satuan')
                //     ->required()
                //     ->placeholder('Masukkan harga satuan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('detil.detil')
                    ->label('Detil')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sub_detil')
                    ->label('Sub Detil')
                    ->searchable()
                    ->sortable(),
                // TextColumn::make('quantity')
                //     ->label('Quantity')
                //     ->searchable()
                //     ->sortable(),
                // TextColumn::make('satuan')
                //     ->label('Satuan')
                //     ->searchable()
                //     ->sortable(),
                // TextColumn::make('harga_satuan')
                //     ->label('Harga Satuan')
                //     ->searchable()
                //     ->sortable(),
                // TextColumn::make('jumlah')
                //     ->label('Jumlah')
                //     // ->value(function ($record) {
                //     //     return $record->qty * $record->harga_satuan;
                //     // })
                //     ->searchable()
                //     ->sortable(),
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
            'index' => Pages\ListSubDetils::route('/'),
            'create' => Pages\CreateSubDetil::route('/create'),
            'edit' => Pages\EditSubDetil::route('/{record}/edit'),
        ];
    }
}
