@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputFirstName">First Name</label>
                                    <input name="first_name" class="form-control py-4 @error('first_name') is-invalid @enderror"
                                           id="inputFirstName" type="text" placeholder="Enter first name" value="{{ old('first_name') }}" />
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputLastName">Last Name</label>
                                    <input name="last_name" class="form-control py-4 @error('last_name') is-invalid @enderror"
                                           id="inputLastName" type="text" placeholder="Enter last name" value="{{ old('last_name') }}" />
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input name="email" class="form-control py-4 @error('email') is-invalid @enderror" id="inputEmailAddress"
                                   type="email" aria-describedby="emailHelp" placeholder="Enter email address" value="{{ old('email') }}" />
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input name="password" class="form-control py-4  @error('password') is-invalid @enderror" id="inputPassword" type="password" placeholder="Enter password" />
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                    <input name="password_confirmation" class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm password" />
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" name="country" placeholder="Country" value="{{ old('country') }}"
                                           class="form-control @error('country') is-invalid @enderror">
                                    @error('country')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" name="state" placeholder="State" value="{{ old('state') }}"
                                        class="form-control @error('state') is-invalid @enderror">
                                    @error('state')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" placeholder="City" value="{{ old('city') }}"
                                           class="form-control @error('city') is-invalid @enderror" >
                                    @error('city')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Zipcode</label>
                                    <input type="text" name="zipcode" placeholder="Zipcode"
                                           value="{{ old('zipcode')}}" class="form-control @error('country') is-invalid @enderror">
                                    @error('zipcode')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" placeholder="Address" value="{{ old('address') }}
                                   " class="form-control @error('country') is-invalid @enderror">
                            @error('address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>


                        <div class="form-group mt-4 mb-0">
                            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small"><a href="{{ route('login') }}">Have an account? Go to login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


