<!-- /resources/views/vue/index.blade.php -->
@extends('layouts.app')
@section('content')
    <template>
        <div id="app">
            <router-view />
        </div>
    </template>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection