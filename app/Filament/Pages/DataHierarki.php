<?php

namespace App\Filament\Pages;

use App\Models\RO;
use App\Models\Detil;
use App\Models\Komponen;
use App\Models\SubDetil;
use Filament\Pages\Page;
use App\Models\SubKomponen;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class DataHierarki extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.data-hierarki';
    
    protected static ?string $navigationLabel = 'Data Hierarki';

    protected static ?string $navigationGroup = 'Data Hierarki';

    protected static ?string $slug = 'data-hierarki';

    public Collection $ros;

    public $expanded = [];

    public $modalOpen = false;
    public $modalType;
    public $parentId;
    public $modalName;
    public $modalKode;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->ros = Ro::with([
            'komponens.subKomponens.detils.subDetils'
        ])->get();
    }

    public function toggleExpand($type, $id)
    {
        $this->expanded[$type][$id] = !($this->expanded[$type][$id] ?? false);
    }

    public function openModal($parentId, $type)
    {
        $this->modalOpen = true;
        $this->modalType = $type;
        $this->parentId = $parentId;
        $this->modalName = '';
        $this->modalKode = '';
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function saveData()
    {
        $newData = null;

        switch ($this->modalType) {
            case 'ro':
                $newData = Ro::create([
                    'kode' => $this->modalKode,
                    'ro' => $this->modalName
                ]);
                break;

            case 'komponen':
                $newData = Komponen::create([
                    'kode' => $this->modalKode,
                    'komponen' => $this->modalName,
                    'ro_id' => $this->parentId
                ]);
                break;

            case 'subKomponen':
                $newData = SubKomponen::create([
                    'kode' => $this->modalKode,
                    'sub_komponen' => $this->modalName,
                    'komponen_id' => $this->parentId
                ]);
                break;

            case 'detil':
                $newData = Detil::create([
                    'kode' => $this->modalKode,
                    'detil' => $this->modalName,
                    'sub_komponen_id' => $this->parentId
                ]);
                break;

            case 'subDetil':
                $newData = SubDetil::create([
                    'kode' => $this->modalKode ?: null, // Sub Detil boleh tanpa kode
                    'sub_detil' => $this->modalName,
                    'detil_id' => $this->parentId
                ]);
                break;
        }

        if ($newData) {
            $this->loadData();
        }

        $this->closeModal();
    }
    
}
