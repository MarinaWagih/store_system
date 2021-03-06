<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    /**
     * @var int
     * Number of pagination result
     */
    protected $pagination_No=10;

    /**
     * Constructor
     * to add Middleware That needed to this controller
     *which are:
     *  1. user should be authenticated
     *  2. user should be admin if he/she going to delete a client
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['only'=>['destroy']]);

    }

    /**
     * Display a listing of the resource.
     * with pagination
     * @return Response
     */
    public function index()
    {
        $clients=Client::paginate($this->pagination_No);
        return view('client.all')->with(['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     * Request the create view
     * @return Response -> create view
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  Request $request
     * 1.validate the request by the following rules:
     *      -> name is required
     *      -> address is required
     *      -> phone is required , unique and minimum characters: 12',
     *      -> trading_name is required
     *      -> trading_address is required
     *      -> date is required and should be formatted as a date
     * 2.create the Client and save it to DB
     * @return Response client profile
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                            'name'=>'required',
                            'code'=>'required']);
         Client::create($request->all());
        return view('client.create');
    }

    /**
     * Display the specified Client.
     *
     * @param  int $id
     *
     * @return Response client Info
     */
    public function show($id)
    {
        $client = Client::find($id);

        if ($client)
        {
                return view('client.show')->with(['client' => $client]);
        }
        else
        {
            return view('errors.Unauth')->with(['msg' => 'variables.not_found']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $client = Client::find($id);
        if ($client)
        {
                return view('client.edit')
                    ->with([
                             'client' => $client
                           ]);

        } else {
            return view('errors.Unauth')->with(['msg' => 'variables.not_found']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|min:7',
           ]);
        $client = Client::find($id);
        if ($client)
        {
                $client->update($request->all());
            return redirect()->action('ClientsController@show',['id'=> $client->id]);

        } else {
            return view('errors.Unauth')->with(['msg' => 'variables.not_found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        Client::destroy($id);
        return redirect()->action('ClientsController@index');
    }

    public function search(Request $request)
    {
        $name=$request->get('query');
        $clients = Client::where('name', 'like', $name . "%")
                        ->orWhere('code', 'like', $name . "%")
                        ->orWhere('phone', 'like', '%' .$name . "%")
                        ->orWhere('trading_name', 'like', '%' .$name . "%")
                        ->orWhere('trading_address', 'like', '%' . $name . "%")
                        ->paginate($this->pagination_No);

        $result=$clients->toArray();
        $result['render']=$clients->render();
        if($request->get('type')=='json')
        {
            return response()->json($result);
        }
        return view('client.all')->with(['clients' => $clients]);
    }

    /**
     * select input data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSearch(Request $request)
    {
        if($request->get('query')!==null)
        {
                $clients = Client::select('id', 'name as text')
                    ->where('name', 'like', $request->get('query') . "%")
                    ->where('code', 'like', $request->get('query') . "%")
                    ->get();
           return response()->json($clients);
        }
        return response()->json();
    }
}
