@extends('layouts.edit')

@section('title', 'Edit Profile')

@section('content')
    <div class="container-fluid min-vh-100 bg-light py-5">
        <div class="row justify-content-center">
            <div class="col-11 col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white text-center py-3 border-bottom">
                        <h4 class="mb-0 fw-bold" style="color: #1e90ff;">
                            <i class="fas fa-user-edit me-2"></i> Edit Profile
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white text-center py-3 border-bottom">
                        <h4 class="mb-0 fw-bold" style=" decrees="color: #f39c12;">
                            <i class="fas fa-lock me-2"></i> Change Password
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white text-center py-3 border-bottom">
                        <h4 class="mb-0 fw-bold" style="color: #c0392b;">
                            <i class="fas fa-trash-alt me-2"></i> Delete Account
                        </h4>
                    </div>
                    <div class="card-body p-4 text-center">
                        <p class="text-muted mb-3 small">Please note that deleting your account is an irreversible action!</p>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection