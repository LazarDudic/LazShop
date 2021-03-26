@extends('layouts.app', ['title' => 'Contact'])
@section('head')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('content')
    <div class="container pt-5">
        <h1>Contact Us</h1>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.send-email') }}">
            @csrf
            <div class="form-group ">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" aria-describedby="name" placeholder="Your name" value="{{ old('name') }}">
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                       aria-describedby="emailHelp" placeholder="Enter your email" value="{{ old('email') }}">
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="comment">Message</label>
                <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" rows="4" >
                {{ old('comment') }}
            </textarea>
                @error('comment')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="g-recaptcha" data-sitekey="{{ $reCaptcha }}"></div>
            <br>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
