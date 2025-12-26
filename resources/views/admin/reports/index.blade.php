@extends('layouts.admin')

@section('title', 'User Reports')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Reports</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bulkUpdateModal">
                <i class="fas fa-tasks"></i> Bulk Update
            </button>
        </div>
    </div>
    <div class="card-body">
        <!-- Filters -->
        <form method="GET" action="{{ route('admin.reports.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="dismissed" {{ request('status') == 'dismissed' ? 'selected' : '' }}>Dismissed</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Reason</label>
                        <select name="reason" class="form-control">
                            <option value="">All Reasons</option>
                            <option value="spam_scam" {{ request('reason') == 'spam_scam' ? 'selected' : '' }}>Spam/Scam</option>
                            <option value="harassment" {{ request('reason') == 'harassment' ? 'selected' : '' }}>Harassment</option>
                            <option value="inappropriate_photos" {{ request('reason') == 'inappropriate_photos' ? 'selected' : '' }}>Inappropriate Photos</option>
                            <option value="underage" {{ request('reason') == 'underage' ? 'selected' : '' }}>Underage</option>
                            <option value="other" {{ request('reason') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Reports Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="30">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>ID</th>
                        <th>Reporter</th>
                        <th>Reported User</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Block Requested</th>
                        <th>Reported On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td>
                                <input type="checkbox" class="report-checkbox" name="report_ids[]" value="{{ $report->id }}">
                            </td>
                            <td>{{ $report->id }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $report->reporter_id) }}">
                                    {{ $report->reporter->full_name ?? 'N/A' }}
                                </a>
                                <br>
                                <small class="text-muted">{{ $report->reporter->email ?? '' }}</small>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.show', $report->reported_user_id) }}">
                                    {{ $report->reportedUser->full_name ?? 'N/A' }}
                                </a>
                                <br>
                                <small class="text-muted">{{ $report->reportedUser->email ?? '' }}</small>
                            </td>
                            <td>
                                @php
                                    $reasonLabels = [
                                        'spam_scam' => 'Spam/Scam',
                                        'harassment' => 'Harassment',
                                        'inappropriate_photos' => 'Inappropriate Photos',
                                        'underage' => 'Underage',
                                        'other' => 'Other'
                                    ];
                                @endphp
                                <span class="badge badge-warning">{{ $reasonLabels[$report->reason] ?? ucfirst($report->reason) }}</span>
                            </td>
                            <td>
                                @if($report->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($report->status == 'reviewed')
                                    <span class="badge badge-info">Reviewed</span>
                                @elseif($report->status == 'resolved')
                                    <span class="badge badge-success">Resolved</span>
                                @elseif($report->status == 'dismissed')
                                    <span class="badge badge-secondary">Dismissed</span>
                                @endif
                            </td>
                            <td>
                                @if($report->block_user)
                                    <span class="badge badge-danger">Yes</span>
                                @else
                                    <span class="badge badge-secondary">No</span>
                                @endif
                            </td>
                            <td>{{ $report->created_at->format('d M, Y h:i A') }}</td>
                            <td>
                                <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No reports found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer clearfix">
        {{ $reports->links() }}
    </div>
</div>

<!-- Bulk Update Modal -->
<div class="modal fade" id="bulkUpdateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.reports.bulk-update') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Bulk Update Reports</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Reports</label>
                        <p class="text-muted">Select reports using checkboxes in the table above.</p>
                    </div>
                    <div class="form-group">
                        <label>New Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="reviewed">Reviewed</option>
                            <option value="resolved">Resolved</option>
                            <option value="dismissed">Dismissed</option>
                        </select>
                    </div>
                    <div id="selectedReports"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Selected</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Select all checkbox
    $('#selectAll').on('change', function() {
        $('.report-checkbox').prop('checked', this.checked);
        updateSelectedReports();
    });

    // Individual checkbox change
    $('.report-checkbox').on('change', function() {
        updateSelectedReports();
        $('#selectAll').prop('checked', $('.report-checkbox:checked').length === $('.report-checkbox').length);
    });

    // Update selected reports display
    function updateSelectedReports() {
        var selected = $('.report-checkbox:checked').map(function() {
            return '<input type="hidden" name="report_ids[]" value="' + $(this).val() + '">';
        }).get().join('');
        $('#selectedReports').html(selected);
    }

    // Bulk update form submission
    $('#bulkUpdateModal form').on('submit', function(e) {
        var selectedCount = $('.report-checkbox:checked').length;
        if (selectedCount === 0) {
            e.preventDefault();
            alert('Please select at least one report.');
            return false;
        }
    });
});
</script>
@endpush

@endsection

