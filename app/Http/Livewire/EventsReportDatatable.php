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
        return Device::query()->leftJoin('locations', 'locations.id', 'devices.location_id')->withCount('events')->where('events.created_at','>',$this->week);
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
            ->linkTo('device'),
            Column::name('devices.description')
                ->label('Description')
                ->searchable(),
            Column::name('ip')
                ->label('IP')
                ->editable()
                ->searchable(),
            Column::make('Events', 'events_count')->sortable(),
        ];
    }
}
