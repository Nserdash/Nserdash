@extends('layouts.app')
@section('title', 'Мессенджер')
@section('content')

<div class="py-12">
   <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 mb-4 flex flex-col">           
        @foreach($datarooms as $room)
        @if ($room->room_id != NULL)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 cursor-pointer  hover:bg-indigo-100 transition duration-150 ease-in-out">                                               
                <a href =  "{{ route('room', [$room->counter_id, $room->name, $room->room_id, 'img']) }}">
                    <div class = "flex flex-row p-4 justify-between items-center">
                        <div class = "flex flex-row">
                            @if($room->img == NULL) 
                            <div class = "rounded-full h-14 w-14 p-2 mr-2 border-2 border-indigo-400"></div>
                            @else
                            <img src = "storage/images/{{$room->img}}" class = "rounded-full h-14 w-14 mr-2 border-2 border-indigo-400 bg-indigo-400">        
                            @endif
                            <div class = "flex flex-col">
                            <b class = " text-indigo-400">{{ $room->name}}</b>                         
                                <p class = "@if($room->user_id == Auth::id()) text-gray-400 @endif"> @if($room->user_id == Auth::id()) Я: @endif {{ $room->message }}</p>
                            
                            </div>
                        </div>
                        <!--<div class = "bg-indigo-400 rounded-full h-6 w-6 text-center text-white">
                        1
                        </div>-->
                    </div>                
                </a>            
            </div>
            @endif                                
        @endforeach

        <div class = "fixed bottom-4 self-end bg-white border-2 border-indigo-400 rounded-full cursor-pointer" onclick = "showpop('#write')">
            <img src = "images/write.png" class = "p-4 ajax">
        </div>

        <div class = "absolute flex wax-w-5xl flex-col shadow-sm sm:rounded-lg overflow-auto overflow-y-scroll invisible opacity-0 ajax" id = "write">
        <div class = "absolute right-2 top-0 cursor-pointer" onclick = "hidepop('#write')">х</div>
            @foreach($datarooms as $user)      
                @if($user->name != Auth::user()->name)
                <div class="bg-white overflow-hidden text-indigo-400">
                
                    <div class="py-4 px-2 bg-white flex justify-between">

                        <div class = "flex flex-row items-center">
                            @if($user->img == NULL) 
                            <div class = "rounded-full h-9 w-9 p-2 mr-2 border-2 border-indigo-400"></div>
                            @else
                            <img src = "storage/images/{{$user->img}}" class = "rounded-full h-9 w-9 mr-2 border-2 border-indigo-400 bg-indigo-400">        
                                @endif
                            <div class = "flex flex-col">
                                <a href = "{{ route('profile', [$user->counter_id, $user->name]) }}" class = "flex flex-row"><h1>{{ $user->name }}</h1></a>                                
                            </div>
                        </div>

                        <div class = "hidden">
                        @if($user->img==NULL)
                            {{ $img = 'none' }}
                        @else
                            {{ $img = $user->img }} 
                        @endif
                        </div>
                    
                        <a href =  "{{ route('room', [$user->counter_id, $user->name, $user->room_id, $img]) }}">
                            Написать
                        </a>                
                    </div>
                </div>
                @endif
            @endforeach
        </div>

    </div>
</div>
@endsection