<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href = "/css/app.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script>

        /*function message(text) {
            jQuery('#chat-result').append(text);
        }

        jQuery(document).ready(function($) {

            var socket = new WebSocket("ws://localhost:8000/ChatController.php")

            socket.onopen = function() {
                message("<div>Соединение установлено</div>")
            }

            socket.onerror = function(error) {
                message("<div>Ошибка соединения" + (error.message ? error.message : "") + "</div>")
            }

            socket.onclose = function() {
                message("<div>Соединение закрыто</div>")
            }

            socket.onmessage = function(event) {
                var data = JSON.parse(event.data)
                message("<div>" + data.type + "-" + data.message + "</div>")
            }

        })*/

        function like(selector) {
            selector.getAttribute('src') == "/images/like.png" ?  selector.src = "/images/liked.png" : selector.src = "/images/like.png" 
        }

        function showtools(selector) {

            child = selector.querySelector('.hidden')
            if(child.style.display == "none" || child.style.display =="") {
                child.style.cssText = "display:block"
            } else {
                child.style.cssText = "display:none"
            }
        
        }

        function showcomments(selector) {
            
            var parent = selector.parentNode.parentNode.parentNode.parentNode.parentNode
            var child = parent.querySelector('.hidden')
            if(child.style.display == "none" || child.style.display =="") {
                child.style.cssText = "display:block"
                selector.style.transform = 'rotate(180deg)'
            } else {
                child.style.cssText = "display:none"
                selector.style.transform = ''
            }
            

        }

        function showpop(selector) {

            document.querySelector(selector).style.setProperty('visibility', 'visible');
            document.querySelector(selector).style.setProperty('opacity', '1');
            document.querySelector(selector).style.setProperty('transition', '0.3s');

        }

        function hidepop(selector) {

            document.querySelector(selector).style.setProperty('visibility', 'hidden');
            document.querySelector(selector).style.setProperty('opacity', '0');
            document.querySelector(selector).style.setProperty('transition', '0.3s');

        }

        $(document).click( function(event){
            if( $(event.target).closest(".ajax").length) 
            return;
            document.querySelector('#write').style.setProperty('visibility', 'hidden');
            document.querySelector('#write').style.setProperty('opacity', '0');
            document.querySelector('#write').style.setProperty('transition', '0.3s');
            event.stopPropagation();
        });


        $(document).click( function(event){            
            if( $(event.target).closest(".tagretopen").length) 
            return;
            var el = document.getElementsByClassName('targetclose')
            for(i=0;i<el.length;i++)
            el[i].style.setProperty('display', 'none');
            event.stopPropagation();
        });

        function red(selector) {
            
            var red = selector.parentNode.getElementsByTagName('input')
            var textred = selector.parentNode.getElementsByTagName('textarea')
            
            red[1].style.cssText = "display:block"       

            selector.style.cssText = "display:none"                        

            if(textred[0] != undefined) {
                textred[0].style.cssText = "border: 1px solid #ddd"   
                textred[0].disabled = false
            }
            

            for(i=2;i<red.length;i++) {
                red[i].style.cssText = "border: 1px solid #ddd"   
                red[i].disabled = false                
            }

        }
        
/*        $("document").ready(function(){
            $('input[type=file]').change(function() {
                alert('changed!');
            });
        });*/


        </script>

    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

        @include('layouts.navigation')

            @yield('content')

        </div>   
        
        <script>
        let audioNL = document.querySelectorAll('audio');
        let audio = Array.apply(null, audioNL);

        audio.forEach(t => {
            let index = audio.indexOf(t);

            t.addEventListener('play', ()=> {
                audio.forEach(subT => {
                    subT !== audio[index] ?
                    (subT.pause(), subT.currentTime = 0) :
                    subT.play()
                })
            })
            t.addEventListener('ended', ()=> {
                t.currentTime = 0;
                index !== audio.length - 1 ?
                    audio[index + 1].play() :
                    null
            })
        });
        
        </script>

    </body>
        
</html>
