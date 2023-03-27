@extends('Admin.layouts.master')
@section('admin.content')
    <x-breadcrumb menu="{{ __('menus.projects') }}" />

    <div id="app">
        <project></project>
    </div>
@endsection
