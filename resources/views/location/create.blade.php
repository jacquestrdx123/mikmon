<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Location') }}
    </x-slot>
    <div class="form">

        <form method="POST" action="{{ route('location.store') }}">
            @csrf

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="number" class="form-control" id="longitude" name="longitude" placeholder="Enter longitude">
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="number" class="form-control" id="latitude" name="latitude" placeholder="Enter latitude">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

</x-app-layout>
