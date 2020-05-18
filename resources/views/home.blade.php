@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenue {{Auth::user()->name}}
                    <div class="links">
                        <p class="mt-3">Accéder aux :</p>
                        <a href="{{url('task')}}">Travaux</a><br>
                        @if(Auth::user()->type_id == 1)
                            <a href="{{url('approve')}}">Approuver utilisateurs</a><br>
                            <a href="{{url('users')}}">Utilisateurs</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
