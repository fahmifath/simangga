<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SasaranKegiatanResource\Pages;
use App\Filament\Resources\SasaranKegiatanResource\RelationManagers;
use App\Models\SasaranKegiatan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SasaranKegiatanResource extends Resource
{
    protected static ?string $model = SasaranKegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $sort = 2;

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Sasaran Kegiatan';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Sasaran Kegiatan';
    }

    public static function getSlug(): string
    {
        return 'sasaran-kegiatan';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('sasaran_kegiatan')
                    ->label('Sasaran Kegiatan')
                    ->required()
                    ->placeholder('Masukkan sasaran kegiatan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sasaran_kegiatan')
                    ->label('Sasaran Kegiatan')
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
            'index' => Pages\ListSasaranKegiatans::route('/'),
            'create' => Pages\CreateSasaranKegiatan::route('/create'),
            'edit' => Pages\EditSasaranKegiatan::route('/{record}/edit'),
        ];
    }
}
