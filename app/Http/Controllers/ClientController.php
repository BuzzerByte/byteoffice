<?php

namespace App\Http\Controllers;
use Session;
use Response;
use App\Client;
use Excel;
use File;
use Illuminate\Http\Request;
use DB;
use App\Imports\ClientsImport;
use App\Services\UserService;
use App\Services\ClientService;

class ClientController extends Controller
{
    protected $clients;

    public function __construct(ClientService $clients)
    {
        $this->clients = $clients;
    }

    public function index()
    {
        $clients = $this->clients->all();
        if(empty($clients)){
            return view('admin.clients.index',['clients'=>'No Client']);
        }else{
            return view('admin.clients.index',['clients'=>$clients]);
        }
    }

    public function store(Request $request)
    {
        $auth_id = $this->auth_user->getAuthId();
        $result = $this->clients->store($auth_id, $request);
        $result == true ? flash()->success('Client Inserted Successfully'):flash()->error('Something went wrong!');
        return redirect()->route('client.index');
    }

    public function downloadClientSample(){
        $result = $this->clients->downloadClientSample();
        if($result['result']){
            flash()->success('Sample downloaded');
            return Response::download($result['file_path'], 'client.csv', $result['headers']);
        }else{
            flash()->error('Something went wrong!');
        }
        return redirect()->route('client.index');
    }

    public function import(Request $request){
        $this->validate($request, array(
            'import_file'      => 'required'
        ));
        $auth_id = $this->auth_user->getAuthId();
        $result = $this->clients->import($auth_id, $request);
        if($result['result'] && $result['status']=='success'){
            flash()->success($result['message']);
        }else if($result['result'] && $result['status']=='warning'){
            flash()->warning($result['message']);
        }else{
            flash()->error($result['message']);
        }
        return redirect()->route('client.index'); 
    }

    public function show(Client $client)
    {
        return $this->clients->show($client);
    }

    public function edit(Client $client)
    {
        return $this->clients->edit($client);
    }

    public function update(Request $request, Client $client)
    {
        $result = $this->clients->update($request, $client);
        $result == true ? flash()->success('Client Updated Successfully'):flash()->error('Something went wrong!');
        return redirect()->route('client.index');   
    }

    public function destroy(Client $client){
        $result = $this->clients->destroy($client);
        $result == true ? flash()->success('Client Deleted Successfully'):flash()->error('Something went wrong!');
        return redirect()->route('client.index');
    }
}
