<!-- resources/views/admin/auth/profile.blade.php -->
@extends('layouts.admin')

@section('page-title', 'My Profile')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
    <!-- Profile Sidebar -->
    <div class="content-card">
        <div style="text-align: center; padding: 20px;">
            <div style="width: 120px; height: 120px; margin: 0 auto 20px; border-radius: 50%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: 900; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            
            <h3 style="font-size: 1.5rem; font-weight: 800; color: #1f2937; margin-bottom: 5px;">
                {{ $user->name }}
            </h3>
            
            <p style="color: #6b7280; margin-bottom: 8px;">{{ $user->email }}</p>
            
            <span class="badge badge-success" style="font-size: 0.9rem;">
                {{ ucfirst($user->role) }}
            </span>
        </div>

        <div style="border-top: 2px solid #f3f4f6; padding: 20px;">
            <h4 style="font-size: 1rem; font-weight: 700; color: #1f2937; margin-bottom: 15px;">
                Account Information
            </h4>
            
            <div style="display: flex; flex-direction: column; gap: 12px; font-size: 0.9rem;">
                <div style="display: flex; align-items: center; gap: 10px; color: #6b7280;">
                    <i class="fas fa-calendar" style="width: 20px; color: #10b981;"></i>
                    <div>
                        <strong style="display: block; color: #4b5563; font-size: 0.85rem;">Member Since</strong>
                        {{ $user->created_at->format('M d, Y') }}
                    </div>
                </div>

                @if($user->last_login_at)
                <div style="display: flex; align-items: center; gap: 10px; color: #6b7280;">
                    <i class="fas fa-clock" style="width: 20px; color: #10b981;"></i>
                    <div>
                        <strong style="display: block; color: #4b5563; font-size: 0.85rem;">Last Login</strong>
                        {{ $user->last_login_at->diffForHumans() }}
                    </div>
                </div>
                @endif

                <div style="display: flex; align-items: center; gap: 10px; color: #6b7280;">
                    <i class="fas fa-shield-alt" style="width: 20px; color: #10b981;"></i>
                    <div>
                        <strong style="display: block; color: #4b5563; font-size: 0.85rem;">Account Status</strong>
                        <span class="badge badge-success">Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Forms -->
    <div>
        <!-- Update Profile -->
        <div class="content-card" style="margin-bottom: 30px;">
            <div class="card-header">
                <h3 class="card-title">Update Profile Information</h3>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-control" 
                           value="{{ old('name', $user->name) }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control" 
                           value="{{ old('email', $user->email) }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="avatar" class="form-label">Profile Picture</label>
                    @if($user->avatar)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset('storage/' . $user->avatar) }}" 
                                 alt="Current Avatar" 
                                 style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #10b981;">
                        </div>
                    @endif
                    <input type="file" 
                           id="avatar" 
                           name="avatar" 
                           class="form-control" 
                           accept="image/*">
                    <small style="color: #6b7280;">Recommended: Square image, at least 200x200px</small>
                </div>

                <div style="display: flex; gap: 15px; margin-top: 25px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">Change Password</h3>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password *</label>
                    <input type="password" 
                           id="current_password" 
                           name="current_password" 
                           class="form-control" 
                           placeholder="Enter current password">
                </div>

                <div class="form-group">
                    <label for="new_password" class="form-label">New Password *</label>
                    <input type="password" 
                           id="new_password" 
                           name="new_password" 
                           class="form-control" 
                           placeholder="Enter new password"
                           minlength="8">
                    <small style="color: #6b7280;">Minimum 8 characters</small>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password *</label>
                    <input type="password" 
                           id="new_password_confirmation" 
                           name="new_password_confirmation" 
                           class="form-control" 
                           placeholder="Confirm new password"
                           minlength="8">
                </div>

                <div style="display: flex; gap: 15px; margin-top: 25px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-lock"></i> Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Activity Log -->
        <div class="content-card" style="margin-top: 30px;">
            <div class="card-header">
                <h3 class="card-title">Recent Activity</h3>
            </div>

            <div style="display: flex; flex-direction: column; gap: 15px;">
                @if($user->last_login_at)
                <div style="display: flex; align-items: start; gap: 15px; padding: 15px; background: #f9fafb; border-radius: 8px;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); display: flex; align-items: center; justify-content: center; color: #10b981;">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <div style="flex: 1;">
                        <strong style="color: #1f2937;">Last Login</strong>
                        <p style="color: #6b7280; font-size: 0.9rem; margin-top: 5px;">
                            {{ $user->last_login_at->format('M d, Y \a\t H:i A') }}
                        </p>
                    </div>
                </div>
                @endif

                <div style="display: flex; align-items: start; gap: 15px; padding: 15px; background: #f9fafb; border-radius: 8px;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center; color: #3b82f6;">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div style="flex: 1;">
                        <strong style="color: #1f2937;">Account Created</strong>
                        <p style="color: #6b7280; font-size: 0.9rem; margin-top: 5px;">
                            {{ $user->created_at->format('M d, Y \a\t H:i A') }}
                        </p>
                    </div>
                </div>

                <div style="display: flex; align-items: start; gap: 15px; padding: 15px; background: #f9fafb; border-radius: 8px;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center; color: #f59e0b;">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div style="flex: 1;">
                        <strong style="color: #1f2937;">Profile Last Updated</strong>
                        <p style="color: #6b7280; font-size: 0.9rem; margin-top: 5px;">
                            {{ $user->updated_at->format('M d, Y \a\t H:i A') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="content-card" style="margin-top: 30px;">
            <div class="card-header">
                <h3 class="card-title">Security Settings</h3>
            </div>

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f9fafb; border-radius: 12px;">
                    <div>
                        <strong style="color: #1f2937; display: block; margin-bottom: 5px;">
                            <i class="fas fa-lock" style="color: #10b981; margin-right: 8px;"></i>
                            Password Protection
                        </strong>
                        <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">
                            Last changed {{ $user->updated_at->diffForHumans() }}
                        </p>
                    </div>
                    <span class="badge badge-success">Active</span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f9fafb; border-radius: 12px;">
                    <div>
                        <strong style="color: #1f2937; display: block; margin-bottom: 5px;">
                            <i class="fas fa-shield-alt" style="color: #10b981; margin-right: 8px;"></i>
                            Account Access
                        </strong>
                        <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">
                            {{ ucfirst($user->role) }} privileges
                        </p>
                    </div>
                    <span class="badge badge-success">{{ $user->is_admin ? 'Full Access' : 'Limited Access' }}</span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f9fafb; border-radius: 12px;">
                    <div>
                        <strong style="color: #1f2937; display: block; margin-bottom: 5px;">
                            <i class="fas fa-envelope" style="color: #10b981; margin-right: 8px;"></i>
                            Email Verified
                        </strong>
                        <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">
                            {{ $user->email }}
                        </p>
                    </div>
                    <span class="badge badge-success">
                        <i class="fas fa-check"></i> Verified
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview avatar before upload
    document.getElementById('avatar').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('img');
                preview.src = e.target.result;
                preview.style.cssText = 'width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #10b981; margin-top: 10px;';
                
                const existingPreview = document.querySelector('.avatar-preview');
                if (existingPreview) {
                    existingPreview.remove();
                }
                
                preview.classList.add('avatar-preview');
                e.target.parentElement.appendChild(preview);
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Password strength indicator
    const newPassword = document.getElementById('new_password');
    if (newPassword) {
        newPassword.addEventListener('input', function() {
            const strength = calculatePasswordStrength(this.value);
            showPasswordStrength(strength);
        });
    }

    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;
        return strength;
    }

    function showPasswordStrength(strength) {
        const existingIndicator = document.querySelector('.password-strength');
        if (existingIndicator) {
            existingIndicator.remove();
        }

        const indicator = document.createElement('div');
        indicator.classList.add('password-strength');
        indicator.style.cssText = 'margin-top: 8px; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;';

        if (strength <= 2) {
            indicator.style.background = 'rgba(239, 68, 68, 0.1)';
            indicator.style.color = '#dc2626';
            indicator.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Weak password';
        } else if (strength <= 3) {
            indicator.style.background = 'rgba(245, 158, 11, 0.1)';
            indicator.style.color = '#d97706';
            indicator.innerHTML = '<i class="fas fa-shield-alt"></i> Medium password';
        } else {
            indicator.style.background = 'rgba(16, 185, 129, 0.1)';
            indicator.style.color = '#059669';
            indicator.innerHTML = '<i class="fas fa-check-circle"></i> Strong password';
        }

        newPassword.parentElement.appendChild(indicator);
    }
</script>
@endpush