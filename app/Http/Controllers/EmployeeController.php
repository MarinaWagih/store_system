<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
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
     *  2. user should be admin if he/she going to delete an employee
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['only'=>['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $employees=Employee::paginate($this->pagination_No);
        return view('employee.all')->with(['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required']);
        Employee::create($request->all());
        return view('employee.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if ($employee)
        {
            return view('employee.show')->with(['employee' => $employee]);
        }
        return view('errors.Unauth')->with(['msg' => 'variables.not_found']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id){
        $employee= Employee::find($id);
        if ($employee)
        {
            return view('employee.edit')
                ->with(['employee' => $employee]);

        }
        return view('errors.Unauth')->with(['msg' => 'variables.not_found']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|min:7',
        ]);
        $employee = Employee::find($id);
        if ($employee)
        {
            $employee->update($request->all());
            return redirect()->action('EmployeeController@show',['id'=> $employee->id]);

        } else {
            return view('errors.Unauth')->with(['msg' => 'variables.not_found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->action('EmployeeController@index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $name=$request->get('query');
        $employees = Employee::where('name', 'like', $name . "%")
            ->orWhere('phone', 'like', '%' .$name . "%")
            ->paginate($this->pagination_No);

        $result=$employees->toArray();
        $result['render']=$employees->render();
        if($request->get('type')=='json')
        {
            return response()->json($result);
        }
        return view('employee.all')->with(['employees' => $employees]);
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
            $employees = Employee::select('id', 'name as text')
                ->where('name', 'like', $request->get('query') . "%")
                ->where('phone', 'like', $request->get('query') . "%")
                ->get();
            return response()->json($employees);
        }
        return response()->json();
    }
}
