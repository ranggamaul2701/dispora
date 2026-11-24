<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin DISPORAPAR Samarinda')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f5f7f6;
            font-family: Arial, sans-serif;
        }

        .admin-navbar {
            background: #198754;
        }

        .admin-content {
            padding: 30px;
        }

        .sidebar {
            min-height: calc(100vh - 56px);
            background: #ffffff;
            border-right: 1px solid #e5e5e5;
        }

        .sidebar a {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background: #e9f5ee;
            color: #198754;
        }

        .sidebar a.active {
            background: #198754;
            color: white;
        }
    </style>

    @stack('styles')
</head>

<body>

<nav class="navbar navbar-dark admin-navbar">
    <div class="container-fluid">

        <a
            class="navbar-brand fw-bold"
            href="{{ route('admin.dashboard') }}"
        >
            DISPORAPAR SAMARINDA
        </a>

        <div class="d-flex align-items-center gap-3 text-white">

            @auth
                <span>
                    <i class="bi bi-person-circle"></i>
                    {{ auth()->user()->name }}
                </span>
            @endauth

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="m-0"
            >
                @csrf

                <button
                    type="submit"
                    class="btn btn-light btn-sm"
                >
                    Logout
                </button>
            </form>

        </div>

    </div>
</nav>


<div class="container-fluid">

    <div class="row">

        {{-- SIDEBAR --}}

        <aside class="col-md-2 sidebar p-3">

            <div class="mb-3 fw-bold text-muted">
                MENU ADMIN
            </div>

            <a href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.destinasi.index') }}">
                <i class="bi bi-geo-alt"></i>
                Destinasi
            </a>

            <a href="{{ route('admin.berita.index') }}">
                <i class="bi bi-newspaper"></i>
                Berita
            </a>

            <a href="{{ route('admin.agenda.index') }}">
                <i class="bi bi-calendar-event"></i>
                Agenda
            </a>

            <a href="{{ route('admin.galeri.index') }}">
                <i class="bi bi-images"></i>
                Galeri
            </a>

            <a href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i>
                Users
            </a>

            <hr>

            <a href="{{ url('/') }}"
               target="_blank">

                <i class="bi bi-globe"></i>
                Lihat Website
            </a>

        </aside>


        {{-- CONTENT --}}

        <main class="col-md-10 admin-content">

            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>

            @endif


            @if($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Terjadi kesalahan:
                    </strong>

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            @yield('content')

        </main>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

@stack('scripts')

</body>
</html>