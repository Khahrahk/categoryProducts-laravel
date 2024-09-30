<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex flex-row w-100 ps-3 pb-0 pt-1"
     style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1)">
    <div class="container-fluid">
        <div class="d-flex w-100 justify-content-end collapse navbar-collapse justify-content-between"
             id="navbarNavDarkDropdown">
            <a class="navbar-brand  " href="{{route('dashboard')}}">Products</a>
            @if(auth()->user()?->name)
                <button class="btn btn-dark" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-dark me-4 mt-2" style="right: 0; left: auto;">
                    <li><a class="dropdown-item" href="{{route('logout')}}">Выход</a></li>
                </ul>
            @else
                <a href="{{route('login')}}">
                    <button class="btn btn-dark">Вход</button>
                </a>
            @endif
        </div>
    </div>
</nav>
