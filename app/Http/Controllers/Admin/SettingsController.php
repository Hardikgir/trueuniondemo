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
    public function highestEducation()
    {
        $highestEducations = DB::table('highest_qualification_master')->orderBy('name')->get();
        return view('admin.settings.highest-education', compact('highestEducations'));
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
    public function educationDetails()
    {
        $educationDetails = DB::table('education_master')
            ->join('highest_qualification_master', 'education_master.highest_qualification_id', '=', 'highest_qualification_master.id')
            ->select('education_master.*', 'highest_qualification_master.name as highest_qualification_name')
            ->orderBy('education_master.name')
            ->get();
        
        $highestQualifications = DB::table('highest_qualification_master')->where('status', 1)->get();
        
        return view('admin.settings.education-details', compact('educationDetails', 'highestQualifications'));
    }

    public function storeEducationDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'highest_qualification_id' => 'required|exists:highest_qualification_master,id',
            'status' => 'required|in:0,1',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('education_master')->insert([
            'name' => $request->name,
            'highest_qualification_id' => $request->highest_qualification_id,
            'status' => $request->status,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->back()->with('success', 'Education Details added successfully!');
    }

    public function updateEducationDetails(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'highest_qualification_id' => 'required|exists:highest_qualification_master,id',
            'status' => 'required|in:0,1',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('education_master')->where('id', $id)->update([
            'name' => $request->name,
            'highest_qualification_id' => $request->highest_qualification_id,
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
    public function state()
    {
        $states = DB::table('state_master')
            ->join('country_manage', 'state_master.country_id', '=', 'country_manage.id')
            ->select('state_master.*', 'country_manage.name as country_name')
            ->orderBy('state_master.name')
            ->get();
        
        $countries = DB::table('country_manage')->where('status', 1)->get();
        
        return view('admin.settings.state', compact('states', 'countries'));
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
     * City Management
     */
    public function city()
    {
        $cities = DB::table('city_master')
            ->join('state_master', 'city_master.state_id', '=', 'state_master.id')
            ->join('country_manage', 'state_master.country_id', '=', 'country_manage.id')
            ->select('city_master.*', 'state_master.name as state_name', 'country_manage.name as country_name')
            ->orderBy('city_master.city_master')
            ->get();
        
        $states = DB::table('state_master')
            ->join('country_manage', 'state_master.country_id', '=', 'country_manage.id')
            ->where('state_master.is_visible', 1)
            ->where('country_manage.status', 1)
            ->select('state_master.*', 'country_manage.name as country_name')
            ->get();
        
        return view('admin.settings.city', compact('cities', 'states'));
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
}
