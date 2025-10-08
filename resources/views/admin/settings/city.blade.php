@extends('layouts.admin')

@section('title', 'City Management')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <style>
    .filter-section {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    .filter-section .form-group {
        margin-bottom: 0.5rem;
    }
    .filter-buttons {
        margin-top: 1rem;
    }
    </style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">City Management</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCityModal">
                            <i class="fas fa-plus"></i> Add City
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

                    <!-- Filter Section -->
                    <div class="filter-section">
                        <h5 class="mb-3"><i class="fas fa-filter"></i> Filter by State</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="filter_state">Select State:</label>
                                    <select class="form-control" id="filter_state">
                                        <option value="">Show All Cities</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }} ({{ $state->country_name }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="button" class="btn btn-secondary" id="clear_filter">
                                            <i class="fas fa-times"></i> Clear Filter
                                        </button>
                                        <span id="filter_status" class="ml-2 text-muted"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="citiesTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>City Name</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Visible</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add City Modal -->
<div class="modal fade" id="addCityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New City</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.settings.city.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="state_id">State</label>
                        <select class="form-control" id="state_id" name="state_id" required>
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }} ({{ $state->country_name }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="existing_city_id">Existing City (Optional)</label>
                        <select class="form-control" id="existing_city_id" name="existing_city_id" disabled>
                            <option value="">Please select a state first</option>
                        </select>
                        <small class="form-text text-muted">Select a state to see existing cities, or create a new city below</small>
                    </div>
                    <div class="form-group">
                        <label for="city_master">City Name</label>
                        <input type="text" class="form-control" id="city_master" name="city_master" required>
                        <small class="form-text text-muted">Enter a new city name</small>
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
                    <button type="submit" class="btn btn-primary">Add City</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit City Modal -->
<div class="modal fade" id="editCityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit City</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editCityForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_state_id">State</label>
                        <select class="form-control" id="edit_state_id" name="state_id" required>
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }} ({{ $state->country_name }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_existing_city_id">Existing City (Optional)</label>
                        <select class="form-control" id="edit_existing_city_id" name="existing_city_id" disabled>
                            <option value="">Please select a state first</option>
                        </select>
                        <small class="form-text text-muted">Select a state to see existing cities, or create a new city below</small>
                    </div>
                    <div class="form-group">
                        <label for="edit_city_master">City Name</label>
                        <input type="text" class="form-control" id="edit_city_master" name="city_master" required>
                        <small class="form-text text-muted">Enter a new city name</small>
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
                    <button type="submit" class="btn btn-primary">Update City</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete City Modal -->
<div class="modal fade" id="deleteCityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete City</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this city? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteCityForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function() {
        // Initialize DataTable with AJAX
        var table = $('#citiesTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            language: {
                processing: "Loading...",
                emptyTable: "No cities found",
                zeroRecords: "No matching cities found"
            },
            ajax: {
                url: '{{ route('admin.settings.city') }}',
                type: 'GET',
                data: function(d) {
                    var stateFilter = $('#filter_state').val();
                    d.state_filter = stateFilter;
                    console.log('Sending filter data:', { state_filter: stateFilter });
                },
                error: function(xhr, error, thrown) {
                    console.error('DataTables AJAX Error:', error);
                    console.error('Response:', xhr.responseText);
                    console.error('Status:', xhr.status);
                    
                    // Show a user-friendly error message
                    $('#citiesTable tbody').html('<tr><td colspan="6" class="text-center text-danger">Error loading data. Please refresh the page or contact administrator.</td></tr>');
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'city_master', name: 'city_master' },
                { data: 'state_name', name: 'state_name' },
                { data: 'country_name', name: 'country_name' },
                {
                    data: 'is_visible',
                    name: 'is_visible',
                    render: function(data, type, row) {
                        return '<span class="badge badge-' + (data ? 'success' : 'warning') + '">' + (data ? 'Visible' : 'Hidden') + '</span>';
                    }
                },
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-sm btn-warning edit-btn" data-id="' + row.id + '" data-city_master="' + row.city_master + '" data-state_id="' + row.state_id + '" data-is_visible="' + row.is_visible + '"><i class="fas fa-edit"></i> Edit</button> ' +
                               '<button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' + row.id + '"><i class="fas fa-trash"></i> Delete</button>';
                    }
                }
            ]
        });

        // Update filter status display
        function updateFilterStatus() {
            var selectedValue = $('#filter_state').val();
            var selectedText = $('#filter_state option:selected').text();
            
            if (selectedValue) {
                $('#filter_status').html('<i class="fas fa-filter"></i> Filtered by: <strong>' + selectedText + '</strong>');
                $('#filter_status').removeClass('text-muted').addClass('text-info');
            } else {
                $('#filter_status').html('<i class="fas fa-globe"></i> Showing all cities');
                $('#filter_status').removeClass('text-info').addClass('text-muted');
            }
        }

        // Filter functionality
        $('#clear_filter').on('click', function() {
            $('#filter_state').val('');
            console.log('Clear filter clicked - showing all cities');
            updateFilterStatus();
            table.ajax.reload();
        });

        // Auto-apply filter when dropdown changes
        $('#filter_state').on('change', function() {
            var selectedValue = $(this).val();
            var selectedText = $(this).find('option:selected').text();
            
            if (selectedValue) {
                console.log('Filtering by: ' + selectedText + ' (ID: ' + selectedValue + ')');
            } else {
                console.log('Showing all cities (no filter selected)');
            }
            updateFilterStatus();
            table.ajax.reload();
        });

        // Initialize filter status on page load
        updateFilterStatus();

        // Dynamic dropdown functionality for Create modal
        $('#state_id').on('change', function() {
            var stateId = $(this).val();
            var citySelect = $('#existing_city_id');
            
            // Clear and disable city dropdown
            citySelect.empty().prop('disabled', true);
            
            if (stateId) {
                // Show loading state
                citySelect.append('<option value="">Loading...</option>');
                
                // Fetch cities via AJAX
                $.ajax({
                    url: '{{ route("admin.settings.cities.by-state", ":id") }}'.replace(':id', stateId),
                    type: 'GET',
                    success: function(response) {
                        citySelect.empty();
                        
                        if (response.success && response.data.length > 0) {
                            citySelect.append('<option value="">Select Existing City (Optional)</option>');
                            $.each(response.data, function(index, item) {
                                citySelect.append('<option value="' + item.id + '">' + item.city_master + '</option>');
                            });
                            citySelect.prop('disabled', false);
                        } else {
                            citySelect.append('<option value="">No cities found for this state</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        citySelect.empty();
                        citySelect.append('<option value="">Error loading cities</option>');
                        console.error('Error:', error);
                    }
                });
            } else {
                citySelect.append('<option value="">Please select a state first</option>');
            }
        });

        // Dynamic dropdown functionality for Edit modal
        $('#edit_state_id').on('change', function() {
            var stateId = $(this).val();
            var citySelect = $('#edit_existing_city_id');
            
            // Clear and disable city dropdown
            citySelect.empty().prop('disabled', true);
            
            if (stateId) {
                // Show loading state
                citySelect.append('<option value="">Loading...</option>');
                
                // Fetch cities via AJAX
                $.ajax({
                    url: '{{ route("admin.settings.cities.by-state", ":id") }}'.replace(':id', stateId),
                    type: 'GET',
                    success: function(response) {
                        citySelect.empty();
                        
                        if (response.success && response.data.length > 0) {
                            citySelect.append('<option value="">Select Existing City (Optional)</option>');
                            $.each(response.data, function(index, item) {
                                citySelect.append('<option value="' + item.id + '">' + item.city_master + '</option>');
                            });
                            citySelect.prop('disabled', false);
                        } else {
                            citySelect.append('<option value="">No cities found for this state</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        citySelect.empty();
                        citySelect.append('<option value="">Error loading cities</option>');
                        console.error('Error:', error);
                    }
                });
            } else {
                citySelect.append('<option value="">Please select a state first</option>');
            }
        });

        // Edit button click handler
        $('#citiesTable').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var cityMaster = $(this).data('city_master');
            var stateId = $(this).data('state_id');
            var isVisible = $(this).data('is_visible');

            $('#edit_city_master').val(cityMaster);
            $('#edit_state_id').val(stateId);
            $('#edit_is_visible').val(isVisible);
            
            // Trigger change event to load cities
            $('#edit_state_id').trigger('change');
            
            $('#editCityForm').attr('action', '/admin/settings/city/' + id);
            $('#editCityModal').modal('show');
        });

        // Delete button click handler
        $('#citiesTable').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            $('#deleteCityForm').attr('action', '/admin/settings/city/' + id);
        $('#deleteCityModal').modal('show');
        });

        // Reset form when modal is closed
        $('#addCityModal').on('hidden.bs.modal', function() {
            $('#addCityModal form')[0].reset();
            $('#existing_city_id').empty().prop('disabled', true).append('<option value="">Please select a state first</option>');
        });

        $('#editCityModal').on('hidden.bs.modal', function() {
            $('#editCityModal form')[0].reset();
            $('#edit_existing_city_id').empty().prop('disabled', true).append('<option value="">Please select a state first</option>');
        });
    });
    </script>
@endpush
