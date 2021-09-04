@extends('main')
@section('title', 'Login')
@section('body')

<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                @include('partials.error-container')

                <form role="form" method="post" action="/login">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" />
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" /> Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="/password/reset" class="btn btn-default">Forgot Your Password?</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@stop
