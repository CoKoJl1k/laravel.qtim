<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referer" content="origin-when-cross-origin"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="module" src="{{ asset('js/scripts.js') }}"></script>

    <script src="{{ asset('/build/assets/app-4ed993c7.js')}}"></script>
    <script src="{{ asset('/build/assets/app-192f1c3e.js')}}"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <title>To do list</title>
</head>

<div class="container">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                        <!--<a class="nav-link" href="{#route('boards.index')#}"><b>Boards</b> </a> -->
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
