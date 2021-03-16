<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\Deviceinterface;
use App\Models\Dhcplease;
use App\Models\Neighbor;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class NeighborsDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;



    public function builder()
    {
        return Neighbor::query()->where('device_id',$this->params);
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('interface')->label('Interface'),
            Column::name('mac_address')->label('Mac Address'),
            Column::name('address')->label('Address'),
            Column::name('address4')->label('Address4'),
            Column::name('identity')->label('Identity'),
            Column::name('platform')->label('Platform'),
            Column::name('version')->label('Version'),
            Column::name('uptime')->label('Uptime'),
            Column::name('board')->label('Board')
        ];
    }
}
