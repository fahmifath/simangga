<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IKUResource\Pages;
use App\Filament\Resources\IKUResource\RelationManagers;
use App\Models\IKU;
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

class IKUResource extends Resource
{
    protected static ?string $model = IKU::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return 'IKU';
    }

    public static function getPluralModelLabel(): string
    {
        return 'IKU';
    }

    public static function getSlug(): string
    {
        return 'iku';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('sasaran_kegiatan_id')
                    ->label('Sasaran Kegiatan')
                    ->relationship('sasaranKegiatan', 'sasaran_kegiatan')
                    ->required()
                    ->placeholder('Pilih sasaran kegiatan'),

                TextInput::make('iku')
                    ->label('IKU')
                    ->required()
                    ->placeholder('Masukkan nama IKU'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('iku')
                    ->label('IKU')
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
            'index' => Pages\ListIKUS::route('/'),
            'create' => Pages\CreateIKU::route('/create'),
            'edit' => Pages\EditIKU::route('/{record}/edit'),
        ];
    }
}
