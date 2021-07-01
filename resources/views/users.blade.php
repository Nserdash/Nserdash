@extends('layouts.app')
@section('title', 'Новости')
@section('content')

<div class="py-12">

    @foreach($datauser as $el)
    
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 mb-4">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg @if(Auth::id() == $el->id) text-indigo-400 @endif">
            
                <div class="p-4 bg-white flex justify-between">
                
                <div class = "flex flex-col">
                    <a href = "{{ route('profile', [$el->id, $el->name]) }}"><h1>{{ $el->name }}</h1></a>
                    <p class = "text-gray-400"><small>{{ $el->email }}</small></p>
                </div>

                @if($el->id != Auth::id())
                <div class = "flex flex-col">
                <a href = "" class = "self-end text-indigo-400 hover:text-indigo-800 transition duration-150 ease-in-out">Написать</a>
                <a href = "" class = "self-end text-indigo-400 hover:text-indigo-800 transition duration-150 ease-in-out">Подписаться</a>
                </div>
                 @endif

                </div>
            </div>
        </div>
    
    @endforeach

</div>
@endsection