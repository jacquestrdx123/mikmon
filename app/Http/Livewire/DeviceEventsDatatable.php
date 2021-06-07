<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\Deviceinterface;
use App\Models\Event;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class DeviceEventsDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;



    public function builder()
    {
        return Device::query()
            ->rightJoin('events', 'devices.id', 'events.device_id')
            ->groupBy('devices.id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->linkTo('device/'),
            Column::callback(['name'], function ($name) {
                $name = preg_replace('/\</','',$name);
                $name = preg_replace('/\>/','',$name);
                return $name;
                })->label('Description'),
            Column::name('ip')
                ->label('IP Address')
                ->searchable(),
            NumberColumn::name('events')
                ->label('Events Last 30 days'),

        ];
    }
}
