<?php

namespace App\Http\Controllers;

use App\Chemical;
use App\JobSource;
use App\LicenceDescription;
use App\NeighbouringSuburb;
use App\Section;
use App\StandardJob;
use App\StandardJobTask;
use App\StandardTask;
use App\Street;
use App\Suburb;
use App\TechnicianType;
use App\Title;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;

class EditLookupsController extends Controller
{
    // List of suburbs
    public function suburbs()
    {
        // Get suburbs
        $suburbs = Suburb::all();

        return view('lookups.suburbs', compact('suburbs'));
    }

    // Ajax handler for saving suburbs record
    public function ajax_save_suburbs()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Suburb
        if (empty($index)) {
            // Create new Suburb, if this locality is already used, throw the error
            try {
                Suburb::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Suburb
            $suburb = Suburb::where('postcode', $index)->first();

            // Update Suburb, if this locality is already used, throw the error
            try {
                $suburb->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting suburbs record
    public function ajax_delete_suburbs()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Suburb
        $suburb = Suburb::where('postcode', $index)->first();

        // Delete Suburb
        try {
            $suburb->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Neighbouring Suburbs
    public function neighbouring_suburbs()
    {
        // Get Suburbs
        $suburbs = Suburb::all();

        return view('lookups.neighbouring-suburbs', compact('suburbs'));
    }

    // Ajax handler for uploading Neighbouring Suburbs of particular Suburb
    public function ajax_upload_neighbouring_suburbs()
    {
        // Get parameters
        $suburb_id = Input::get('suburb_id');

        // Get Neighbouring Suburbs
        $neighbouring_suburbs = NeighbouringSuburb::select('suburbs.locality')
            ->join('suburbs', 'suburbs.id', '=', 'neighbouring_suburbs.neighbour_suburb_id')
            ->where('suburb_id', $suburb_id)->get();

        // Get list of all suburbs apart from current one
        $suburbs = Suburb::select('locality')->where('id', '<>', $suburb_id)->get();

        return json_encode(['neighbour' => $neighbouring_suburbs, 'suburbs' => $suburbs]);
    }

    // Ajax handler for saving neighbouring suburbs record
    public function ajax_save_neighbouring_suburbs()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];
        $suburb_id = $input['suburb_id'];
        $name = $input['name'];

        $neighbour_suburb_id = Suburb::select('id')->where('locality', $name)->first()->id;

        // Save Neighbouring Suburb
        if (empty($index)) {
            // Create new Neighbouring Suburb
            $records = NeighbouringSuburb::select('id')->where('suburb_id', $suburb_id)->where('neighbour_suburb_id', $neighbour_suburb_id)->get();
            if (count($records) == 0) {
                NeighbouringSuburb::create(['suburb_id' => $suburb_id, 'neighbour_suburb_id' => $neighbour_suburb_id]);
            } else {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Neighbouring Suburb
            $index_id = Suburb::select('id')->where('locality', $index)->first()->id;
            $neighbouring_suburb = NeighbouringSuburb::where('neighbour_suburb_id', $index_id)->where('suburb_id', $suburb_id)->first();

            // Update Neighbouring Suburb
            $records = NeighbouringSuburb::select('id')->where('suburb_id', $suburb_id)->where('neighbour_suburb_id', $neighbour_suburb_id)->get();
            if (count($records) == 0) {
                $neighbouring_suburb->update(['neighbour_suburb_id' => $neighbour_suburb_id]);
            } else {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting neighbouring suburb record
    public function ajax_delete_neighbouring_suburbs()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];
        $suburb_id = $input['suburb_id'];
        $index_id = Suburb::select('id')->where('locality', $index)->first()->id;

        // Find deleting Neighbouring Suburb
        $neighbouring_suburb = NeighbouringSuburb::where('neighbour_suburb_id', $index_id)->where('suburb_id', $suburb_id)->first();

        // Delete Street
        try {
            $neighbouring_suburb->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Streets
    public function streets()
    {
        // Get Suburbs
        $suburbs = Suburb::all();

        return view('lookups.streets', compact('suburbs'));
    }

    // Ajax handler for uploading Streets of particular Suburb
    public function ajax_upload_streets()
    {
        // Get parameters
        $suburb_id = Input::get('suburb');

        // Get Streets
        $streets = Street::select('name')->where('suburb_id', $suburb_id)->get();

        return json_encode($streets);
    }

    // Ajax handler for saving streets record
    public function ajax_save_streets()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];
        $suburb_id = $input['suburb_id'];

        // Save Street
        if (empty($index)) {
            // Create new Street
            try {
                Street::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Street
            $street = Street::where('name', $index)->where('suburb_id', $suburb_id)->first();

            // Update Street
            try {
                $street->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting street record
    public function ajax_delete_streets()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];
        $suburb_id = $input['suburb_id'];

        // Find deleting Street
        $street = Street::where('name', $index)->where('suburb_id', $suburb_id)->first();

        // Delete Street
        try {
            $street->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of technician types
    public function technician_types()
    {
        // Get technician types
        $technician_types = TechnicianType::all();

        return view('lookups.technician-types', compact('technician_types'));
    }

    // Ajax handler for saving technician types record
    public function ajax_save_technician_types()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Technician Type
        if (empty($index)) {
            // Create new Technician Type, if this type is already used, throw the error
            try {
                TechnicianType::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Technician Type
            $technician_type = TechnicianType::where('name', $index)->first();

            // Update Technician Type, if this type is already used, throw the error
            try {
                $technician_type->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Technician Type record
    public function ajax_delete_technician_types()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Technician Type
        $technician_type = TechnicianType::where('name', $index)->first();

        // Delete Technician Type
        try {
            $technician_type->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Licence Descriptions
    public function licence_description()
    {
        // Get Licence Descriptions
        $licence_descriptions = LicenceDescription::all();

        return view('lookups.licence-descriptions', compact('licence_descriptions'));
    }

    // Ajax handler for saving licence description record
    public function ajax_save_licence_description()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Licence Description
        if (empty($index)) {
            // Create new Licence Description, if this type is already used, throw the error
            try {
                LicenceDescription::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Licence Description
            $licence_description = LicenceDescription::where('name', $index)->first();

            // Update Licence Description, if this type is already used, throw the error
            try {
                $licence_description->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Licence Description record
    public function ajax_delete_licence_description()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Licence Description
        $licence_description = LicenceDescription::where('name', $index)->first();

        // Delete Licence Description
        try {
            $licence_description->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Standard Jobs
    public function standard_jobs()
    {
        // Get Standard Jobs
        $standard_jobs = StandardJob::all();

        return view('lookups.standard-jobs', compact('standard_jobs'));
    }

    // Ajax handler for saving standard jobs record
    public function ajax_save_standard_jobs()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Standard Jobs
        if (empty($index)) {
            // Create new Standard Job, if this type is already used, throw the error
            try {
                StandardJob::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Standard Job
            $standard_job = StandardJob::where('acronym', $index)->first();

            // Update Standard Job, if this type is already used, throw the error
            try {
                $standard_job->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Standard Job record
    public function ajax_delete_standard_jobs()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Standard Job
        $standard_job = StandardJob::where('acronym', $index)->first();

        // Delete Standard Job
        try {
            $standard_job->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Standard Tasks
    public function standard_tasks()
    {
        // Get Standard Tasks
        $standard_tasks = StandardTask::all();

        return view('lookups.standard-tasks', compact('standard_tasks'));
    }

    // Ajax handler for saving standard tasks record
    public function ajax_save_standard_tasks()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Standard Tasks
        if (empty($index)) {
            // Create new Standard Task, if this type is already used, throw the error
            try {
                StandardTask::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Standard Task
            $standard_task = StandardTask::where('name', $index)->first();

            // Update Standard Task, if this type is already used, throw the error
            try {
                $standard_task->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Standard Task record
    public function ajax_delete_standard_tasks()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Standard Task
        $standard_task = StandardTask::where('name', $index)->first();

        // Delete Standard Task
        try {
            $standard_task->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Standard Job Tasks
    public function standard_job_tasks()
    {
        // Get Standard Jobs
        $standard_jobs = StandardJob::all();

        return view('lookups.standard-job-tasks', compact('standard_jobs'));
    }

    // Ajax handler for uploading Streets of particular Suburb
    public function ajax_upload_standard_job_tasks()
    {
        // Get parameters
        $standard_job_id = Input::get('standard_job_id');

        // Get Standard Job Tasks
        $standard_job_tasks = StandardJobTask::select('name')->where('standard_job_id', $standard_job_id)->get();

        return json_encode($standard_job_tasks);
    }

    // Ajax handler for saving standard job tasks record
    public function ajax_save_standard_job_tasks()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];
        $standard_job_id = $input['standard_job_id'];

        // Save Standard Job Task
        if (empty($index)) {
            // Create new Standard Job Task
            try {
                StandardJobTask::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Standard Job Task
            $standard_job_taks = StandardJobTask::where('name', $index)->where('standard_job_id', $standard_job_id)->first();

            // Update Standard Job Task
            try {
                $standard_job_taks->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting standard job task record
    public function ajax_delete_standard_job_tasks  ()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];
        $standard_job_id = $input['standard_job_id'];

        // Find deleting Standard Job Task
        $standard_job_task = StandardJobTask::where('name', $index)->where('standard_job_id', $standard_job_id)->first();

        // Delete Standard Job Tasks
        try {
            $standard_job_task->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Chemicals
    public function chemicals()
    {
        // Get Chemicals
        $chemicals = Chemical::all();

        return view('lookups.chemicals', compact('chemicals'));
    }

    // Ajax handler for saving chemicals record
    public function ajax_save_chemicals()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Chemical
        if (empty($index)) {
            // Create new Chemical, if this type is already used, throw the error
            try {
                Chemical::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Chemical
            $chemical = Chemical::where('name', $index)->first();

            // Update Chemical, if this type is already used, throw the error
            try {
                $chemical->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Chemical record
    public function ajax_delete_chemicals()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Chemical
        $chemical = Chemical::where('name', $index)->first();

        // Delete Chemical
        try {
            $chemical->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Titles
    public function titles()
    {
        // Get Titles
        $titles = Title::all();

        return view('lookups.titles', compact('titles'));
    }

    // Ajax handler for saving titles record
    public function ajax_save_titles()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Title
        if (empty($index)) {
            // Create new Title, if this type is already used, throw the error
            try {
                Title::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Title
            $title = Title::where('name', $index)->first();

            // Update Title, if this type is already used, throw the error
            try {
                $title->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Title record
    public function ajax_delete_titles()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Title
        $title = Title::where('name', $index)->first();

        // Delete Title
        try {
            $title->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Job Sources
    public function job_sources()
    {
        // Get Job Sources
        $job_sources = JobSource::all();

        return view('lookups.job-sources', compact('job_sources'));
    }

    // Ajax handler for saving job sources record
    public function ajax_save_job_sources()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Job Sources
        if (empty($index)) {
            // Create new Job Source, if this type is already used, throw the error
            try {
                JobSource::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Job Source
            $job_source = JobSource::where('name', $index)->first();

            // Update Job Source, if this type is already used, throw the error
            try {
                $job_source->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Job Source record
    public function ajax_delete_job_sources()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Job Source
        $job_source = JobSource::where('name', $index)->first();

        // Delete Job Source
        try {
            $job_source->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Section
    public function sections()
    {
        // Get Sections
        $sections = Section::all();

        return view('lookups.sections', compact('sections'));
    }

    // Ajax handler for saving section record
    public function ajax_save_sections()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Sections
        if (empty($index)) {
            // Create new Section, if this type is already used, throw the error
            try {
                Section::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Section
            $section = Section::where('name', $index)->first();

            // Update Section, if this type is already used, throw the error
            try {
                $section->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Section record
    public function ajax_delete_sections()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Section
        $section = Section::where('name', $index)->first();

        // Delete Section
        try {
            $section->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }
}
