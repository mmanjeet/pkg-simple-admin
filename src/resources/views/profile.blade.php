@extends('single-admin::layout.app')
@section('title','Profile || Admin')
@push('style')
<style>
    .container {
        max-width: 960px;
        margin: 30px auto;
        padding: 20px;
    }

    h1 {
        font-size: 20px;
        text-align: center;
        margin: 20px 0 20px;
    }

    h1 small {
        display: block;
        font-size: 15px;
        padding-top: 8px;
        color: gray;
    }

    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 50px auto;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all .2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    /* .avatar-upload .avatar-edit input+label:after {
        content: "\f303";
        font-family: "Font Awesome 5 Free";
        color: #757575;
        position: absolute;
        top: 10px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    } */

    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
@endpush
@php
$profile_pic=!empty(auth()->user()->profile_pic) ? asset('storage/'.auth()->user()->profile_pic) : asset('assets/img/avatars/avatar-6.png') ;
@endphp
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Profile</h1>
        </div>
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Details</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $profile_pic }}" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        <h5 class="card-title mb-0">{{ auth()->user()->fname ?? '' }} {{ auth()->user()->lname ?? '' }}</h5>
                        <div class="text-muted mb-2">{{ auth()->user()->role ?? '' }}</div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span>Full Name :<a href="javascript:void(0);"> {{ auth()->user()->fname ?? '' }} {{ auth()->user()->lname ?? '' }}</a></li>
                            <li class="mb-1"><span data-feather="send" class="feather-sm me-1"></span>Email :<a href="javascript:void(0);"> {{ auth()->user()->email ?? '' }}</a></li>
                            <li class="mb-1"><span data-feather="phone-call" class="feather-sm me-1"></span>Phone :<a href="javascript:void(0);"> {{ auth()->user()->phone ?? '' }}</a></li>
                            <li class="mb-1"><span data-feather="user-check" class="feather-sm me-1"></span>Role :<a href="javascript:void(0);"> {{ auth()->user()->role ?? '' }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Change Password</h5>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form action="{{ route('password')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="floating-label mb-3" for="new_pass">New Password</label>
                                        <input type="password" class="form-control" id="new_pass" name="new_pass" value="{{ old('new_pass') }}">
                                    </div>
                                    @error('new_pass')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="floating-label mb-3" for="password">Confirm Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                                    </div>
                                    @error('password')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-sm-12 ">
                                    <button class="btn btn-success"><i class="fa fa-check"></i> Change Password</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Update Profile</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="floating-label mb-2" for="user_name">User Name</label>
                                        <input type="text" class="form-control" id="user_name" name="name" value="{{ auth()->user()->name }}" oninput="this.value=this.value.replace(/[^a-zA-Z]/g,'')">
                                    </div>
                                    @error('name')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="floating-label mb-2" for="fname">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname" value="{{ auth()->user()->fname ?? '' }}">
                                    </div>
                                    @error('fname')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="floating-label mb-2" for="lname">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname" value="{{ auth()->user()->lname ?? '' }}">
                                    </div>
                                    @error('lname')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="floating-label mb-2" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="floating-label mb-2" for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" oninput="this.value=this.value.replace(/[^0-9+ ]/g,'')">
                                    </div>
                                    @error('name')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-10">
                                    <div class="container">
                                        <h1>Upload Profile Pic
                                            <small>with preview</small>
                                        </h1>
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' name="profile_pic" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                                <label for="imageUpload"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle me-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                    </svg></label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url('{{ $profile_pic }}');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('lname')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>

@endsection
@push('script')
<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    });
</script>
@endpush