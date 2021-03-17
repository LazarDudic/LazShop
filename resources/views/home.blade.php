@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @include('partials.sidebar')
            <!-- sidebar -->
            <livewire:product.show-products />
            <!-- Livewire Show Products -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
