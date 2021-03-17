@extends('layouts.app', ['title' => $category->name])

@section('content')
    <div class="container">

        <div class="row">

        @include('partials.sidebar')
        <!-- sidebar -->
           <livewire:product.show-products :categoryId="$category->id" />
            <!-- Livewire Show Category Products -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
