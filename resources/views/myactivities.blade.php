<x-app-layout>

    <x-slot name="header">
    My Activities - User name: {{$username}}
    </x-slot>
    @auth

        @if ($filterName != '')
            <p>Searching for : {{$filterName}}</p>
        @else
            <input type="text" id="filterName" placeholder="type here...">
        @endif

        <div style="background-color:grey; padding: 5px; ">
            @foreach ($activities as $item)
                <div style="background-color: {{ $loop->odd ? 'silver' : 'white' }}; margin: 10px; " >{{ $item->id . ' - '. $item->name }}</div>
            @endforeach
        </div>

    @endauth

    <strong>Items : {{$count}} </strong>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


</x-app-layout>
