<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">COVID19 Updates</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item @if(Request::is('home')) active @endif">
          <a class="nav-link" href="{{url('home')}}">All<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item @if(Request::is('your-country')) active @endif">
          <a class="nav-link" href="{{url('your-country')}}">Your country</a>
        </li>
        <li class="nav-item @if(Request::is('sri-lanka')) active @endif">
          <a class="nav-link" href="{{url('sri-lanka')}}">Sri Lanka</a>
        </li>
      </ul>
      {{-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> --}}
    </div>
  </nav>