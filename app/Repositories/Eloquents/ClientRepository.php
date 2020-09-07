<?php

namespace App\Repositories\Eloquents;

use App\Client;
use Illuminate\Http\Request;
use Response;
use File;
use App\Imports\ClientsImport;
use Session;
use Excel;
use DB;
use App\Repositories\Interfaces\IClientRepository;
use Auth;
use App\Order;

class ClientRepository implements IClientRepository
{
    protected $clients;
    protected $orders;

    public function __construct(Client $clients, Order $orders)
    {
        $this->clients = $clients;
        $this->orders = $orders;
    }
    /**
     * Get all of the client for the given user.
     *
     * @param  Client  $client
     * @return Collection
     */
    public function all()
    {
        return $this->clients->where('user_id', Auth::user()->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function store($auth_id, Request $request){
        $client = new Client;
        $client->company = $request->company_name;
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->fax = $request->fax;
        $client->email = $request->email;
        $client->website = $request->website;
        $client->billing_address = $request->b_address;
        $client->shipping_address = $request->s_address;
        $client->note = $request->note;
        $client->user_id = $auth_id;
        return $client->save();
    }

    public function import($auth_id, Request $request){
        $result = [];
        $client_name = [];
        if ($request->hasFile('import_file')) {
            $extension = File::extension($request->import_file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->import_file->getRealPath();
                $data = Excel::import(new ClientsImport, $request->import_file);
                if(!empty($data)){
                    $result = ['result'=>true, 'status'=>'success','message'=>'Clients Data Imported!'];
                }else{
                    $result = ['result'=>false, 'status'=>'warning','message'=>'There is no data in csv file!'];
                }
            }else{
                $result = ['result'=>false, 'status'=>'warning','message'=>'Selected file is not csv!'];
            }
        }else{
            $result = ['result'=>false, 'status'=>'warning','message'=>'Something went wrong!'];
        }
        return $result;
    }

    public function show(Client $client){
        return $client;
    }

    public function edit(Client $client){
        return $client;
    }

    public function update(Request $request, Client $client){
        $client = Client::find($client->id);
        $client->name = $request->name;
        $client->company = $request->company_name;
        $client->phone = $request->phone;
        $client->fax = $request->fax;
        $client->email = $request->email;
        $client->website = $request->website;
        $client->billing_address = $request->b_address;
        $client->shipping_address = $request->s_address;
        $client->note = $request->note;
        return $client->save();
    }

    public function destroy(Client $client){
        $client = Client::find($client->id);
        return $client->delete();
    }

    public function getByOrder($order_id){
        return $this->clients->where('id',$this->orders->where('id',$order_id)->first()->client_id)->first();
    }

    public function getById($id){
        return $this->clients->where('id',$id)->get();
    }
}