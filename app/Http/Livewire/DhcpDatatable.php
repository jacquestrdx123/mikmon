<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\Deviceinterface;
use App\Models\Dhcplease;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class DhcpDatatable extends LivewireDatatable
{

    public $hideable = 'inline';
    public $exportable = true;



    public function builder()
    {
        return Dhcplease::query()->where('device_id',$this->params);
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
            ->linkTo('device'),
            Column::name('mac_address')
                ->label('MAC')
                ->searchable(),
            Column::name('address')
                ->label('IP Address')
                ->searchable(),
            Column::name('client_id')
                ->label('Client ID')
                ->searchable(),
            Column::name('expires_after')
                ->label('Expires in')
                ->searchable(),
            Column::name('status')
                ->label('Status')
                ->searchable(),
            Column::name('host_name')
                ->label('Host Name')
                ->searchable(),
            Column::name('dynamic')
                ->label('Dynamic')
                ->searchable(),
        ];
    }
}
