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

class PppDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;



    public function builder()
    {
        return Pppconnection::query()->where('device_id',$this->params);
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('name')->label('Name'),
            Column::name('caller-id')->label('Mac Address'),
            Column::name('radius')->label('Radius'),
            Column::name('address')->label('Address'),
        ];
    }
}
