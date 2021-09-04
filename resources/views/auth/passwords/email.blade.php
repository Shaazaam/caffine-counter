@extends('main')
@section('title', 'Password Reset Request')
@section('body')

<div class="row m-top">
    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">Password Reset Request</div>
            <div class="panel-body">
                @include('partials.error-container')

                <form role="form" method="post" action="/password/email">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <p>To continue, please enter your Email Address.</p>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                        <a href="/login" class="btn btn-default">Back to Login</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@stop
