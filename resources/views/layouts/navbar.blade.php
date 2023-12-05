@extends('layouts.main')

@section('body')


        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">

              <a class="navbar-brand" href="#">Ebook Library</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="/peminjaman">Peminjaman</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Profile
                    </a>
                    <ul class="dropdown-menu">
                      <li><span class="dropdown-item">Username : {{$username}}</span></li>
                      <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                  </li>
          
                </ul>

              </div>
            </div>
          </nav>

    @yield('container')
@endsection

