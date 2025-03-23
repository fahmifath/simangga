<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pengajuan;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PengajuanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajuanResource extends Resource
{
    protected static ?string $model = Pengajuan::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?int $navigationSort = -1;

    protected static ?string $navigationGroup = 'Pengajuan';

    public static function getModelLabel(): string
    {
        return 'Pengajuan';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Pengajuan';
    }

    public static function getSlug(): string
    {
        return 'pengajuan';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_id')
                    ->default(Filament::auth()->user()->id)
                    ->disabled()
                    ->dehydrated(),

                Select::make('sasaran_kegiatan_id')
                    ->label('Sasaran Kegiatan')
                    ->relationship(
                        'sasaranKegiatan',
                        'sasaran_kegiatan',
                        fn($query) => $query->orderBy('id', 'asc')
                    )
                    ->required()
                    ->placeholder('Pilih Sasaran Kegiatan')
                    ->reactive(), // Menjadikan dropdown ini sebagai trigger untuk select lainnya

                Select::make('iku_id')
                    ->label('IKU')
                    ->options(
                        fn(callable $get) =>
                        \App\Models\Iku::where('sasaran_kegiatan_id', $get('sasaran_kegiatan_id'))
                            ->pluck('iku', 'id')
                    )
                    ->required()
                    ->placeholder('Pilih IKU')
                    ->disabled(fn(callable $get) => empty($get('sasaran_kegiatan_id'))) // Disabled jika Sasaran Kegiatan belum dipilih
                    ->reactive(),

                Select::make('ro_id')
                    ->label('RO')
                    ->options(
                        fn(callable $get) =>
                        \App\Models\Ro::where('iku_id', $get('iku_id'))
                            ->pluck('ro', 'id')
                    )
                    ->required()
                    ->placeholder('Pilih RO')
                    ->disabled(fn(callable $get) => empty($get('iku_id')))
                    ->reactive(),

                Select::make('komponen_id')
                    ->label('Komponen')
                    ->options(
                        fn(callable $get) =>
                        \App\Models\Komponen::where('ro_id', $get('ro_id'))
                            ->pluck('komponen', 'id')
                    )
                    ->required()
                    ->placeholder('Pilih Komponen')
                    ->disabled(fn(callable $get) => empty($get('ro_id')))
                    ->reactive(),

                Select::make('sub_komponen_id')
                    ->label('Sub Komponen')
                    ->options(
                        fn(callable $get) =>
                        \App\Models\SubKomponen::where('komponen_id', $get('komponen_id'))
                            ->pluck('sub_komponen', 'id')
                    )
                    ->required()
                    ->placeholder('Pilih Sub Komponen')
                    ->disabled(fn(callable $get) => empty($get('komponen_id')))
                    ->reactive(),

                Select::make('detil_id')
                    ->label('Detil')
                    ->options(
                        fn(callable $get) =>
                        \App\Models\Detil::where('sub_komponen_id', $get('sub_komponen_id'))
                            ->pluck('detil', 'id')
                    )
                    ->required()
                    ->placeholder('Pilih Detil')
                    ->disabled(fn(callable $get) => empty($get('sub_komponen_id')))
                    ->reactive(),

                Select::make('sub_detil_id')
                    ->label('Sub Detil')
                    ->options(
                        fn(callable $get) =>
                        \App\Models\SubDetil::where('detil_id', $get('detil_id'))
                            ->pluck('sub_detil', 'id')
                    )
                    ->required()
                    ->placeholder('Pilih Sub Detil')
                    ->disabled(fn(callable $get) => empty($get('detil_id')))
                    ->reactive(),

                TextInput::make('pengaju')
                    ->label('Pengaju')
                    ->required()
                    ->placeholder('Masukkan nama pengaju'),

                TextInput::make('qty')
                    ->label('Qty')
                    ->required()
                    ->placeholder('Masukkan jumlah qty'),

                TextInput::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->required()
                    ->placeholder('Masukkan harga satuan'),

            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Filament::auth()->user();
        return $table
            ->query(
                Pengajuan::query()->when(!$user->hasRole('super_admin'), function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
            )
            ->columns([
                TextColumn::make('subDetil.sub_detil')
                    ->label('Detail Pengajuan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pengaju')
                    ->label('Pengaju')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('qty')
                    ->label('Qty')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('accept')
                    ->label('Terima')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn(Pengajuan $record) => $record->update(['status' => 'accepted'])),

                Action::make('decline')
                    ->label('Tolak')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->action(fn(Pengajuan $record) => $record->update(['status' => 'declined'])),

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
            'index' => Pages\ListPengajuans::route('/'),
            'create' => Pages\CreatePengajuan::route('/create'),
            'edit' => Pages\EditPengajuan::route('/{record}/edit'),
        ];
    }
}
