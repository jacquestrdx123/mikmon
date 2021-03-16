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

class LocationDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;

    public function builder()
    {
        return Location::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
            ->linkTo('location'),

            Column::name('description')
                ->label('Description')
                ->searchable()
                ->editable(),

            Column::name('longitude')
                ->label('Long')
                ->searchable()
                ->editable(),


            Column::name('latitude')
                ->label('latitude')
                ->searchable()
                ->editable(),


            Column::callback(['status'], function ($current_status) {
                return view('table-locations-status', ['current_status' => $current_status]);
            })
                ->Label('Status'),

            DateColumn::name('created_at')
                ->format('jS F H:m')
                ->label('Added')
        ];
    }
}
