@extends('layouts.app')
@section('content')
    <div id="landing" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><strong> {{ __('Change E-Mail Address') }} </strong></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('email.change') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Current E-Mail Address:') }}</label>

                                <div class="col-lg-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newEmail" class="col-md-4 col-form-label text-md-right">{{ __('New E-Mail Address:') }}</label>

                                <div class="col-lg-6">
                                    <input id="newEmail" type="email" class="form-control @error('newEmail') is-invalid @enderror" name="newEmail" value="{{ $newEmail ?? old('newEmail') }}" required autocomplete="newEmail" autofocus>

                                    @error('newEmail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-info">
                                        {{ __('Change E-Mail') }}
                                    </button>
                                    <a href="{{ route('profile.show') }}" class="btn bg-light btn-outline-dark">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection



