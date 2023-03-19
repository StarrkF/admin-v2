@extends('Admin.layouts.master')
@section('admin.content')
    <x-breadcrumb menu="Users" />


    @include('Admin.includes.messages')
    <div class="row">
        <div class="col-md-4 col-12">

            <form action="{{ route('post.register') }}" method="POST">
                @csrf
                <x-card-basic title="Add User">
                    <form class="form form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                id="first-name-icon">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" name="email" class="form-control" placeholder="Email"
                                                id="first-name-icon">
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Password</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" name="password" class="form-control"
                                                placeholder="Password">
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Password Confirmation</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" name="password_confirmation" class="form-control"
                                                placeholder="Password Again">
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Add User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </x-card-basic>
            </form>
        </div>



        <div class="col-md-8 col-12">
            <x-card-basic title="All Users">
                <x-table :heads="['ID', 'Name', 'Email', 'Role', 'Permissions', 'Action']">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role_name }}</td>
                            <td>{{ $user->permission_names }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-success editUser" id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#editUser">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('delete.user',$user->id) }}" class="swalDelete" method="GET">
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
    </div>

    <x-modal id="editUser" title="deneme modal" :action="route('update.user')" >
        <div class="form-group">
            <label>Name</label>
            <input required type="text" id="name"  class="form-control" name="name">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input required type="text" id="email"  class="form-control" name="email" placeholder="E mail">
        </div>

        <div class="form-group">
            <label>Role</label>
            <select required name="role" id="role" class="form-select">
                <option value="">Select Role Type</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

    </x-modal>
@endsection
