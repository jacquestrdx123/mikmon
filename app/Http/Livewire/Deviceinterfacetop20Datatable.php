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

class Deviceinterfacetop20Datatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;



    public function builder()
    {
        return Deviceinterface::query()->orderBy('txspeed','DESC')->take('20');
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
            Column::name('threshhold')
                ->label('Threshold')
                ->editable(),

        ];
    }
}
