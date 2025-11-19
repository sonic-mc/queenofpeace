<!-- resources/views/admin/donations/index.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Donations Management')

@section('content')
<!-- Stats Summary -->
<div class="stats-grid" style="margin-bottom: 30px;">
    <div class="stat-card">
        <div class="stat-info">
            <h3>${{ number_format($stats['total'], 2) }}</h3>
            <p>Total Completed</p>
        </div>
        <div class="stat-icon success">
            <i class="fas fa-check-circle"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $stats['pending'] }}</h3>
            <p>Pending Verification</p>
        </div>
        <div class="stat-icon warning">
            <i class="fas fa-clock"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>${{ number_format($stats['this_month'], 2) }}</h3>
            <p>This Month</p>
        </div>
        <div class="stat-icon info">
            <i class="fas fa-calendar"></i>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">All Donations</h3>
        <a href="{{ route('admin.donations.export') }}" class="btn btn-secondary">
            <i class="fas fa-download"></i> Export CSV
        </a>
    </div>

    <!-- Filters -->
    <div style="margin-bottom: 25px; padding: 20px; background: #f9fafb; border-radius: 12px;">
        <form action="{{ route('admin.donations.index') }}" method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; align-items: end;">
            <div>
                <label class="form-label">Search</label>
                <input type="text" 
                       name="search" 
                       class="form-control" 
                       placeholder="Donor name or email"
                       value="{{ request('search') }}">
            </div>

            <div>
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="pending_verification" {{ request('status') === 'pending_verification' ? 'selected' : '' }}>Pending Verification</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>

            <div>
                <label class="form-label">Payment Method</label>
                <select name="payment_method" class="form-control">
                    <option value="">All Methods</option>
                    <option value="card" {{ request('payment_method') === 'card' ? 'selected' : '' }}>Card</option>
                    <option value="mobile_money" {{ request('payment_method') === 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                    <option value="bank_transfer" {{ request('payment_method') === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="paypal" {{ request('payment_method') === 'paypal' ? 'selected' : '' }}>PayPal</option>
                </select>
            </div>

            <div>
                <label class="form-label">Date From</label>
                <input type="date" 
                       name="date_from" 
                       class="form-control"
                       value="{{ request('date_from') }}">
            </div>

            <div>
                <label class="form-label">Date To</label>
                <input type="date" 
                       name="date_to" 
                       class="form-control"
                       value="{{ request('date_to') }}">
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Donations Table -->
    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Donor</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                    <tr>
                        <td>
                            <code style="background: #f3f4f6; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem;">
                                {{ $donation->transaction_reference }}
                            </code>
                        </td>
                        <td>
                            <strong>{{ $donation->donor->full_name }}</strong><br>
                            <small style="color: #6b7280;">{{ $donation->donor->email }}</small>
                        </td>
                        <td><strong style="color: #10b981;">${{ number_format($donation->amount, 2) }}</strong></td>
                        <td>
                            <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $donation->donation_type)) }}</span>
                        </td>
                        <td>
                            <span class="badge badge-secondary">{{ ucfirst(str_replace('_', ' ', $donation->payment_method)) }}</span>
                        </td>
                        <td>
                            @if($donation->status === 'completed')
                                <span class="badge badge-success">Completed</span>
                            @elseif($donation->status === 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($donation->status === 'pending_verification')
                                <span class="badge badge-info">Pending Verification</span>
                            @else
                                <span class="badge badge-danger">{{ ucfirst($donation->status) }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $donation->created_at->format('M d, Y') }}<br>
                            <small style="color: #6b7280;">{{ $donation->created_at->format('H:i A') }}</small>
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.donations.show', $donation->id) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($donation->status === 'pending_verification')
                                    <button onclick="openVerifyModal({{ $donation->id }})" class="btn btn-sm btn-primary">
                                        <i class="fas fa-check"></i> Verify
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #6b7280;">
                            No donations found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="margin-top: 30px;">
        {{ $donations->links() }}
    </div>
</div>

<!-- Verify Modal -->
<div id="verifyModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 16px; padding: 30px; max-width: 500px; width: 90%;">
        <h3 style="margin-bottom: 20px; color: #1f2937;">Verify Donation</h3>
        
        <form id="verifyForm" method="POST">
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
    function openVerifyModal(donationId) {
        const modal = document.getElementById('verifyModal');
        const form = document.getElementById('verifyForm');
        form.action = `/admin/donations/${donationId}/verify`;
        modal.style.display = 'flex';
    }

    function closeVerifyModal() {
        document.getElementById('verifyModal').style.display = 'none';
    }

    // Close modal on outside click
    document.getElementById('verifyModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeVerifyModal();
        }
    });
</script>
@endpush
