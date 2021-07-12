<?php

namespace App\Http\Livewire;

use App\Models\Device;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class EventsReportDatatable extends LivewireDatatable
{
    public $model = Device::class;
    public $hideable = 'inline';
    public $exportable = true;
    public $sort_attribute = 'events_count';
    public $week;

    public function builder()
    {
        return Events::query()->leftJoin('devices', 'devices.id', 'events.device_id')
            ->groupBy('devices.id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('devices.id')
                ->label('ID')
            ->linkTo('device'),
            Column::name('devices.description')
                ->label('Description')
                ->searchable(),
            Column::name('devices.ip')
                ->label('IP')
                ->editable()
                ->searchable(),
        ];
    }
}
