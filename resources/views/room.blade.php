@extends('layouts.app')
@section('title', 'Новости')
@section('content')

<div class="py-4 overflow-auto overflow-y-scroll scroll">    
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        @foreach($dataroom as $room)
        <div class = "flex flex-col">        
        @if($room->name != Auth::user()->name)
        <div class="max-w-xl mb-4 w-auto p-3 bg-white overflow-hidden shadow rounded-tr-2xl rounded-b-md self-start">        
        <p>{{ $room->message }}</p>
        </div>
        @else
        <div class="mb-4 max-w-xl bg-white overflow-hidden shadow rounded-tl-2xl rounded-b-md p-3 self-end">        
        <p >{{ $room->message }}</p>
        </div>      
        @endif
        </div>      
        @endforeach
    </div>
</div>

<div class="fixed w-full bottom-0 pb-4 bg-gray-100">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border">
            <div class="p-2 bg-white border-b border-gray-200">

                <div class = "w-full flex flex-row">
                    
                    <div class = "w-1/12 flex self-center mx-auto justify-center">
                    <label for="photo"><img src = "/images/paper-clip.png" class = "cursor-pointer"></img></label>
                    </div>

                    <form action = "{{ route('send.message') }}" method = "post" class = "w-full" enctype="multipart/form-data">
                    @csrf
                    <!--<input type = "file" name = "img" class = "hidden" id = "photo">-->
                    <input name = "user_id" class = "hidden" value = "{{ Auth::id() }}">                            
                    <input name = "user_to_id" class = "hidden" value = "{{ $id }}">                            
                    <input name = "message"  autocomplete="off" class = "p-4 border outline-none" placeholder = "Отправить сообщение" style = "width:82%">
                    <input type = "submit" class = "p-4 w-2/12 text-indigo-400 bg-transparent outline-none" value = "Отправить" >
                    </form>

                </div>    


            </div>
        </div>
    </div>
</div>

@endsection