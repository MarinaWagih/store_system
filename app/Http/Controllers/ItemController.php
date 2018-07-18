<?php

namespace App\Http\Controllers;

use App\Client;
use App\Item;
use App\ModelType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItemController extends Controller
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
     *  2. user should be admin if he/she going to delete an item
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['except'=>['index','search','ajaxSearch',
                                    'show','search_by_id']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items=Item::paginate($this->pagination_No);
        return view('item.all')->with(['items'=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $clients = Client::lists('name', 'id');
        $modelTypes = ModelType::all();
        return view('item.create',compact('clients','modelTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,['name'=>'required','code'=>'required']);
        Item::create($request->all());
        return redirect()->action('ItemController@create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        if ($item) {
            return view('item.show')->with(['item' => $item]);
        } else {
            return view('errors.Unauth')->with(['msg' => 'variables.not_found']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $clients = Client::lists('name', 'id');
        $modelTypes = ModelType::all();
        $item = Item::find($id);
        if ($item) {
            return view('item.edit')->with(compact('item','clients','modelTypes'));
        } else {
            return view('errors.Unauth')->with(['msg' => 'variables.not_found']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,['name'=>'required']);
        $item = Item::find($id);
        if ($item) {
            $item->update($request->all());
            if($request->file('picture')!==null)
            {
                unlink(base_path() . '/public/images/'.$item->picture);
                $item->picture=$this->saveImg($request);
            }
            return redirect('item/'.$item->id);
        } else {
            return view('errors.Unauth')->with(['msg' => 'variables.not_found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        Item::destroy($id);
        return redirect('item');
    }
    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $items = Item::where('name', 'like', $request->get('query') . "%")
            ->orWhere('full_code', '=',$request->get('query'))
            ->paginate($this->pagination_No);
        $result=$items->toArray();
        $result['render']=$items->render();
        if($request->get('type')=='json')
        {
            return response()->json($result);
        }
        return view('item.all')->with(['items' => $items]);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSearch(Request $request)
    {
        if($request->get('query')!==null) {
         $items =
             Item::select('id', 'name as text','client_price as price' )
                ->where('name', 'like', $request->get('query') . "%")
                ->orwhere('full_code', '=', $request->get('query'))
//                ->orwhere('id', 'like', $request->get('query') . "%")
                ->get();
            return response()->json($items);
        }
        return response()->json([]);
    }
    public function search_by_id(Request $request)
    {
        if($request->get('query')!==null) {
            $items =
                Item::select('id', 'name as text','client_price as price' )
                    ->where('id', '=', $request->get('query'))
                    ->get();
            return response()->json($items);
        }
        return response()->json([]);
    }
    /**
     * @param $request
     * @return string New img name
     */
    private function saveImg($request)
    {
        $imageName=rand(0,9999999999) .
            rand(0,9999999999) .rand(0,9999999999) .'.'.
        $request->file('picture')->getClientOriginalExtension();
        $request->file('picture')->move(
            base_path() . '/public/images/', $imageName
        );
        return $imageName;
    }


}
