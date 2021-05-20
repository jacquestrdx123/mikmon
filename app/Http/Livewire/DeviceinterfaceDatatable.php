<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\Deviceinterface;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class DeviceinterfaceDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;



    public function builder()
    {
        return Deviceinterface::query()->where('device_id',$this->params);

    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
            ->linkTo('deviceinterface/graph'),
            Column::callback(['name'], function ($name) {
                $name = preg_replace('/\</','',$name);
                $name = preg_replace('/\>/','',$name);
                return $name;
                }),
            Column::name('type')
                ->label('Type')
                ->searchable()
                ->filterable(),
            Column::name('txspeed')
                ->label('TX Speed'),
            Column::name('rxspeed')
                ->label('RX Speed'),
            Column::callback(['link_speed'], function ($link_speed) {
                if($link_speed == 0){
                    return "Not Running";
                }else{
                    return $link_speed / 1000000 ." Mbps";
                }
            })->Label('Status'),
            Column::name('threshhold')
                ->label('Threshold')
                ->editable(),

        ];
    }
}
