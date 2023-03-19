@extends('Admin.layouts.master')
@section('admin.content')
    <x-breadcrumb menu="Roles & Permissions" />

    <div class="row">



        @include('Admin.includes.messages')
        <div class="col-md-7 col-12">
            <x-card-basic title="Roles">

                <form action="{{ route('post.role.create') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input required type="text" class="form-control" name="name" placeholder="Role Name">
                        <button class="btn btn-primary" type="submit">Add Role</button>
                    </div>
                </form>


                <x-table :heads="['Role', 'Permissions', 'Action']">
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->permissions as $perm)
                                    <span class="badge bg-primary">{{ $perm->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('delete.role',$role->id) }}" class="swalDelete" method="GET">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            </x-card-basic>
        </div>
        <div class="col-md-5 col-12">
            <x-card-basic title="Permissions">
                <form action="{{ route('post.role-permission-update') }}" method="POST">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="form-group">
                                <select required name="role" id="selectRole" class="choices form-select form-select">
                                    <option value="">Select Role Type</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <x-input.checkbox id="selectAll" label="Select All" dataClass="permCheck"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-6">
                                <x-input.checkbox id="{{ 'perm_'.$permission->id }}" name="permission[]" :label="$permission->name" :value="$permission->name" class="permCheck"/>
                            </div>
                        @endforeach

                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary float-end my-3">Save</button>
                </form>
            </x-card-basic>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Choices('.choices');
    </script>
@endsection
