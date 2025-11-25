@extends('layouts.admin')

@section('title', 'Auth')
<style>
    #app {
        margin:0 !important;
    }
</style>
@section('content')
    <div id="app">

        <section class="section main-section">
            <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-lock"></i></span>
                Login
                </p>
            </header>
            <div class="card-content">
                <form method="post" action="{{ route('admin.login') }}">
                @csrf
                {{-- This is how you display the error message --}}
                @error('message')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                <div class="field spaced">
                    <label class="label">Login</label>
                    <div class="control icons-left">
                    <input class="input" type="email" name="email" placeholder="user@example.com" value="{{ old('email') }}" required autofocus>
                    <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                    </div>
                    <p class="help">
                    Please enter your login
                    </p>
                </div>

                <div class="field spaced">
                    <label class="label">Password</label>
                    <p class="control icons-left">
                    <input class="input" type="password" name="password" placeholder="Password" autocomplete="current-password">
                    <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                    </p>
                    <p class="help">
                    Please enter your password
                    </p>
                </div>

                <div class="field spaced">
                    <div class="control">
                    <label class="checkbox"><input type="checkbox" name="remember" value="1">
                        <span class="check"></span>
                        <span class="control-label">Remember</span>
                    </label>
                    </div>
                </div>

                <hr>

                <div class="field grouped">
                    <div class="control">
                    <button type="submit" class="button blue">
                        Login
                    </button>
                    </div>
                    {{-- <div class="control">
                    <a href="index.html" class="button">
                        Back
                    </a>
                    </div> --}}
                </div>

                </form>
            </div>
            </div>

        </section>

    </div>
@endsection
