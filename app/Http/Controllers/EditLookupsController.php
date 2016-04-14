<?php

namespace App\Http\Controllers;

use App\Chemical;
use App\LicenceDescription;
use App\StandardJob;
use App\StandardTask;
use App\Suburb;
use App\TechnicianType;
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
}
