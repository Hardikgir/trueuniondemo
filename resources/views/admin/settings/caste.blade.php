@extends('layouts.admin')

@section('title', 'Caste Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title">Caste Management</h3>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCasteModal">
                            <i class="fas fa-plus"></i> Add Caste
                        </button>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <label for="entriesPerPage" class="mr-2">Show</label>
                            <select id="entriesPerPage" class="form-control d-inline-block w-auto mr-2">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span>entries</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <label for="searchInput" class="mr-2">Search:</label>
                            <input type="text" id="searchInput" class="form-control d-inline-block w-auto" placeholder="Search castes...">
                        </div>
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
                        <table id="casteTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($castes as $caste)
                                <tr>
                                    <td>{{ $caste->id }}</td>
                                    <td>{{ $caste->title }}</td>
                                    <td>
                                        <span class="badge badge-{{ $caste->status ? 'success' : 'danger' }}">
                                            {{ $caste->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $caste->created_at ? \Carbon\Carbon::parse($caste->created_at)->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                            onclick="editCaste({{ $caste->id }}, '{{ addslashes($caste->title) }}', {{ $caste->status }})">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="deleteCaste({{ $caste->id }})">
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

<!-- Add Caste Modal -->
<div class="modal fade" id="addCasteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Caste</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('admin.settings.caste.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Caste Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Caste</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Caste Modal -->
<div class="modal fade" id="editCasteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Caste</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="editCasteForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_title">Caste Title</label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Caste</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Caste Modal -->
<div class="modal fade" id="deleteCasteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Caste</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this caste? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteCasteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@endpush

@push('scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#casteTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "searching": false, // Disable default search since we have custom search
        "lengthChange": false, // Disable default length change since we have custom control
        "info": true,
        "paging": true,
        "language": {
            "lengthMenu": "Show _MENU_ entries per page"
        }
    });

    // Custom search functionality
    $('#searchInput').on('keyup', function () {
        table.search(this.value).draw();
    });

    // Custom entries per page functionality
    $('#entriesPerPage').on('change', function () {
        table.page.len(parseInt(this.value)).draw();
    });
});

// Edit Modal setup
function editCaste(id, title, status) {
    $('#edit_title').val(title);
    $('#edit_status').val(status);
    $('#editCasteForm').attr('action', '/admin/settings/caste/' + id);
    $('#editCasteModal').modal('show');
}

// Delete Modal setup
function deleteCaste(id) {
    $('#deleteCasteForm').attr('action', '/admin/settings/caste/' + id);
    $('#deleteCasteModal').modal('show');
}
</script>
@endpush
@endsection
