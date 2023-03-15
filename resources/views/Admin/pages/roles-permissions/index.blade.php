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
                            <div class="form-check float-end">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="selectAll" class="form-check-input form-check-primary">
                                    <label class="form-check-label" for="selectAll">Select All</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" value="{{ $permission->name }}"
                                            class="form-check-input form-check-primary permCheck"
                                            id="perm_{{ $permission->id }}" name="permission[]">
                                        <label class="form-check-label"
                                            for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
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
