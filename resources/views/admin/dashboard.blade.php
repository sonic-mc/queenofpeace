<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h3>${{ number_format($stats['total_donations'], 2) }}</h3>
            <p>Total Donations</p>
        </div>
        <div class="stat-icon success">
            <i class="fas fa-dollar-sign"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $stats['donations_count'] }}</h3>
            <p>Total Transactions</p>
        </div>
        <div class="stat-icon info">
            <i class="fas fa-receipt"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $stats['monthly_donors'] }}</h3>
            <p>Monthly Donors</p>
        </div>
        <div class="stat-icon warning">
            <i class="fas fa-heart"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $stats['pending_donations'] }}</h3>
            <p>Pending Verification</p>
        </div>
        <div class="stat-icon danger">
            <i class="fas fa-clock"></i>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-bottom: 30px;">
    <!-- Recent Donations -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Recent Donations</h3>
            <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-primary">View All</a>
        </div>

        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Donor</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentDonations as $donation)
                        <tr>
                            <td>
                                <strong>{{ $donation->donor->full_name }}</strong><br>
                                <small style="color: #6b7280;">{{ $donation->donor->email }}</small>
                            </td>
                            <td><strong>${{ number_format($donation->amount, 2) }}</strong></td>
                            <td>
                                <span class="badge badge-info">{{ ucfirst($donation->donation_type) }}</span>
                            </td>
                            <td>
                                @if($donation->status === 'completed')
                                    <span class="badge badge-success">Completed</span>
                                @elseif($donation->status === 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">{{ ucfirst($donation->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $donation->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #6b7280;">
                                No donations yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Top Donors -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Top Donors</h3>
        </div>

        <div style="display: flex; flex-direction: column; gap: 15px;">
            @forelse($topDonors as $donor)
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f9fafb; border-radius: 12px;">
                    <div>
                        <strong style="display: block; color: #1f2937;">{{ $donor->full_name }}</strong>
                        <small style="color: #6b7280;">{{ $donor->donation_count }} donations</small>
                    </div>
                    <div style="text-align: right;">
                        <strong style="color: #10b981; font-size: 1.1rem;">${{ number_format($donor->total_donated, 2) }}</strong>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 40px; color: #6b7280;">
                    No donors yet
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Monthly Trends Chart -->
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">Donation Trends (Last 12 Months)</h3>
    </div>

    <canvas id="donationChart" style="max-height: 300px;"></canvas>
</div>

<!-- Recent Activity -->
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">Recent Activity</h3>
    </div>

    <div style="display: flex; flex-direction: column; gap: 15px;">
        @forelse($recentActivity as $activity)
            <div style="display: flex; align-items: start; gap: 15px; padding: 15px; border-left: 3px solid 
                @if($activity['color'] === 'success') #10b981
                @elseif($activity['color'] === 'info') #3b82f6
                @elseif($activity['color'] === 'warning') #f59e0b
                @else #ef4444 @endif; background: #f9fafb; border-radius: 8px;">
                <div style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: 
                    @if($activity['color'] === 'success') rgba(16, 185, 129, 0.1)
                    @elseif($activity['color'] === 'info') rgba(59, 130, 246, 0.1)
                    @elseif($activity['color'] === 'warning') rgba(245, 158, 11, 0.1)
                    @else rgba(239, 68, 68, 0.1) @endif; color: 
                    @if($activity['color'] === 'success') #10b981
                    @elseif($activity['color'] === 'info') #3b82f6
                    @elseif($activity['color'] === 'warning') #f59e0b
                    @else #ef4444 @endif;">
                    <i class="fas {{ $activity['icon'] }}"></i>
                </div>
                <div style="flex: 1;">
                    <div style="color: #1f2937; font-weight: 600;">{{ $activity['message'] }}</div>
                    <small style="color: #6b7280;">{{ $activity['time']->diffForHumans() }}</small>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 40px; color: #6b7280;">
                No recent activity
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Donation Trends Chart
    const ctx = document.getElementById('donationChart');
    
    const monthlyData = @json($monthlyTrends);
    
    const labels = monthlyData.map(item => {
        const date = new Date(item.month + '-01');
        return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
    });
    
    const data = monthlyData.map(item => item.total);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Donations ($)',
                data: data,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
