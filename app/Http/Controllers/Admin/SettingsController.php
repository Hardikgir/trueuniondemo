<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display the settings dashboard
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Language Management
     */
    public function language()
    {
        $languages = DB::table('mothertongue_master')->orderBy('title')->get();
        return view('admin.settings.language', compact('languages'));
    }

    public function storeLanguage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('mothertongue_master')->insert([
            'title' => $request->title,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Language added successfully!');
    }

    public function updateLanguage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('mothertongue_master')->where('id', $id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Language updated successfully!');
    }

    public function deleteLanguage($id)
    {
        DB::table('mothertongue_master')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Language deleted successfully!');
    }

    /**
     * Caste Management
     */
    public function caste()
    {
        $castes = DB::table('caste_master')->orderBy('title')->get();
        return view('admin.settings.caste', compact('castes'));
    }

    public function storeCaste(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('caste_master')->insert([
            'title' => $request->title,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Caste added successfully!');
    }

    public function updateCaste(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('caste_master')->where('id', $id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Caste updated successfully!');
    }

    public function deleteCaste($id)
    {
        DB::table('caste_master')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Caste deleted successfully!');
    }

    /**
     * Highest Education Management
     */
    public function highestEducation(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('highest_qualification_master')->select('id', 'name', 'status', 'is_visible');

            // Search functionality
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchValue = $request->input('search')['value'];
                $data->where('name', 'like', '%' . $searchValue . '%');
            }

            $totalRecords = $data->count();

            // Pagination
            if ($request->has('start') && $request->has('length')) {
                $start = $request->input('start');
                $length = $request->input('length');
                if ($length != -1) {
                    $data->offset($start)->limit($length);
                }
            }

            $records = $data->get();
            $draw = $request->input('draw');

            return response()->json([
                'draw' => intval($draw),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $records,
            ]);
        }

        return view('admin.settings.highest-education');
    }

    public function storeHighestEducation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('highest_qualification_master')->insert([
            'name' => $request->name,
            'status' => $request->status,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'Highest Education added successfully!');
    }

    public function updateHighestEducation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('highest_qualification_master')->where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'Highest Education updated successfully!');
    }

    public function deleteHighestEducation($id)
    {
        DB::table('highest_qualification_master')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Highest Education deleted successfully!');
    }

    /**
     * Education Details Management
     */
    public function educationDetails(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('education_master')
                ->join('highest_qualification_master', 'education_master.highest_qualification_id', '=', 'highest_qualification_master.id')
                ->select('education_master.id', 'education_master.name', 'highest_qualification_master.name as highest_qualification_name', 'education_master.status', 'education_master.is_visible', 'education_master.highest_qualification_id');

            // Filter by Highest Qualification only
            if ($request->has('highest_qualification_filter') && !empty($request->input('highest_qualification_filter'))) {
                $data->where('education_master.highest_qualification_id', $request->input('highest_qualification_filter'));
            }

            // Search functionality
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchValue = $request->input('search')['value'];
                $data->where(function($query) use ($searchValue) {
                    $query->where('education_master.name', 'like', '%' . $searchValue . '%')
                          ->orWhere('highest_qualification_master.name', 'like', '%' . $searchValue . '%');
                });
            }

            $totalRecords = $data->count();

            // Pagination
            if ($request->has('start') && $request->has('length')) {
                $start = $request->input('start');
                $length = $request->input('length');
                if ($length != -1) {
                    $data->offset($start)->limit($length);
                }
            }

            $records = $data->get();
            $draw = $request->input('draw');

            return response()->json([
                'draw' => intval($draw),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $records,
            ]);
        }

        $highestQualifications = DB::table('highest_qualification_master')->where('status', 1)->get();
        return view('admin.settings.education-details', compact('highestQualifications'));
    }

    public function storeEducationDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'highest_education_id' => 'required|exists:highest_qualification_master,id',
            'education_details_id' => 'nullable|exists:education_master,id',
            'status' => 'required|in:0,1',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If education_details_id is provided, we're creating a new education detail based on an existing one
        if ($request->education_details_id) {
            // Get the existing education detail
            $existingEducation = DB::table('education_master')->where('id', $request->education_details_id)->first();
            
            // Create a new education detail based on the selected one
            DB::table('education_master')->insert([
                'name' => $request->name,
                'highest_qualification_id' => $request->highest_education_id,
                'status' => $request->status,
                'is_visible' => $request->is_visible
            ]);
        } else {
            // Create a new education detail from scratch
            DB::table('education_master')->insert([
                'name' => $request->name,
                'highest_qualification_id' => $request->highest_education_id,
                'status' => $request->status,
                'is_visible' => $request->is_visible
            ]);
        }

        return redirect()->back()->with('success', 'Education Details added successfully!');
    }

    public function updateEducationDetails(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'highest_education_id' => 'required|exists:highest_qualification_master,id',
            'education_details_id' => 'nullable|exists:education_master,id',
            'status' => 'required|in:0,1',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('education_master')->where('id', $id)->update([
            'name' => $request->name,
            'highest_qualification_id' => $request->highest_education_id,
            'status' => $request->status,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'Education Details updated successfully!');
    }

    public function deleteEducationDetails($id)
    {
        DB::table('education_master')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Education Details deleted successfully!');
    }

    /**
     * Get Education Details by Highest Qualification ID (AJAX)
     */
    public function getEducationDetailsByQualification($qualificationId)
    {
        try {
            $educationDetails = DB::table('education_master')
                ->where('highest_qualification_id', $qualificationId)
                ->where('status', 1)
                ->where('is_visible', 1)
                ->select('id', 'name')
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $educationDetails
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching education details: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Occupation Management
     */
    public function occupation()
    {
        $occupations = DB::table('occupation_master')->orderBy('name')->get();
        return view('admin.settings.occupation', compact('occupations'));
    }

    public function storeOccupation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('occupation_master')->insert([
            'name' => $request->name,
            'status' => $request->status,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'Occupation added successfully!');
    }

    public function updateOccupation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('occupation_master')->where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'Occupation updated successfully!');
    }

    public function deleteOccupation($id)
    {
        DB::table('occupation_master')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Occupation deleted successfully!');
    }

    /**
     * Country Management
     */
    public function country()
    {
        $countries = DB::table('country_manage')->orderBy('name')->get();
        return view('admin.settings.country', compact('countries'));
    }

    public function storeCountry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'sortname' => 'required|string|max:3',
            'phone_code' => 'required|string|max:11',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('country_manage')->insert([
            'name' => $request->name,
            'sortname' => $request->sortname,
            'phone_code' => $request->phone_code,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Country added successfully!');
    }

    public function updateCountry(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'sortname' => 'required|string|max:3',
            'phone_code' => 'required|string|max:11',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('country_manage')->where('id', $id)->update([
            'name' => $request->name,
            'sortname' => $request->sortname,
            'phone_code' => $request->phone_code,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Country updated successfully!');
    }

    public function deleteCountry($id)
    {
        DB::table('country_manage')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Country deleted successfully!');
    }

    /**
     * State Management
     */
    public function state(Request $request)
    {
        if ($request->ajax()) {
            try {
                // Check if tables exist and have data
                $stateCount = DB::table('state_master')->count();
                $countryCount = DB::table('country_manage')->count();
                
                if ($stateCount == 0) {
                    // Create some sample data if tables are empty
                    if ($countryCount == 0) {
                        // Create sample country
                        $countryId = DB::table('country_manage')->insertGetId([
                            'name' => 'India',
                            'sortname' => 'IN',
                            'phone_code' => '+91',
                            'status' => 1,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        
                        // Create sample states
                        DB::table('state_master')->insert([
                            [
                                'name' => 'Gujarat',
                                'country_id' => $countryId,
                                'is_visible' => 1,
                                'created_at' => now(),
                                'updated_at' => now()
                            ],
                            [
                                'name' => 'Maharashtra',
                                'country_id' => $countryId,
                                'is_visible' => 1,
                                'created_at' => now(),
                                'updated_at' => now()
                            ],
                            [
                                'name' => 'Rajasthan',
                                'country_id' => $countryId,
                                'is_visible' => 1,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]
                        ]);
                    }
                    
                    return response()->json([
                        'draw' => intval($request->input('draw', 1)),
                        'recordsTotal' => 0,
                        'recordsFiltered' => 0,
                        'data' => [],
                        'message' => 'No states found. Sample data created. Please refresh the page.'
                    ]);
                }

                $query = DB::table('state_master')
                    ->join('country_manage', 'state_master.country_id', '=', 'country_manage.id')
                    ->select('state_master.id', 'state_master.name', 'country_manage.name as country_name', 'state_master.is_visible', 'state_master.country_id');

                // Filter by Country
                $countryFilter = $request->input('country_filter');
                \Log::info('Country filter received:', ['country_filter' => $countryFilter]);
                
                if (!empty($countryFilter)) {
                    $query->where('state_master.country_id', $countryFilter);
                    \Log::info('Applied country filter:', ['country_id' => $countryFilter]);
                } else {
                    \Log::info('No country filter applied - showing all states');
                }

                // Get total records before filtering
                $totalRecords = DB::table('state_master')
                    ->join('country_manage', 'state_master.country_id', '=', 'country_manage.id')
                    ->count();

                // Search functionality
                if ($request->has('search') && !empty($request->input('search')['value'])) {
                    $searchValue = $request->input('search')['value'];
                    $query->where(function($q) use ($searchValue) {
                        $q->where('state_master.name', 'like', '%' . $searchValue . '%')
                          ->orWhere('country_manage.name', 'like', '%' . $searchValue . '%');
                    });
                }

                // Get filtered count
                $filteredRecords = $query->count();

                // Pagination
                $start = $request->input('start', 0);
                $length = $request->input('length', 10);
                
                if ($length != -1) {
                    $query->offset($start)->limit($length);
                }

                $records = $query->orderBy('state_master.name')->get();
                $draw = $request->input('draw', 1);

                return response()->json([
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                    'data' => $records,
                ]);
            } catch (\Exception $e) {
                \Log::error('State AJAX Error: ' . $e->getMessage());
                return response()->json([
                    'draw' => intval($request->input('draw', 1)),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'error' => 'Error loading data: ' . $e->getMessage()
                ], 500);
            }
        }

        $countries = DB::table('country_manage')->where('status', 1)->get();
        return view('admin.settings.state', compact('countries'));
    }

    public function storeState(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'country_id' => 'required|exists:country_manage,id',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('state_master')->insert([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'State added successfully!');
    }

    public function updateState(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'country_id' => 'required|exists:country_manage,id',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('state_master')->where('id', $id)->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'State updated successfully!');
    }

    public function deleteState($id)
    {
        DB::table('state_master')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'State deleted successfully!');
    }

    /**
     * Get States by Country ID (AJAX)
     */
    public function getStatesByCountry($countryId)
    {
        try {
            $states = DB::table('state_master')
                ->where('country_id', $countryId)
                ->where('is_visible', 1)
                ->select('id', 'name')
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $states
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching states: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * City Management
     */
    public function city(Request $request)
    {
        if ($request->ajax()) {
            try {
                // Check if tables exist and have data
                $cityCount = DB::table('city_master')->count();
                $stateCount = DB::table('state_master')->count();
                
                if ($cityCount == 0) {
                    // Create some sample data if tables are empty
                    if ($stateCount == 0) {
                        // Create sample country first
                        $countryId = DB::table('country_manage')->insertGetId([
                            'name' => 'India',
                            'sortname' => 'IN',
                            'phone_code' => '+91',
                            'status' => 1,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        
                        // Create sample state
                        $stateId = DB::table('state_master')->insertGetId([
                            'name' => 'Gujarat',
                            'country_id' => $countryId,
                            'is_visible' => 1,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        
                        // Create sample cities
                        DB::table('city_master')->insert([
                            [
                                'city_master' => 'Ahmedabad',
                                'state_id' => $stateId,
                                'is_visible' => 1,
                                'created_at' => now(),
                                'updated_at' => now()
                            ],
                            [
                                'city_master' => 'Surat',
                                'state_id' => $stateId,
                                'is_visible' => 1,
                                'created_at' => now(),
                                'updated_at' => now()
                            ],
                            [
                                'city_master' => 'Vadodara',
                                'state_id' => $stateId,
                                'is_visible' => 1,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]
                        ]);
                    }
                    
                    return response()->json([
                        'draw' => intval($request->input('draw', 1)),
                        'recordsTotal' => 0,
                        'recordsFiltered' => 0,
                        'data' => [],
                        'message' => 'No cities found. Sample data created. Please refresh the page.'
                    ]);
                }

                $query = DB::table('city_master')
                    ->join('state_master', 'city_master.state_id', '=', 'state_master.id')
                    ->join('country_manage', 'state_master.country_id', '=', 'country_manage.id')
                    ->select('city_master.id', 'city_master.city_master', 'state_master.name as state_name', 'country_manage.name as country_name', 'city_master.is_visible', 'city_master.state_id');

                // Filter by State
                $stateFilter = $request->input('state_filter');
                \Log::info('State filter received:', ['state_filter' => $stateFilter]);
                
                if (!empty($stateFilter)) {
                    $query->where('city_master.state_id', $stateFilter);
                    \Log::info('Applied state filter:', ['state_id' => $stateFilter]);
                } else {
                    \Log::info('No state filter applied - showing all cities');
                }

                // Get total records before filtering
                $totalRecords = DB::table('city_master')
                    ->join('state_master', 'city_master.state_id', '=', 'state_master.id')
                    ->join('country_manage', 'state_master.country_id', '=', 'country_manage.id')
                    ->count();

                // Search functionality
                if ($request->has('search') && !empty($request->input('search')['value'])) {
                    $searchValue = $request->input('search')['value'];
                    $query->where(function($q) use ($searchValue) {
                        $q->where('city_master.city_master', 'like', '%' . $searchValue . '%')
                          ->orWhere('state_master.name', 'like', '%' . $searchValue . '%')
                          ->orWhere('country_manage.name', 'like', '%' . $searchValue . '%');
                    });
                }

                // Get filtered count
                $filteredRecords = $query->count();

                // Pagination
                $start = $request->input('start', 0);
                $length = $request->input('length', 10);
                
                if ($length != -1) {
                    $query->offset($start)->limit($length);
                }

                $records = $query->orderBy('city_master.city_master')->get();
                $draw = $request->input('draw', 1);

                return response()->json([
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                    'data' => $records,
                ]);
            } catch (\Exception $e) {
                \Log::error('City AJAX Error: ' . $e->getMessage());
                return response()->json([
                    'draw' => intval($request->input('draw', 1)),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'error' => 'Error loading data: ' . $e->getMessage()
                ], 500);
            }
        }

        $states = DB::table('state_master')
            ->join('country_manage', 'state_master.country_id', '=', 'country_manage.id')
            ->where('state_master.is_visible', 1)
            ->where('country_manage.status', 1)
            ->select('state_master.*', 'country_manage.name as country_name')
            ->get();
        
        return view('admin.settings.city', compact('states'));
    }

    public function storeCity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_master' => 'required|string|max:100',
            'state_id' => 'required|exists:state_master,id',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('city_master')->insert([
            'city_master' => $request->city_master,
            'state_id' => $request->state_id,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'City added successfully!');
    }

    public function updateCity(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'city_master' => 'required|string|max:100',
            'state_id' => 'required|exists:state_master,id',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('city_master')->where('id', $id)->update([
            'city_master' => $request->city_master,
            'state_id' => $request->state_id,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'City updated successfully!');
    }

    public function deleteCity($id)
    {
        DB::table('city_master')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'City deleted successfully!');
    }

    /**
     * Get Cities by State ID (AJAX)
     */
    public function getCitiesByState($stateId)
    {
        try {
            $cities = DB::table('city_master')
                ->where('state_id', $stateId)
                ->where('is_visible', 1)
                ->select('id', 'city_master')
                ->orderBy('city_master')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $cities
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching cities: ' . $e->getMessage()
            ], 500);
        }
    }
}