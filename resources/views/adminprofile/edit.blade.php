@extends('layouts.edit')

@section('title', 'Edit Profile')

@section('content')
    <div class="container-fluid min-vh-100 bg-light py-5">
        <div class="row justify-content-center">
            <div class="col-11 col-md-8 col-lg-6">
                <!-- Profile Info Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white text-center py-3 border-bottom">
                        <h4 class="mb-0 fw-bold" style="color: #1e90ff;">
                            <i class="fas fa-user-edit me-2"></i> تعديل الملف الشخصي
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        @include('adminprofile.adminpartials.update-profile-information-form')
                    </div>
                </div>

                <!-- Password Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white text-center py-3 border-bottom">
                        <h4 class="mb-0 fw-bold" style="color: #f39c12;">
                            <i class="fas fa-lock me-2"></i> تغيير كلمة المرور
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        @include('adminprofile.adminpartials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white text-center py-3 border-bottom">
                        <h4 class="mb-0 fw-bold" style="color: #c0392b;">
                            <i class="fas fa-trash-alt me-2"></i> حذف الحساب
                        </h4>
                    </div>
                    <div class="card-body p-4 text-center">
                        <p class="text-muted mb-3 small">يرجى ملاحظة أن حذف حسابك إجراء لا يمكن التراجع عنه!</p>
                        @include('adminprofile.adminpartials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection