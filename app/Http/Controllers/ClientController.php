<?php

namespace App\Http\Controllers;

use App\Client;
use App\Title;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class ClientController extends Controller
{
    /**
     * Display client index page
     *
     * @return view
     */

    public function index()
    {
        // Get all clients
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }

    /**
     * AJAX table of Clients for the index page
     *
     * @param Request $request
     * @return mixed
     */

    public function data(Request $request)
    {
        $clients = Client::select('name', 'surname', 'phone', 'mobile', 'client_address', 'email', 'id');

        return Datatables::of($clients)
            ->edit_column('name', '<a href="/clients/edit/{{ $id }}"> {{ $surname }} {{ $name }}</a>')
            ->edit_column('phone', '{{ $phone }}')
            ->edit_column('mobile', '{{ $mobile }}')
            ->edit_column('client_address', '{{ $client_address }}')
            ->edit_column('email', '{{ $email }}')
            ->remove_column('id')
            ->remove_column('surname')
            ->make();
    }


    /**
     * Create new client
     *
     * @return view
     */

    public function create()
    {
        // Get all titles
        $titles = Title::all();

        return view('clients.edit', compact('titles'));
    }

    /**
     * Edit client
     *
     * @param $id
     * @return view
     */

    public function edit($id)
    {
        // Get all titles
        $titles = Title::all();
        $client = Client::find($id);

        return view('clients.edit', compact('titles', 'client'));
    }

    /**
     * Save created or edited client
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required'
        ]);

        // Get all input data
        $input = $request->all();

        if (isset($input['id'])) {
            // Client exists
            $client = Client::find($input['id']);
        } else {
            // New client
            $client = new Client();
        }

        // Save client data
        $client->title_id = $input['title_id'] > 0 ? $input['title_id'] : null;
        $client->name = $input['name'];
        $client->surname = $input['surname'];
        $client->spouse_name = $input['spouse_name'] != '' ? $input['spouse_name'] : null;
        $client->phone = $input['phone'];
        $client->work = $input['work'];
        $client->mobile = $input['mobile'];
        $client->email = $input['email'];
        $client->fax = $input['fax'] != '' ? $input['fax'] : null;
        $client->client_address = $input['client_address'] != '' ? $input['client_address'] : null;
        $client->type = $input['type'];

        $client->save();

        return redirect('clients')->with('success', 'Client has been saved/updated successfully');
    }
}
