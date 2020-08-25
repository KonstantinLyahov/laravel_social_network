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
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
        <div class="col-6">
            <h3>Sign In</h3>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection