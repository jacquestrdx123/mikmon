<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\Location;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class LocationDevicesDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;

    public function builder()
    {
        return Device::query()->where('devices.location_id',$this->params);
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->linkTo('device'),

            Column::name('description')
                ->label('Description')
                ->searchable(),
            Column::name('ip')
                ->label('IP')
                ->editable()
                ->searchable(),

            Column::name('Model')
                ->searchable(),

            Column::callback(['current_status'], function ($current_status) {
                return view('table-devices-status', ['current_status' => $current_status]);
            })
                ->Label('Status'),

            DateColumn::name('created_at')
                ->label('Added'),
            Column::delete()->label('delete')->alignRight()
        ];
    }
}
