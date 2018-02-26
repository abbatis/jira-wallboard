<!-- /resources/views/vue/index.blade.php -->
@extends('layouts.app')
@section('content')
    <script type="text/javascript">
        window.jiraCollection = JSON.parse("{!! addslashes($jiraCollection) !!}");
    </script>
    <template>
        <div id="app">
            <router-view />
        </div>
    </template>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection