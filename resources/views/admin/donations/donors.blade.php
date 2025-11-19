<!-- resources/views/admin/donations/donors.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Donors Management')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">All Donors</h3>
        <div style="display: flex; gap: 10px;">
            <button onclick="exportDonors()" class="btn btn-secondary btn-sm">
                <i class="fas fa-download"></i> Export CSV
            </button>
        </div>
    </div>

    <!-- Search & Filter -->
    <div style="margin-bottom: 25px; padding: 20px; background: #f9fafb; border-radius: 12px;">
        <form action="{{ route('admin.donors.index') }}" method="GET" style="display: flex; gap: 15px; align-items: end; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px;">
                <label class="form-label">Search Donors</label>
                <input type="text" 
                       name="search" 
                       class="form-control" 
                       placeholder="Name or email"
                       value="{{ request('search') }}">
            </div>

            <div style="min-width: 200px;">
                <label class="form-label">Sort By</label>
                <select name="sort" class="form-control">
                    <option value="total_donated" {{ request('sort') === 'total_donated' ? 'selected' : '' }}>Highest Donation</option>
                    <option value="donation_count" {{ request('sort') === 'donation_count' ? 'selected' : '' }}>Most Donations</option>
                    <option value="recent" {{ request('sort') === 'recent' ? 'selected' : '' }}>Recent Donors</option>
                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                </select>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('admin.donors.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 25px; border-radius: 16px; color: white;">
            <div style="font-size: 2rem; font-weight: 900; margin-bottom: 5px;">
                {{ $donors->total() }}
            </div>
            <div style="opacity: 0.9;">Total Donors</div>
        </div>

        <div style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); padding: 25px; border-radius: 16px; color: white;">
            <div style="font-size: 2rem; font-weight: 900; margin-bottom: 5px;">
                ${{ number_format($donors->sum('total_donated'), 2) }}
            </div>
            <div style="opacity: 0.9;">Total Raised</div>
        </div>

        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 25px; border-radius: 16px; color: white;">
            <div style="font-size: 2rem; font-weight: 900; margin-bottom: 5px;">
                ${{ $donors->count() > 0 ? number_format($donors->sum('total_donated') / $donors->count(), 2) : '0.00' }}
            </div>
            <div style="opacity: 0.9;">Average Donation</div>
        </div>
    </div>

    <!-- Donors Table -->
    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Donor</th>
                    <th>Contact</th>
                    <th>Total Donated</th>
                    <th>Donations Count</th>
                    <th>Last Donation</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donors as $donor)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 45px; height: 45px; border-radius: 50%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.1rem;">
                                    {{ strtoupper(substr($donor->first_name, 0, 1)) }}{{ strtoupper(substr($donor->last_name, 0, 1)) }}
                                </div>
                                <div>
                                    <strong style="color: #1f2937;">{{ $donor->full_name }}</strong>
                                    @if($donor->donation_count >= 10)
                                        <span style="display: inline-block; margin-left: 8px;" title="VIP Donor">
                                            <i class="fas fa-crown" style="color: #f59e0b;"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.9rem;">
                                <div style="color: #4b5563; margin-bottom: 3px;">
                                    <i class="fas fa-envelope" style="color: #10b981; width: 16px;"></i>
                                    <a href="mailto:{{ $donor->email }}" style="color: #10b981;">{{ $donor->email }}</a>
                                </div>
                                @if($donor->phone)
                                <div style="color: #4b5563;">
                                    <i class="fas fa-phone" style="color: #10b981; width: 16px;"></i>
                                    <a href="tel:{{ $donor->phone }}" style="color: #10b981;">{{ $donor->phone }}</a>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <strong style="color: #10b981; font-size: 1.1rem;">
                                ${{ number_format($donor->total_donated, 2) }}
                            </strong>
                        </td>
                        <td>
                            <span style="background: #f3f4f6; padding: 6px 12px; border-radius: 20px; font-weight: 600; color: #4b5563;">
                                {{ $donor->donation_count }} {{ Str::plural('donation', $donor->donation_count) }}
                            </span>
                        </td>
                        <td>
                            @if($donor->last_donation_at)
                                <div style="font-size: 0.9rem;">
                                    <div style="color: #1f2937;">{{ $donor->last_donation_at->format('M d, Y') }}</div>
                                    <small style="color: #6b7280;">{{ $donor->last_donation_at->diffForHumans() }}</small>
                                </div>
                            @else
                                <span style="color: #6b7280;">-</span>
                            @endif
                        </td>
                        <td>
                            @if($donor->donation_count >= 10)
                                <span class="badge badge-warning">
                                    <i class="fas fa-star"></i> VIP
                                </span>
                            @elseif($donor->donation_count >= 5)
                                <span class="badge badge-success">
                                    <i class="fas fa-check"></i> Regular
                                </span>
                            @else
                                <span class="badge badge-info">
                                    <i class="fas fa-user"></i> New
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <button onclick="viewDonorDetails({{ $donor->id }})" class="btn btn-sm btn-primary" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="mailto:{{ $donor->email }}" class="btn btn-sm btn-secondary" title="Send Email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #6b7280;">
                            <i class="fas fa-users" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.3;"></i>
                            <p>No donors found</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="margin-top: 30px;">
        {{ $donors->links() }}
    </div>
</div>

<!-- Donor Details Modal -->
<div id="donorModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; overflow-y: auto; padding: 20px;">
    <div style="background: white; border-radius: 16px; padding: 0; max-width: 900px; width: 100%; max-height: 90vh; overflow-y: auto;">
        <div style="position: sticky; top: 0; background: white; padding: 25px; border-bottom: 2px solid #f3f4f6; display: flex; justify-content: space-between; align-items: center; border-radius: 16px 16px 0 0;">
            <h3 style="margin: 0; color: #1f2937;">Donor Details</h3>
            <button onclick="closeDonorModal()" style="background: none; border: none; font-size: 1.5rem; color: #6b7280; cursor: pointer; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div id="donorModalContent" style="padding: 30px;">
            <div style="text-align: center; padding: 40px; color: #6b7280;">
                <i class="fas fa-spinner fa-spin" style="font-size: 2rem;"></i>
                <p style="margin-top: 15px;">Loading donor information...</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function viewDonorDetails(donorId) {
        const modal = document.getElementById('donorModal');
        const content = document.getElementById('donorModalContent');
        
        modal.style.display = 'flex';
        
        // Fetch donor details via AJAX
        fetch(`/admin/donors/${donorId}`)
            .then(response => response.json())
            .then(data => {
                content.innerHTML = `
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
                        <!-- Donor Info Card -->
                        <div>
                            <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 30px; border-radius: 16px; color: white; text-align: center; margin-bottom: 20px;">
                                <div style="width: 80px; height: 80px; margin: 0 auto 15px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 900; border: 3px solid white;">
                                    ${data.first_name.charAt(0)}${data.last_name.charAt(0)}
                                </div>
                                <h3 style="margin-bottom: 10px;">${data.full_name}</h3>
                                ${data.donation_count >= 10 ? '<span style="background: rgba(245,158,11,0.3); padding: 6px 12px; border-radius: 20px; font-size: 0.9rem;"><i class="fas fa-crown"></i> VIP Donor</span>' : ''}
                            </div>

                            <div style="background: #f9fafb; padding: 20px; border-radius: 12px;">
                                <h4 style="margin-bottom: 15px; color: #1f2937;">Contact Information</h4>
                                <div style="display: flex; flex-direction: column; gap: 12px; font-size: 0.9rem;">
                                    <div>
                                        <i class="fas fa-envelope" style="color: #10b981; width: 20px;"></i>
                                        <a href="mailto:${data.email}" style="color: #10b981;">${data.email}</a>
                                    </div>
                                    ${data.phone ? `
                                        <div>
                                            <i class="fas fa-phone" style="color: #10b981; width: 20px;"></i>
                                            <a href="tel:${data.phone}" style="color: #10b981;">${data.phone}</a>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>

                            <div style="background: #f9fafb; padding: 20px; border-radius: 12px; margin-top: 20px;">
                                <h4 style="margin-bottom: 15px; color: #1f2937;">Donation Summary</h4>
                                <div style="display: flex; flex-direction: column; gap: 15px;">
                                    <div>
                                        <div style="color: #6b7280; font-size: 0.85rem; margin-bottom: 5px;">Total Donated</div>
                                        <div style="font-size: 1.8rem; font-weight: 900; color: #10b981;">$${parseFloat(data.total_donated).toFixed(2)}</div>
                                    </div>
                                    <div>
                                        <div style="color: #6b7280; font-size: 0.85rem; margin-bottom: 5px;">Total Donations</div>
                                        <div style="font-size: 1.5rem; font-weight: 700; color: #1f2937;">${data.donation_count}</div>
                                    </div>
                                    <div>
                                        <div style="color: #6b7280; font-size: 0.85rem; margin-bottom: 5px;">Average Donation</div>
                                        <div style="font-size: 1.2rem; font-weight: 700; color: #1f2937;">$${(parseFloat(data.total_donated) / data.donation_count).toFixed(2)}</div>
                                    </div>
                                    ${data.last_donation_at ? `
                                        <div>
                                            <div style="color: #6b7280; font-size: 0.85rem; margin-bottom: 5px;">Last Donation</div>
                                            <div style="font-weight: 600; color: #1f2937;">${new Date(data.last_donation_at).toLocaleDateString('en-US', {month: 'short', day: 'numeric', year: 'numeric'})}</div>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        </div>

                        <!-- Donations History -->
                        <div>
                            <h4 style="margin-bottom: 20px; color: #1f2937; font-size: 1.3rem;">Donation History</h4>
                            <div style="display: flex; flex-direction: column; gap: 15px; max-height: 500px; overflow-y: auto;">
                                ${data.donations.map(donation => `
                                    <div style="background: #f9fafb; padding: 20px; border-radius: 12px; border-left: 4px solid ${donation.status === 'completed' ? '#10b981' : '#f59e0b'};">
                                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                                            <div>
                                                <strong style="color: #1f2937; font-size: 1.1rem;">$${parseFloat(donation.amount).toFixed(2)}</strong>
                                                <span class="badge badge-${donation.status === 'completed' ? 'success' : 'warning'}" style="margin-left: 10px;">${donation.status}</span>
                                            </div>
                                            <div style="text-align: right; font-size: 0.85rem; color: #6b7280;">
                                                ${new Date(donation.created_at).toLocaleDateString('en-US', {month: 'short', day: 'numeric', year: 'numeric'})}
                                            </div>
                                        </div>
                                        <div style="font-size: 0.9rem; color: #6b7280;">
                                            <div style="margin-bottom: 5px;">
                                                <i class="fas fa-credit-card" style="width: 16px; color: #10b981;"></i>
                                                ${donation.payment_method.replace('_', ' ')}
                                            </div>
                                            <div>
                                                <i class="fas fa-hashtag" style="width: 16px; color: #10b981;"></i>
                                                ${donation.transaction_reference}
                                            </div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    </div>
                `;
            })
            .catch(error => {
                content.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: #ef4444;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 2rem; margin-bottom: 15px;"></i>
                        <p>Failed to load donor details</p>
                    </div>
                `;
            });
    }

    function closeDonorModal() {
        document.getElementById('donorModal').style.display = 'none';
    }

    // Close modal on outside click
    document.getElementById('donorModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDonorModal();
        }
    });

    function exportDonors() {
        window.location.href = '{{ route("admin.donors.export") }}?search={{ request("search") }}&sort={{ request("sort") }}';
    }
</script>
@endpush
