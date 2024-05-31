<header>
    <nav class="navbar">
        <div class="container-fluid">
            <a href="{{ route('home') }}" target="_blank" class="navbar-brand">Vedi il sito</a>

            <div class="d-flex align-items-center">
                <form action="{{ route('admin.projects.index') }}" method="GET" class="d-flex me-3" role="search">
                    <input name="toSearch" class="form-control me-2" type="search" placeholder="Project Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <p class="me-3 mb-0">{{ Auth::user()->name }}</p>
                <form action="{{ route('logout') }}" method="POST">
                    <button type="submit" class="btn logout"><i class="fa-solid fa-right-from-bracket"></i></button>
                    @csrf
                </form>
            </div>
        </div>
    </nav>
</header>
