<!-- resources/views/admin/donations/show.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Donation Details')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">Donation #{{ $donation->transaction_reference }}</h3>
        <div style="display: flex; gap: 10px;">
            @if($donation->status === 'pending_verification')
                <button onclick="openVerifyModal({{ $donation->id }})" class="btn btn-primary btn-sm">
                    <i class="fas fa-check"></i> Verify Payment
                </button>
            @endif
            <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Main Details -->
        <div>
            <!-- Transaction Info -->
            <div style="background: #f9fafb; padding: 25px; border-radius: 12px; margin-bottom: 25px;">
                <h4 style="margin-bottom: 20px; color: #1f2937; font-size: 1.2rem;">Transaction Information</h4>
                
                <div style="display: grid; gap: 15px;">
                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="color: #6b7280;">Amount:</span>
                        <strong style="color: #10b981; font-size: 1.3rem;">${{ number_format($donation->amount, 2) }} {{ $donation->currency }}</strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="color: #6b7280;">Type:</span>
                        <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $donation->donation_type)) }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="color: #6b7280;">Payment Method:</span>
                        <span class="badge badge-secondary">{{ ucfirst(str_replace('_', ' ', $donation->payment_method)) }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="color: #6b7280;">Status:</span>
                        @if($donation->status === 'completed')
                            <span class="badge badge-success">Completed</span>
                        @elseif($donation->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($donation->status === 'pending_verification')
                            <span class="badge badge-info">Pending Verification</span>
                        @else
                            <span class="badge badge-danger">{{ ucfirst($donation->status) }}</span>
                        @endif
                    </div>

                    @if($donation->payment_id)
                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="color: #6b7280;">Payment ID:</span>
                        <code style="background: white; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem;">{{ $donation->payment_id }}</code>
                    </div>
                    @endif

                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="color: #6b7280;">Date Created:</span>
                        <strong>{{ $donation->created_at->format('M d, Y - H:i A') }}</strong>
                    </div>

                    @if($donation->paid_at)
                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="color: #6b7280;">Date Paid:</span>
                        <strong>{{ $donation->paid_at->format('M d, Y - H:i A') }}</strong>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Donor Information -->
            <div style="background: #f9fafb; padding: 25px; border-radius: 12px; margin-bottom: 25px;">
                <h4 style="margin-bottom: 20px; color: #1f2937; font-size: 1.2rem;">Donor Information</h4>
                
                <div style="display: grid; gap: 15px;">
                    @if(!$donation->is_anonymous)
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Name:</span>
                            <strong>{{ $donation->donor->full_name }}</strong>
                        </div>

                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Email:</span>
                            <a href="mailto:{{ $donation->donor->email }}" style="color: #10b981;">{{ $donation->donor->email }}</a>
                        </div>

                        @if($donation->donor->phone)
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Phone:</span>
                            <a href="tel:{{ $donation->donor->phone }}" style="color: #10b981;">{{ $donation->donor->phone }}</a>
                        </div>
                        @endif

                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Total Donated:</span>
                            <strong style="color: #10b981;">${{ number_format($donation->donor->total_donated, 2) }}</strong>
                        </div>

                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Total Donations:</span>
                            <strong>{{ $donation->donor->donation_count }}</strong>
                        </div>
                    @else
                        <div style="text-align: center; padding: 20px; color: #6b7280;">
                            <i class="fas fa-user-secret" style="font-size: 2rem; margin-bottom: 10px;"></i>
                            <p>Anonymous Donation</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Message -->
            @if($donation->message)
            <div style="background: #f9fafb; padding: 25px; border-radius: 12px; margin-bottom: 25px;">
                <h4 style="margin-bottom: 15px; color: #1f2937; font-size: 1.2rem;">Donor Message</h4>
                <p style="color: #4b5563; line-height: 1.7;">{{ $donation->message }}</p>
            </div>
            @endif

            <!-- Admin Notes -->
            @if($donation->admin_notes || $donation->failure_reason)
            <div style="background: #fef3c7; padding: 25px; border-radius: 12px; border-left: 4px solid #f59e0b;">
                <h4 style="margin-bottom: 15px; color: #92400e; font-size: 1.2rem;">
                    <i class="fas fa-sticky-note"></i> Admin Notes
                </h4>
                <p style="color: #78350f; line-height: 1.7;">
                    {{ $donation->admin_notes ?? $donation->failure_reason }}
                </p>
                @if($donation->verified_by)
                    <small style="color: #92400e; display: block; margin-top: 10px;">
                        Verified by {{ $donation->verifiedBy->name }} on {{ $donation->verified_at->format('M d, Y') }}
                    </small>
                @endif
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Quick Actions -->
            <div style="background: white; border: 2px solid #e5e7eb; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 15px; color: #1f2937; font-size: 1.1rem;">Quick Actions</h4>
                
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    @if($donation->status === 'pending_verification')
                        <button onclick="openVerifyModal({{ $donation->id }})" class="btn btn-primary btn-sm" style="width: 100%;">
                            <i class="fas fa-check"></i> Verify Payment
                        </button>
                    @endif
                    
                    <a href="mailto:{{ $donation->donor->email }}" class="btn btn-secondary btn-sm" style="width: 100%;">
                        <i class="fas fa-envelope"></i> Email Donor
                    </a>
                    
                    @if($donation->isCompleted())
                        <a href="{{ route('donate.receipt', $donation->id) }}" class="btn btn-secondary btn-sm" style="width: 100%;" target="_blank">
                            <i class="fas fa-file-pdf"></i> Download Receipt
                        </a>
                    @endif
                </div>
            </div>

            <!-- Technical Details -->
            <div style="background: white; border: 2px solid #e5e7eb; padding: 20px; border-radius: 12px;">
                <h4 style="margin-bottom: 15px; color: #1f2937; font-size: 1.1rem;">Technical Details</h4>
                
                <div style="font-size: 0.85rem; color: #6b7280; display: flex; flex-direction: column; gap: 10px;">
                    <div>
                        <strong>IP Address:</strong><br>
                        <code style="background: #f3f4f6; padding: 2px 6px; border-radius: 4px;">{{ $donation->ip_address ?? 'N/A' }}</code>
                    </div>
                    
                    <div>
                        <strong>User Agent:</strong><br>
                        <small style="word-break: break-all;">{{ Str::limit($donation->user_agent, 100) ?? 'N/A' }}</small>
                    </div>
                    
                    <div>
                        <strong>Created:</strong><br>
                        {{ $donation->created_at->format('M d, Y H:i:s') }}
                    </div>
                    
                    <div>
                        <strong>Updated:</strong><br>
                        {{ $donation->updated_at->format('M d, Y H:i:s') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Verify Modal (same as index page) -->
<div id="verifyModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 16px; padding: 30px; max-width: 500px; width: 90%;">
        <h3 style="margin-bottom: 20px; color: #1f2937;">Verify Donation</h3>
        
        <form action="{{ route('admin.donations.verify', $donation->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    <option value="completed">Approve (Completed)</option>
                    <option value="failed">Reject (Failed)</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Admin Notes</label>
                <textarea name="admin_notes" class="form-control" rows="3" placeholder="Optional notes about this verification"></textarea>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Verify
                </button>
                <button type="button" onclick="closeVerifyModal()" class="btn btn-secondary">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openVerifyModal() {
        document.getElementById('verifyModal').style.display = 'flex';
    }

    function closeVerifyModal() {
        document.getElementById('verifyModal').style.display = 'none';
    }

    document.getElementById('verifyModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeVerifyModal();
        }
    });
</script>
@endpush
