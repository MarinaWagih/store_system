<?php

namespace App\Http\Controllers;

use App\Client;
use App\ModelType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ModelTypeController extends Controller
{
    /**
     * @var int
     * Number of pagination result
     */
    protected $pagination_No=5;
    /**
     * Constructor
     * to add Middleware That needed to this controller
     *which are:
     *  1. user should be authenticated
     *  2. user should be admin if he/she going to delete an modelType
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
        $modelTypes=ModelType::paginate($this->pagination_No);
        return view('modelType.all')->with(['modelTypes'=>$modelTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('modelType.create');
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
        $values=$request->all();
        ModelType::create($values);
        return view('modelType.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $modelType = ModelType::find($id);
        if ($modelType) {
            return view('modelType.show')->with(['modelType' => $modelType]);
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
        $modelType = ModelType::find($id);
        if ($modelType) {
            return view('modelType.edit')->with(compact('modelType','clients'));
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
        $modelType = ModelType::find($id);
        if ($modelType) {
            $modelType->update($request->all());
            return redirect('model-type/'.$modelType->id);
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
        ModelType::destroy($id);
        return redirect('model-type');
    }
    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $modelTypes = ModelType::where('name', 'like', $request->get('query') . "%")
            ->orWhere('code', 'like',$request->get('query')."%")
            ->paginate($this->pagination_No);
        $result=$modelTypes->toArray();
        $result['render']=$modelTypes->render();
        if($request->get('type')=='json')
        {
            return response()->json($result);
        }
        return view('modelType.all')->with(['modelTypes' => $modelTypes]);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSearch(Request $request)
    {
        if($request->get('query')!==null) {
         $modelTypes =
             ModelType::select('id', 'name as text','picture','client_price as price' )
                ->where('name', 'like', $request->get('query') . "%")
                ->where('code', 'like', $request->get('query') . "%")
//                ->orwhere('id', 'like', $request->get('query') . "%")
                ->get();
            return response()->json($modelTypes);
        }
        return response()->json([]);
    }
    public function search_by_id(Request $request)
    {
        if($request->get('query')!==null) {
            $modelTypes =
                ModelType::select('id', 'name as text','picture','client_price as price' )
                    ->where('id', '=', $request->get('query'))
                    ->get();
            return response()->json($modelTypes);
        }
        return response()->json([]);
    }


}
