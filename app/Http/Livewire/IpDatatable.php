<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\Deviceinterface;
use App\Models\Ip;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class IpDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;

    public function builder()
    {
        return Ip::query()->where('device_id',$this->params);
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('address')
                ->label('Address')
                ->searchable(),
            Column::name('network')
                ->label('Network')
                ->searchable(),
            Column::name('interface')
                ->label('Interfaace')
                ->searchable(),
            Column::name('disabled')
                ->label('Disabled'),
            Column::name('dynamic')
                ->label('Dynamic'),

        ];
    }
}
