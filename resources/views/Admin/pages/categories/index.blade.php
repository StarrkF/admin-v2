@extends('Admin.layouts.master')
@section('admin.content')
    <x-breadcrumb menu="{{ __('menus.categories') }}" />
    {{-- @include('Admin.includes.messages') --}}

    <category></category>

    {{-- <div class="row">
        <div class="col-4">
            <x-card-basic title="Create Category">
                <div class="row">
                    <form action="{{ route('store.categories') }}" method="POST">
                    @csrf
                        <x-input.basic-input label="Category Name" name="name" attr="required"/>
                        <x-input.basic-input type="number" label="Number" name="number"/>
                        <x-input.select name="page_type" label="Select Page Type" attr="required">
                            @foreach ($page_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </x-input.select>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </x-card-basic>
        </div>
    </div> --}}


@endsection
