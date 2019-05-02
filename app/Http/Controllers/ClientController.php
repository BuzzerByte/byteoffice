<?php

namespace buzzeroffice\Http\Controllers;
use Session;
use Response;
use buzzeroffice\Client;
use Excel;
use File;
use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        if(empty($clients)){
            return view('admin.clients.index',['clients'=>'No Client']);
        }else{
            return view('admin.clients.index',['clients'=>$clients]);
        }
    }

    public function store(Request $request)
    {
        $client = Client::create([
            'name' => $request->input('name'),
            'company' => $request->input('company_name'),
            'phone' => $request->input('phone'),
            'fax' => $request->input('fax'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'billing_address' => $request->input('b_address'),
            'shipping_address' => $request->input('s_address'),
            'note' => $request->input('note')
        ]);
        if($client){
            flash()->success('Client Inserted Successfully!');
            // Session::flash('success', 'Client Inserted Successfully!');
        }else{
            flash()->error('Something went wrong!');
            // Session::flash('failure', 'Something went wrong!');
        }
        $clients = Client::all();

        return redirect()->route('client.index',['clients'=>$clients]);
    }

    public function downloadClientSample(){
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/downloads/client.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=client.csv',
        );
        if (file_exists($file_path)) {
            // Send Download
            flash()->success('File Downloaded');
            // Session::flash('success', 'File Downloaded');
            return Response::download($file_path, 'client.csv', $headers);
        } else {
            // Error
            flash()->error('Something went wrong!');
            // Session::flash('failure', 'Something went wrong!');
        }
        $clients = Client::all();
        return redirect()->route('client.index',['clients'=>$clients]);
    }

    public function import(Request $request){
        $this->validate($request, array(
            'import_file'      => 'required'
        ));
        $client_name = [];
        if ($request->hasFile('import_file')) {
            $extension = File::extension($request->import_file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->import_file->getRealPath();
                $data = Excel::load($path, function($reader) {})->get();
                if(!empty($data) && $data->count()){
                    foreach($data as $record){
                        if(in_array($record->client_name,$client_name)){
                            continue;   
                        }else if(Client::where('name','=',$record->client_name)->exists()){
                            continue;
                        }else if($record->client_name == NULL || $record->client_name == "-"){
                            continue;
                        }else{
                            $client_name[] = $record->client_name;
                            $insert_client_data[] = [
                                'name' => $record->client_name, 
                                'company' => $record->company,
                                'phone' => $record->phone,
                                'fax' => $record->fax,
                                'email' => $record->email,
                                'website' => $record->website,
                                'billing_address' => $record->billing_address,
                                'shipping_address' => $record->shipping_address,
                                'note' => $record->note
                            ];
                        }
                    }
                    if(!empty($insert_client_data)){
                        $insert_client = DB::table('clients')->insert($insert_client_data);
                        flash()->success('Clients Data Imported!');
                        // Session::flash('success', 'Clients Data Imported!');
                    }else{
                        flash()->warning('Duplicated record, please check your csv file!');
                        // Session::flash('warning', 'Duplicated record, please check your csv file!');
                    }
                }else{
                    flash()->warning('There is no data in csv file!');
                    // Session::flash('warning', 'There is no data in csv file!');
                }
            }else{
                flash()->warning('Selected file is not csv!');
                // Session::flash('warning', 'Selected file is not csv!');
            }
        }else{
            flash()->error('Something went wrong!');
            // Session::flash('failure', 'Something went wrong!');
        }
        $clients = Client::all();
        return redirect()->route('client.index',['clients'=>$clients]);    
    }

    public function show(Client $client)
    {
        $client = Client::where('id',$client->id)->get();
        return response()->json(['client'=>$client]);
    }

    public function edit(Client $client)
    {
        $data = Client::where('id',$client->id)->get();
        return response()->json(['client'=>$data]);
    }

    public function update(Request $request, Client $client)
    {
        $update = Client::where('id',$client->id)->update([
            'name'=>$request->name,
            'company'=>$request->company_name,
            'phone'=>$request->phone,
            'fax'=>$request->fax,
            'email'=>$request->email,
            'website'=>$request->website,
            'billing_address'=>$request->b_address,
            'shipping_address'=>$request->s_address,
            'note'=>$request->note
        ]);
        if($update){
            flash()->success('Clients Data Updated!');
            // Session::flash('success', 'Clients Data Updated!');
        }else{
            flash()->error('Something went wrong!');
            // Session::flash('failure', 'Something went wrong!');
        }
        $clients = Client::all();
        return redirect()->route('client.index',['clients'=>$clients]);    
    }

    public function delete(Client $client)
    {
        $data = Client::find($client->id);
        $data->delete();
        if($data){
            flash()->success('Clients Data Deleted!');
            // Session::flash('success', 'Clients Data Deleted!');
        }else{
            flash()->error('Something went wrong!');
            // Session::flash('failure', 'Something went wrong!');
        }
        $clients = Client::all();
        return redirect()->route('client.index',['clients'=>$clients]);    

    }
}
