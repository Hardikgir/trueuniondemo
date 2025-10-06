@extends('layouts.admin')

@section('title', 'Education Details Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Education Details Management</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEducationDetailsModal">
                            <i class="fas fa-plus"></i> Add Education Details
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Highest Qualification</th>
                                    <th>Status</th>
                                    <th>Visible</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($educationDetails as $detail)
                                <tr>
                                    <td>{{ $detail->id }}</td>
                                    <td>{{ $detail->name }}</td>
                                    <td>{{ $detail->highest_qualification_name }}</td>
                                    <td>
                                        <span class="badge badge-{{ $detail->status ? 'success' : 'danger' }}">
                                            {{ $detail->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $detail->is_visible ? 'success' : 'warning' }}">
                                            {{ $detail->is_visible ? 'Visible' : 'Hidden' }}
                                        </span>
                                    </td>
                                    <td>{{ isset($detail->created_at) && $detail->created_at ? \Carbon\Carbon::parse($detail->created_at)->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" onclick="editEducationDetails({{ $detail->id }}, '{{ addslashes($detail->name) }}', {{ $detail->highest_qualification_id }}, {{ $detail->status }}, {{ $detail->is_visible }})">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteEducationDetails({{ $detail->id }})">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Education Details Modal -->
<div class="modal fade" id="addEducationDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Education Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.settings.education-details.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Education Details Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="highest_qualification_id">Highest Qualification</label>
                        <select class="form-control" id="highest_qualification_id" name="highest_qualification_id" required>
                            <option value="">Select Highest Qualification</option>
                            @foreach($highestQualifications as $qualification)
                                <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_visible">Visibility</label>
                        <select class="form-control" id="is_visible" name="is_visible" required>
                            <option value="1">Visible</option>
                            <option value="0">Hidden</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Education Details</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Education Details Modal -->
<div class="modal fade" id="editEducationDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Education Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editEducationDetailsForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Education Details Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_highest_qualification_id">Highest Qualification</label>
                        <select class="form-control" id="edit_highest_qualification_id" name="highest_qualification_id" required>
                            <option value="">Select Highest Qualification</option>
                            @foreach($highestQualifications as $qualification)
                                <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_is_visible">Visibility</label>
                        <select class="form-control" id="edit_is_visible" name="is_visible" required>
                            <option value="1">Visible</option>
                            <option value="0">Hidden</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Education Details</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Education Details Modal -->
<div class="modal fade" id="deleteEducationDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Education Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this education details? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteEducationDetailsForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function editEducationDetails(id, name, highestQualificationId, status, isVisible) {
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_highest_qualification_id').value = highestQualificationId;
    document.getElementById('edit_status').value = status;
    document.getElementById('edit_is_visible').value = isVisible;
    document.getElementById('editEducationDetailsForm').action = '/admin/settings/education-details/' + id;
    $('#editEducationDetailsModal').modal('show');
}

function deleteEducationDetails(id) {
    document.getElementById('deleteEducationDetailsForm').action = '/admin/settings/education-details/' + id;
    $('#deleteEducationDetailsModal').modal('show');
}
</script>
@endsection
