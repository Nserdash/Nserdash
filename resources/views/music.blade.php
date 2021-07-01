@extends('layouts.app')
@section('title', 'Музыка')
@section('content')


<!--ПОИСК-->
<div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-2 bg-white border-b border-gray-200 flex flex-row justify-between">
                    <div class = "w-full flex flex-row">
                        
                        <form action = "" method = "get" class = "w-full">
                        @csrf
                        <input name = "search" class = "p-2 border w-10/12" placeholder = "Поиск по названию" value = "{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                        <input type = "submit" class = "p-2 text-indigo-400 bg-transparent" value = "Поиск" style = "width:16%">
                        </form>

                    </div>    
                </div>
            </div>
        </div>
</div>
<!--КОНЕЦ ПОИСК-->

<!--МУЗЫКА-->
<div class="pb-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 relative">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class = "flex flex-row justify-end pr-4 pt-2 relative" onclick = "showtools(this)">
                    <div class = "absolute right-2 top-6 bg-white p-2 border shadow-sm sm:rounded-lg hidden targetclose">
                        <div class = "text-indigo-400 hover:text-indigo-800 transition duration-150 ease-in-out cursor-pointer" onclick = "showpop('#addmusic')">Добавить аудио +</div>
                    </div>

                    <div class = "tagretopen">
                        <svg class="fill-current h-4 w-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
<!--ФОРМА ДОБАВЛЕНИЯ-->
                <div class = "absolute w-96 right-96 top-56 bg-white border p-4 z-10 shadow-lg sm:rounded-lg invisible opacity-0 tagretopen" id = "addmusic">
                    <div class = "absolute right-2 top-0 cursor-pointer" onclick = "hidepop('#addmusic')">х</div>
                    <form action = "{{ route('post.audio') }}" method = "post" class = "relative w-full py-4" enctype="multipart/form-data">
                        @csrf
                        <input type = "file" name = "url" class = "hidden" accept="audio/mp3" id = "url">                           
                        <input type = "file" name = "img" class = "hidden" accept="image/jpeg,image/png,image/gif" id = "img">                           
                        <input name = "user" class = "hidden" value = "{{ Auth::id() }}">                           
                        <div class = "flex flex-row">
                            <label for="img" class = "flex flex-row justify-between w-24 mr-4 cursor-pointer border p-2">Фото <img src = "images/ex.png"></label>
                            <label for="url" class = "flex flex-row justify-between w-24 mr-4 cursor-pointer border p-2">Аудио<img src = "images/ex.png"></label>                                
                            <select name="cat" class = "border-gray-200 w-36"><option value = "">Категория</option>@foreach($datacat as $el)<option value = "{{ $el->id }}">{{ $el->name }}<option>@endforeach</select>
                        </div>
                        <input name = "name"  autocomplete="off" class = "border w-10/12 outline-none p-2" placeholder = "Название">
                        <input type = "submit" class = "p-4 w-1/12 text-indigo-400 bg-transparent outline-none text-xl font-bold cursor-pointer" value = "+" >
                    </form>
                </div>

<!--КОНЕЦ ФОРМА ДОБАВЛЕНИЯ-->
                <div class="p-4 bg-white border-b border-gray-200 flex flex-row justify-between">
                    <div class = "flex flex-col w-10/12 overflow-auto overflow-y-scroll" style = "height:70vh;">

                        @if(!isset ($cat))

                            @foreach($data as $el)                            
                            @if(isset($_GET['search']) && $_GET['search'] == $el->name)

                                <div class = "d-flex flex-column pb-8">

                                    <div class = "flex flex-row">

                                        <div class ="flex items-center">
                                        <img src = "\storage\images\{{ $el->img }}" class = "w-12 h-12 rounded"> </img>
                                        </div>

                                        <div class = "flex flex-col w-full">

                                            <p class = "text-sm font-medium pl-5 pb-2">{{ $el->username }} {{ $el->name }}</p>
                                            <audio src = "\audio\{{ $el->url }}" controls class = "w-full"></audio>

                                        </div>

                                    </div>

                                </div>
                            @elseif(!isset($_GET['search']) || $_GET['search'] =="")

                                <div class = "d-flex flex-column pb-8">

                                    <div class = "flex flex-col">
                                        <div class = "flex flex-row">
                                            <div class ="flex items-center">
                                            <img src = "\storage\images\{{ $el->img }}" class = "w-12 h-12 rounded"> </img>
                                            </div>

                                            <div class = "flex flex-col w-full">

                                            <div class = "flex flex-row">
                                                <a href = "{{ route('profile', [$el->user_id, $el->username]) }}"><p class = "text-sm font-medium text-indigo-400 pl-5 pb-2">{{ $el->username }} </p></a>
                                                <p class = "text-sm font-medium pl-1 pb-2">- {{ $el->trackname }}</p>
                                            </div>

                                            <audio src = "\audio\{{ $el->url }}" controls class = "w-full"></audio>

                                            </div>
                                        </div>

                                        <div class = "flex flex-col pt-2">                   
                                            <p class = "text-gray-400"><small>{{ $el->created_at }}</small></p>
                                            <div class = "flex flex-row justify-between">
                                                <div class = "flex py-2"><a href = "{{ route('likes', [$el->id, Auth::id()]) }}"><img src = "@if($el->IsLikedByCurrentUser == 1) images/liked.png @else images/like.png @endif" class = "pr-2 cursor-pointer" onclick = "like(this)"></a>{{ $el->ml_count }}</div>
                                                <div class = "flex py-2 px-6">{{ $el->mc_count }}<img src = "images/comments.png" class = "pl-2 cursor-pointer transition duration-150 ease-in-out" onclick = "showcomments(this)"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class ="bg-gray-50 border-t border-gray-200 hidden">
                                        <div class = "pl-2">                                            
                                            @foreach($datacomment as $elm)
                                                @if($el->id == $elm->post_id)                                                
                                                <div class ="border-b flex flex-row justify-between">
                                                    <div class = "flex flex-col py-2">
                                                        <small class = "text-indigo-400 @if($elm->name == Auth::user()->name) font-bold text-indigo-600 @endif ">{{ $elm->name }}:</small>                 
                                                        <span>{{ $elm->comment }}</span>
                                                        <small class = "text-gray-400">{{ $elm->commenttime }}</small>
                                                    </div>
                                                    @if($elm->idusercomment == Auth::id() || $el->name == Auth::user()->name)
                                                    <div class = "flex self-end">
                                                        <a href = "{{ route('comment.delete',$elm->idcomment) }}" class = "p-2"><img class = "filter grayscale" src = "images/delete.png"></a>
                                                    </div>
                                                    @endif
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>                    
                                            
                                        <div class = "pl-2">
                                            <form action = "{{ route('comment.news') }}" class ="flex flex-row" method = "post">
                                            @csrf
                                                <div class = "w-10/12">
                                                    <input name = "post_id" class = "hidden" value = "{{ $el->id }}">
                                                    <input name = "idusr" class = "hidden" value = "{{ Auth::id() }}">
                                                    <input name = "type" class = "hidden" value = "music">
                                                    <input name = "comment"  placeholder  = "Оставьте комментарий" class = "h-12 outline-none bg-gray-50">
                                                </div>
                                                <div class = "w-2/12 text-center flex flex-col justify-center items-end pr-2">
                                                    <input type = "image" src = "images/send.png" width = "24" class = "outline-none">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>



                            @endif
                            
                            @endforeach

                            @else

                            @foreach($cat as $el)

                                <div class = "d-flex flex-column pb-6">

                                    <div class = "flex flex-row">

                                        <img src = "\storage\images\{{ $el->img }}" class = "w-12 rounded"> </img>

                                        <div class = "flex flex-col w-full">

                                            <p class = "text-sm font-medium pl-5">{{ $el->name }}</p>
                                            <audio src = "\audio\{{ $el->url }}" controls class = "w-full"></audio>

                                        </div>

                                    </div>

                                </div>
                                
                            @endforeach

                        @endif              
                        
                    </div>
<!--КОНЕЦМУЗЫКА-->

<!--КАТЕГОРИИ-->
                    <ul class="flex flex-col items-start border-l border-gray-200 pl-6 w-2/12">
                    
                        <a href = "{{ route('music') }}"  class = "@if(last(request()->segments()) == 'Музыка') border-b-2 border-indigo-400 @endif text-sm font-medium leading-5 text-gray-900 mb-4"><li class = "">Все</li></a>

                        @foreach($datacat as $el)
                            <a href = "{{ route('music.cat',[$el->id, $el->name]) }}" class = "@if(last(request()->segments()) == $el-> id)border-b-2 border-indigo-400 @endif text-sm font-medium leading-5 text-gray-500 mb-4"><li class = ""> {{ $el-> name }} </li></a> 
                        @endforeach
                    
                    </ul>
<!--КОНЕЦКАТЕГОРИИ-->                    
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection
