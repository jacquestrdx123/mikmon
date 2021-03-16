<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\Deviceinterface;
use App\Models\Dhcplease;
use App\Models\Event;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class EventsDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;



    public function builder()
    {
        return Event::query()->where('type','device')->where('remote_id',$this->params);
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            DateColumn::name('created_at')
                ->label('Timestamp'),
            Column::callback(['events.previous_status', 'events.current_status'], function ($previous_status, $current_status) {
                return view('table-events-status', ['previous_status' => $previous_status, 'current_status' => $current_status]);
            })
                ->Label('State Change')

        ];
    }
}
