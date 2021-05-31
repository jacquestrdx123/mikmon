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

class DeviceinterfaceAllDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;



    public function builder()
    {
        return Deviceinterface::query()
            ->rightJoin('devices', 'devices.id', 'deviceinterfaces.device_id')
            ->rightJoin('locations', 'devices.location_id', 'locations.id')
            ->where('deviceinterfaces.internet','1')
            ->orderBy('txspeed','DESC');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
            ->linkTo('deviceinterface/graph'),
            Column::callback(['locations.id', 'locations.description'], function ($id, $description) {
                return view('table-locations-show', ['id' => $id, 'description' => $description]);
            })
            ->Label('Device'),
            Column::callback(['name'], function ($name) {
                $name = preg_replace('/\</','',$name);
                $name = preg_replace('/\>/','',$name);
                return $name;
                })->label('Description'),
            Column::name('type')
                ->label('Type')
                ->searchable()
                ->filterable(),
            NumberColumn::name('txspeed')
                ->label('TX Speed'),
            NumberColumn::name('rxspeed')
                ->label('RX Speed'),
            NumberColumn::name('threshhold')
                ->label('Threshold')
                ->editable(),

        ];
    }
}
