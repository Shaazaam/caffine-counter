@extends('layouts.plain')
@section('title', 'Complete Your Profile')
@section('body')
@include('partials.modal-tos')

<div class="row">
    <div class="col-lg-12">
        <h1>Welcome, {{$user->name}}</h1>
        <p>We're almost done setting up your account. Please fill out/confirm the information below and accept the terms and conditions to finish configuring your account.</p>
    </div>
</div>
<hr>

@include('partials.error-container')

<div class="col-sm-12 col-md-8 col-lg-6">
    <form role="form" method="post" action="/register">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="user_id" value="{{$user->id}}" />
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group {{$errors->has('first_name') ? ' has-error' : '' }}">
                        <label class="required">First Name</label>
                        <input name="first_name" class="form-control" placeholder="First Name" value="{{$user->first_name}}">
                        @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('last_name') ? ' has-error' : '' }}">
                        <label class="required">Last Name</label>
                        <input name="last_name" class="form-control" placeholder="Last Name" value="{{$user->last_name}}">
                        @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('email') ? ' has-error' : '' }}">
                        <label class="required">Email</label>
                        <input name="email" class="form-control" placeholder="Email" value="{{$user->email}}">
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <div class="form-group {{$errors->has('password') ? ' has-error' : '' }}">
                        <label class="required">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" value="{{old('password')}}">
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label class="required">Repeat Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat Password" value="{{old('password_confirmation')}}">
                        @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group {{$errors->has('tos_agree') ? ' has-error' : '' }}">
            <div class="checkbox">
                <label class="no-padding required">
                    <input type="checkbox" name="tos_agree" value="1" @if (old('tos_agree') === '1') checked @endif> By checking this box, I agree to the <a href="#" data-toggle="modal" data-target="#modal-tos">Terms and Conditions</a>.
                </label>
            </div>
            @if ($errors->has('tos_agree'))
                <span class="help-block">
                    <strong>{{ $errors->first('tos_agree') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Complete Registration</button>
    </form>
</div>
@stop
