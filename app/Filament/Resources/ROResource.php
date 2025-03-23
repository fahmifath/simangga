<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ROResource\Pages;
use App\Filament\Resources\ROResource\RelationManagers;
use App\Models\RO;
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

class ROResource extends Resource
{
    protected static ?string $model = RO::class;

    protected static ?string $title = 'RO';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Tabel Cascading';

    public static function getModelLabel(): string
    {
        return 'RO';
    }

    public static function getPluralModelLabel(): string
    {
        return 'RO';
    }

    public static function getSlug(): string
    {
        return 'ro';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('iku_id')
                    ->label('IKU')
                    ->relationship('iku', 'iku',
                    fn ($query) => $query->orderBy('id', 'asc'))
                    ->required()
                    ->placeholder('Pilih IKU'),

                TextInput::make('ro')
                    ->label('RO')
                    ->required()
                    ->placeholder('Masukkan nama RO'),
                TextInput::make('kode')
                    ->label('Kode')
                    ->required()
                    ->placeholder('Masukkan kode RO'),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ro')
                    ->label('RO')
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
            'index' => Pages\ListROS::route('/'),
            'create' => Pages\CreateRO::route('/create'),
            'edit' => Pages\EditRO::route('/{record}/edit'),
        ];
    }
}
