@extends('layouts.master')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="row">
        <div class="col-6">
            <h3>Sign Up</h3>
            <form action="{{ route('signup') }}" method="POST">
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'has-error' : '' }}" name="email" id="email" value={{ Request::old('email') }}>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value={{ Request::old('first_name') }}>
                    @error('first_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
        <div class="col-6">
            <h3>Sign In</h3>
            <form action="{{ route('signin') }}" method="POST">
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" name="signin_email" id="email" value={{ Request::old('email') }}>
                    @error('signin_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="signin_password" id="password">
                    @error('signin_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
@endsection