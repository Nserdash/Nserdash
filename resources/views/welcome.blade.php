@extends('layouts.app')
@section('title', 'Новости')
@section('content')

<div class="py-4 overflow-auto overflow-y-scroll scroll">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 flex flex-row">

        <div class ="flex flex-col w-7/12">
            @foreach($data as $el)

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col mb-4">
                        <div class = "flex flex-row justify-between p-2 relative" onclick = "showtools(this)">
                                    <a href = "{{ route('profile',[$el->user_id,$el->name]) }}" class = "">
                                    <div class = "flex flex-row items-center">
                                            @if($el->avatar == NULL)
                                                <div class = "rounded-full h-8 w-8 p-2 mr-2 border-2 border-indigo-400"></div>
                                            @else
                                                <img src = "storage/images/{{ $el->avatar }}" class = "rounded-full h-8 w-8 mr-2 border-2 border-indigo-400">
                                            @endif
                                            <p class = "text-indigo-400 @if(Auth::id() == $el->iduser)  @endif hover:text-indigo-800 transition duration-150 ease-in-out">{{ $el->name }}</p>
                                        </div>
                                    </a>
                                @if(Auth::id() == $el->iduser)
                                <div class = "absolute right-2 top-6 bg-white p-2 border shadow-sm sm:rounded-lg hidden targetclose">
                                        <a href = "{{ route('news.delete',[$el->id]) }}" class = "text-red-400 hover:text-red-800 transition duration-150 ease-in-out cursor-pointer">Удалить</a>
                                </div>
                                
                                <div class = "tagretopen">
                                    <svg class="fill-current h-4 w-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @endif
                        </div>

                        <div class="bg-white flex flex-col">
                            <div class ="flex flex-col pl-2">                    
                                @if($el->img != NULL || "")<div class = "w-full"><img src = "/storage/images/{{ $el->img }}" class = "w-full object-cover" style = "max-height:75vh"></div> @endif
                                <h3>{{ $el->text }}</h3>     
                                <div class = "flex flex-col">                  
                                    <p class = "text-gray-400"><small>@if($el->date == Carbon\Carbon::now()->format('d.m.Y')) Сегодня в {{ $el->created_at }} @elseif(Carbon\Carbon::yesterday()->format('d.m.Y') == $el->date ) Вчера в {{ $el->created_at }} @else {{ $el->date }} {{ $el->created_at }} @endif</small></p>
                                    <div class = "flex flex-row justify-between py-2">
                                        <div class = "flex py-2"><a href = "{{ route('likes', [$el->id, Auth::id()]) }}"><img src = "@if($el->IsLikedByCurrentUser == 1) images/liked.png @else images/like.png @endif" class = "pr-2 cursor-pointer" onclick = "like(this)"></a>{{ $el->l_count }}</div>
                                        <div class = "flex py-2 px-4">{{ $el->n_count }}<img src = "images/comments.png" class = "pl-2 cursor-pointer transition duration-150 ease-in-out" onclick = "showcomments(this)"></div>
                                    </div>
                                </div>
                            </div>    
                            
                            <div class ="pt-2 bg-gray-50 border-t border-gray-200 hidden">
                                <div class = "pl-2">                        
                                    @foreach($datacomment as $elm)
                                        @if($el->id == $elm->post_id)
                                        <div class ="border-b flex flex-row justify-between">
                                            <div class = "flex flex-col py-2">
                                                <small class = "text-indigo-400 @if($elm->name == Auth::user()->name) font-bold text-indigo-600 @endif ">{{ $elm->name }}:</small>                 
                                                <span>{{ $elm->comment }}</span>
                                                <small class = "text-gray-400">{{ $elm->commenttime }}</small>
                                            </div>
                                            @if($elm->idusercomment == Auth::id() || $el->name ==Auth::user()->name)
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
                                            <input name = "type" class = "hidden" value = "news">
                                            <input name = "comment" autocomplete="off" placeholder  = "Оставьте комментарий" class = "h-12 outline-none bg-gray-50">
                                        </div>
                                        <div class = "w-2/12 text-center flex flex-col justify-center items-end pr-2">
                                            <input type = "image" src = "images/send.png" width = "24" class = "outline-none">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>        
                

            @endforeach
        </div>

        <div class="ml-6">
            <div class = "">
                <div class = "w-96 bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                    <div class = "flex flex-row justify-between p-2 cursor-pointer" onclick = "showtools(this)">
                            <div class = "">
                            <h2>Фанаты</h2>
                            </div>

                            <div class = "absolute right-2 top-6 bg-white p-2 border shadow-sm sm:rounded-lg hidden targetclose">
                                    <a href = "{{ route('users') }}" class = "">Всe участники</a>
                            </div>
                            
                            <div class = "tagretopen">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                    </div>

                    <div class = "flex flex-col overflow-auto overflow-y-scroll">
                        @foreach($datamusic as $user)      
                            @if($user->id != Auth::id())
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-indigo-400">
                            
                                <div class="py-4 px-2 bg-white flex justify-between">

                                <div class = "flex flex-row items-center">
                                    @if($user->img == NULL) 
                                    <div class = "rounded-full h-9 w-9 p-2 mr-2 border-2 border-indigo-400"></div>
                                    @else
                                    <img src = "storage/images/{{$user->img}}" class = "rounded-full h-9 w-9 mr-2 border-2 border-indigo-400 bg-indigo-400">        
                                     @endif
                                    <div class = "flex flex-col">
                                        <a href = "{{ route('profile', [$user->id, $user->name]) }}" class = "flex flex-row"><h1>{{ $user->name }}</h1></a>
                                        <p class = "text-gray-400"><small>{{ $user->email }}</small></p>
                                    </div>
                                </div>

                                <a href = "" class = "self-end text-indigo-400 hover:text-indigo-800 transition duration-150 ease-in-out">Написать</a> 

                            </div>
                            </div>
                            @endif
                        @endforeach
                        <div class = "fixed bottom-4 self-end bg-white border-2 border-indigo-400 rounded-full cursor-pointer" onclick = "showpop('#write')">
                            <img src = "images/send.png" class = "p-4 ajax">
                        </div>
                    </div>
                </div>
            </div>
        </div>            

</div>


<div class="fixed w-full bottom-0 pb-4 bg-gray-100 invisible opacity-0 ajax" id = "write">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border">
            <div class="p-2 bg-white border-b border-gray-200">

                <div class = "w-full flex flex-row">
                    
                    <div class = "w-1/12 flex self-center mx-auto justify-center">
                    <label for="photo"><img src = "/images/paper-clip.png" class = "cursor-pointer"></img></label>
                    </div>

                    <form action = "{{ route('send.news') }}" method = "post" class = "w-full" enctype="multipart/form-data">
                    @csrf
                    <input type = "file" name = "img" class = "hidden" id = "photo">
                    <input name = "user_id" class = "hidden" value = "{{ Auth::id() }}">                            
                    <input name = "text"  autocomplete="off" class = "p-4 border outline-none" placeholder = "Что у вас нового?" style = "width:82%">
                    <input type = "submit" class = "p-4 w-2/12 text-indigo-400 bg-transparent outline-none" value = "Отправить" >
                    </form>

                </div>    


            </div>
        </div>
    </div>
</div>

@endsection
