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
            ->leftJoin('events','devices.id','events.device_id')
            ->where('events.created_at','>=',date('Y-m-d'))
            ->groupBy('devices.id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->linkTo('device/'),
            Column::callback(['description'], function ($name) {
                $name = preg_replace('/\</','',$name);
                $name = preg_replace('/\>/','',$name);
                return $name;
                })->label('Description'),
            Column::name('ip')
                ->label('IP Address')
                ->searchable(),
            NumberColumn::name('events.id:count')
                ->label('Event Count'),

        ];
    }
}
