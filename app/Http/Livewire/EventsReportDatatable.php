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
        $this->week = new DateTime();
        $this->week->format('Y-m-d');
        return Device::query();
    }

    public function columns()
    {
        return [
            Column::callback(['id'], function ($id) {
                return view('table-devices-show', ['id' => $id]);
            }),
            Column::name('devices.description')
                ->label('Description')
                ->editable(),
            Column::name('ip')
                ->label('IP')
                ->editable()
                ->searchable(),
            NumberColumn::name('events.id:count')
                ->label('Event Count')
                ->filterable()
                ->alignRight(),        ];
    }
}
