@extends('layouts.app')

@section('title')
Мой профиль
@endsection

<div id="show-image">

    <div class="user-img" id="img"></div>
    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Закрыть" onclick="hide()" style="margin-bottom: 2vw !important; float: right; display: block;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
        </svg>
    </button>
    <div class="image-info">
        <p style="display: none;" id="author">Автор: Admin</p>
        <p id="com"></p>
        <a href="refs/animals/16.jpg" target="_blank" id="ref_href">Референс</a>
    </div>

</div>

<div class="backdrop" id="fade"></div>

@section('content')

<div class="account-content">


    <div class="container info">
        <div class="row  gy-5">

            <div class="col-3">
                <div class="avatar"></div>
            </div>

            <div class="col-9">
                <p>{{ Auth::user()->name }}</p>
                
                <div class="d-flex justify-content-start f-info">
                    <p>Подписчики: 79</p>
                    <p>Подписки: 14</p>
                </div>

            </div>

        </div>
    </div>


    <hr>
    <div class="container new-images">
        <div class="row">


            @forelse($images->reverse() as $img)
            <div class="col-4" onclick="show(this.querySelector('#user-image').title, this.querySelector('#user-image').style.backgroundImage, this.querySelector('#user-name').title, this.querySelector('#comment').title, this.querySelector('#ref-id').title)">
                <div class="user-img" style="background-image: url('{{ $img->image }}'); !important;" id='user-image'></div>
                <p id="user-name" style='display:none;' title='{{$img->user_name}}'></p>
                <p id="comment" style='display:none;' title='{{$img->comment}}'></p>
                <p id="ref-id" style='display:none;' title='{{$img->ref_id}}'></p>
            </div>
            @empty
            <div class="col-12">
                <h3 class="text-center">Вы пока что не опубликовали ни одной работы. </h3>
            </div>
            <div class="col-12"><a href="/start_editor">
                    <p class="text-center">Выбрать тему для первой иллюстрации.</p>
                </a></div>
            @endforelse


        </div>

    </div>

    <script>
        var img_id, src, user_name, comment, ref_id;

        document.getElementById('show-image').hidden = true;

        function show(a, b, c, d, f) {
            img_id = a;
            src = b;
            user_name = c;
            comment = d;
            ref_id = f;

            document.getElementById('show-image').hidden = false;
            document.getElementById('img').style.backgroundImage = src;
            document.getElementById("author").innerHTML = "Автор: " + user_name;
            document.getElementById("com").innerHTML = comment;
            document.getElementById("ref_href").href = "refs/animals/" + ref_id + ".jpg";

            document.getElementById("fade").style.display = "block";

            $('body').addClass('preventscroll');
        }

        function hide() {
            document.getElementById('show-image').hidden = true;

            document.getElementById("fade").style.display = "none";

            $('body').removeClass('preventscroll');
        }
    </script>

</div>

@endsection