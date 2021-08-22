@extends('layouts.auth')
@section('title')
    Forgot Password
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header"><h4>Resend Verification Link</h4></div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('verification.email.resend') }}">
                @csrf
                @if (session()->has('error'))
                    <div class="alert alert-danger p-0">
                        {{ session()->get('error') }}
                        {{--<ul>
                            @foreach (\session()->get('error') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>--}}
                    </div>
                @elseif(session()->has('success'))
                    <div class="success alert-success p-1 mb-1">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" tabindex="1" value="{{ old('email') }}" autofocus required>
                    <div class="invalid-feedback">hi there
                        {{ session()->get('error') }}
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Re-send Verification Link
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{--<div class="mt-5 text-muted text-center">
        Recalled your login info? <a href="{{ route('login') }}">Sign In</a>
    </div>--}}
@endsection
