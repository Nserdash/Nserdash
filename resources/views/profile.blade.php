@extends('layouts.app')
@foreach($dataprofile as $el)

    @section('title', $el->name)

    @section('content')
    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 flex flex-row">
            <div class="w-8/12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 pt-2 bg-white border-b border-gray-200">   
                    
                        <div class = "flex flex-row h-80">
                                <div class = "border h-80 w-80 mr-8 rounded-sm relative">
                                @if(Auth::id()==$el->id)
                                <div class = "absolute top-2 left-2 border-2 border-indigo-400 p-2 bg-white rounded-full cursor-pointer">
                                    <label for="photo" onclick = "showpop('#ava')"><img src = "/images/write.png" class = "cursor-pointer"></img></label>
                                </div>
                                    <form action = "{{ route('ava.red') }}" method = "post"  enctype="multipart/form-data" class = "invisible absolute flex" id = "ava">
                                    @csrf
                                        <input type = "file" name = "img" id = "photo" class = "hidden">
                                        
                                        <input type = "submit" value = "Готово" class = "text-indigo-400 bg-transparent cursor-pointer pt-12 pl-2">
                                    </form>
                                @endif

                                @if($el->img != NULL) 
                                <img src = "/storage/images/{{$el->img}}" class = "h-full w-full mr-8 rounded-sm">        
                                @endif
                                </div>
                                <div class = "flex flex-col w-96">
                                    <div class = "flex flex-col justify-between">
                                        <h1 class = "font-semibold text-xl text-gray-800 leading-tight pb-2">{{ $el->name }}</h1>
                                            <form action = "{{ route('profile.red') }}" method = "post" class = "flex flex-col justify-between items-between border-t border-b h-72 py-2">   
                                            @csrf                                                                                    
                                            <input type = "submit" value = "Готово" class = "bg-white text-indigo-400 text-left text-sm cursor-pointer hidden">
                                            @if($el->id == Auth::id())<p class = "bg-white text-indigo-400 text-left text-sm cursor-pointer" onclick = "red(this)">Редактировать</p>@endif
                                            <input value = "{{ Auth::id() }}" class = "hidden" name = "id">
                                            <div class = "text-gray-400 flex flex-row justify-between"><div><small>Пол:</small></div><input autocomplete="off" class ="px-4 w-36 text-right text-indigo-400 bg-white outline-none" name = "sex" value = "{{ $el->sex }}" disabled></div>
                                            <div class = "text-gray-400 flex flex-row justify-between"><small>Ориентация:</small><input autocomplete="off" class ="px-4 w-36 text-right text-indigo-400 bg-white outline-none" name = "orientation" value = "{{ $el->orientation }}" disabled></div>                                                
                                            <div class = "text-gray-400 flex flex-row justify-between"><small>Политические взгляды:</small><input autocomplete="off" class ="px-4 w-36 text-right text-indigo-400 bg-white outline-none" name = "politic" value = "{{ $el->politic }}" disabled></div>                                                
                                            <div class = "text-gray-400 flex flex-row justify-between"><small>Любовь к экспериментам:</small><input autocomplete="off" class ="px-4  w-36 text-right text-indigo-400 bg-white outline-none" name = "experiment" value = "{{ $el->experiment }}" disabled></div>                                                
                                            <div class = "text-gray-400 flex flex-row justify-between"><small>Почта:</small><small class ="px-4 text-indigo-400">{{ $el->email }}</small></div>                                                                                            

                                            </form>
                                    </div>    
                                    
                                </div>    
                                
                        </div>
                        <div class = "flex flex-row justify-between pt-6 pb-2">                            
                            <img src = "/images/add.png">
                            <img src = "/images/send.png">                            
                        </div>
                    </div>
                </div>
            </div>
            <div class = "w-4/12 ml-6">
                <div class="p-4 bg-white flex flex-col justify-between h-full">      
                    <h2 class = "text-gray-800 leading-tight pb-1">О себе:</h2>
                    <form action = "{{ route('desc.red') }}" method = "post">                            
                        <div class = "border-b border-t h-72 flex flex-col py-2">  
                        @csrf                                        
                        <input type = "submit" value = "Готово" class = "bg-white text-indigo-400 text-left text-sm cursor-pointer hidden done ">
                        @if($el->id == Auth::id())<p class = "bg-white text-indigo-400 text-left text-sm cursor-pointer" onclick = "red(this)">Редактировать</p>@endif
                            <p class = "flex flex-col items-center justify-center h-60">
                                <input value = "{{ Auth::id() }}" class = "hidden" name = "id" disabled>
                                <textarea name = "desc" name="text" class = "h-full w-full border-0 p-0 bg-white" disabled>{{ $el->description }}</textarea>                                                                        
                            </p>
                        </div>

                        <div class = "pt-6 pb-2 flex flex-row">
                            <img src = "/images/instagram.png" class = "pr-4">
                            @if($el->link != "-")                                
                            <a href = "{{ $el->link }}" class = "text-indigo-400"><input name = "link" value = "{{ $el->link }}"></a>
                            @else
                            <input name = "link" value = "{{ $el->link }}" disabled>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="p-0">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 py-6 bg-white border-b border-gray-200">                    
                    <div class = "flex flex-row justify-between">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
    
@endforeach