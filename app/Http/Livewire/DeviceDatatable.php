<?php

namespace App\Http\Livewire;

use App\Models\Device;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class DeviceDatatable extends LivewireDatatable
{
    public $model = Device::class;
    public $hideable = 'inline';
    public $exportable = true;

    public function builder()
    {
        return Device::query()->leftJoin('locations', 'locations.id', 'devices.location_id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
            ->linkTo('device'),

            Column::name('description')
                ->label('Description')
                ->editable()
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

            Column::callback(['locations.id', 'locations.description'], function ($id, $description) {
                return view('table-locations-show', ['id' => $id, 'description' => $description]);
            })
                ->Label('Location'),

            DateColumn::name('created_at')
                ->label('Added'),
            Column::delete()->label('delete')->alignRight()
        ];
    }
}
