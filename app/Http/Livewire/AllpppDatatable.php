<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\Deviceinterface;
use App\Models\Dhcplease;
use App\Models\Neighbor;
use App\Models\Pppconnection;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class AllpppDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;

    public function builder()
    {
        return Pppconnection::query()
            ->leftJoin('devices', 'devices.id', '=','pppconnections.device_id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')->searchable(),
            Column::name('devices.description')->label('WAP Name')->searchable(),
            Column::name('devices.ip')->label('WAP IP')->searchable(),
            Column::name('name')->label('Name')->searchable(),
            Column::name('caller-id')->label('Mac Address')->searchable(),
            Column::name('radius')->label('Radius')->searchable(),
            Column::name('address')->label('Address')->searchable(),
            Column::delete()->label('delete')->alignRight()
        ];
    }
}
