<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">トップ画面 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"> Myお気に入り</a>
      </li>
@if(Auth::check())
      <li class="nav-item"><a class="nav-link" href="#">{{$user->name}}でログイン中</a></li>
      <form class="nav-link" id="logout-form" action="http://localhost:8000/logout" method="POST" >
        @csrf
        <input type="submit" value="ログアウト">
      </form>
        
@else
      <li class="nav-item"><a class="nav-link" href="{{route('register')}}"> 新規登録　</a></li>
      <li class="nav-item"><a class="nav-link" href="{{route('login')}}">　ログイン　</a></li>
@endif
    </ul>
  </div>
</nav>