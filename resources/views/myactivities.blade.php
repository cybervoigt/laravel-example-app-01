<x-app-layout>

    <x-slot name="header">
    My Activities - User name: {{$username}}
    </x-slot>
    @auth

        <ul>
            @foreach ($activities as $item)
            <li>{{ $item->name }}</li>
            @endforeach
        </ul>

    @endauth

    <strong>Items : {{$count}} - {{$filterName}}</strong>

</x-app-layout>
