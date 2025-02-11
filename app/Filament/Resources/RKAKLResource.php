<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Detil;
use App\Models\RKAKL;
use App\Models\Komponen;
use App\Models\SubDetil;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SubKomponen;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RKAKLResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RKAKLResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;

class RKAKLResource extends Resource
{
    protected static ?string $model = RKAKL::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'RKAKL';
    }

    public static function getPluralModelLabel(): string
    {
        return 'RKAKL';
    }

    public static function getSlug(): string
    {
        return 'rkakl';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('komponen_id')
                    ->label('Komponen')
                    ->options(Komponen::pluck('komponen', 'id')->toArray()) // Pastikan data selalu array
                    ->live()
                    ->required(),

                Select::make('sub_komponen_id')
                    ->label('Sub Komponen')
                    ->options(
                        fn(Get $get) =>
                        $get('komponen_id')
                            ? SubKomponen::where('komponen_id', $get('komponen_id'))->pluck('sub_komponen', 'id')->toArray()
                            : []
                    )
                    ->live()
                    ->reactive()
                    ->required()
                    ->disabled(fn(Get $get) => !$get('komponen_id')),

                Select::make('detil_id')
                    ->label('Detil')
                    ->options(
                        fn(Get $get) =>
                        $get('sub_komponen_id')
                            ? Detil::where('sub_komponen_id', $get('sub_komponen_id'))->pluck('detil', 'id')->toArray()
                            : []
                    )
                    ->live()
                    ->reactive()
                    ->required()
                    ->disabled(fn(Get $get) => !$get('sub_komponen_id')),

                Select::make('sub_detil_id')
                    ->label('Sub Detil')
                    ->options(
                        fn(Get $get) =>
                        $get('detil_id')
                            ? SubDetil::where('detil_id', $get('detil_id'))->pluck('sub_detil', 'id')->toArray()
                            : []
                    )
                    ->reactive()
                    ->required()
                    ->disabled(fn(Get $get) => !$get('detil_id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function (Builder $query) {
                // Mengambil komponen beserta relasi ke sub-komponen dan detil
                return $query->with('komponen.subKomponens.detils'); // Pastikan relasi sudah dimuat
            })
            ->columns([
                // Kolom pertama untuk menampilkan kode (ID atau kode unik) Komponen, Sub-Komponen, dan Detil
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->getStateUsing(function ($record) {
                        $output = '';

                        // Menampilkan Kode Komponen
                        $output .= $record->komponen->id . "\n";

                        // Menampilkan Kode Sub-Komponen
                        foreach ($record->komponen->subKomponens as $subKomponen) {
                            $output .= '  ' . $subKomponen->id . "\n";

                            // Menampilkan Kode Detil
                            foreach ($subKomponen->detils as $detil) {
                                $output .= '    ' . $detil->id . "\n";
                            }
                        }
                        return $output;
                    })
                    ->sortable()
                    ->searchable()
                    ->wrap(), // Membungkus teks jika terlalu panjang

                // Kolom kedua untuk menampilkan Nama Komponen, Sub-Komponen, dan Detil
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->getStateUsing(function ($record) {
                        $output = '';

                        // Menampilkan Nama Komponen
                        $output .= $record->komponen->nama_komponen . "\n";

                        // Menampilkan Nama Sub-Komponen
                        foreach ($record->komponen->subKomponens as $subKomponen) {
                            $output .= '  ' . $subKomponen->nama_sub_komponen . "\n";

                            // Menampilkan Nama Detil
                            foreach ($subKomponen->detils as $detil) {
                                $output .= '    ' . $detil->nama_detil . "\n";
                            }
                        }

                        return $output;
                    })
                    ->sortable()
                    ->searchable()
                    ->wrap(), // Membungkus teks jika terlalu panjang

                // Kolom ketiga untuk menampilkan Qty, Harga Satuan, dan Jumlah hanya untuk Detil
                // Kolom pertama untuk Qty
                Tables\Columns\TextColumn::make('qty')
                    ->label('Qty')
                    ->getStateUsing(function ($record) {
                        $output = '';

                        // Menampilkan Qty untuk Detil
                        foreach ($record->komponen->subKomponens as $subKomponen) {
                            foreach ($subKomponen->detils as $detil) {
                                $output .= $detil->qty . "\n"; // Menampilkan qty
                            }
                        }

                        return $output;
                    })
                    ->sortable()
                    ->searchable()
                    ->wrap(),

                // Kolom kedua untuk Harga Satuan
                Tables\Columns\TextColumn::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->getStateUsing(function ($record) {
                        $output = '';

                        // Menampilkan Harga Satuan untuk Detil
                        foreach ($record->komponen->subKomponens as $subKomponen) {
                            foreach ($subKomponen->detils as $detil) {
                                $output .= $detil->harga_satuan . "\n"; // Menampilkan harga satuan
                            }
                        }

                        return $output;
                    })
                    ->sortable()
                    ->searchable()
                    ->wrap(),

                // Kolom ketiga untuk Jumlah
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->getStateUsing(function ($record) {
                        $output = '';

                        // Menampilkan Jumlah untuk Detil
                        foreach ($record->komponen->subKomponens as $subKomponen) {
                            foreach ($subKomponen->detils as $detil) {
                                $output .= $detil->jumlah . "\n"; // Menampilkan jumlah
                            }
                        }

                        return $output;
                    })
                    ->sortable()
                    ->searchable()
                    ->wrap(),
            ])
            ->filters([
                // Filter tambahan jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
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
            'index' => Pages\ListRKAKLS::route('/'),
            'create' => Pages\CreateRKAKL::route('/create'),
            'edit' => Pages\EditRKAKL::route('/{record}/edit'),
        ];
    }
}
