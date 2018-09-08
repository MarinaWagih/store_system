<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use App\InvoiceItem;
use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * number of results for each page in all && search
     * @var int
     * Number of pagination result
     */
    protected $pagination_No = 20;

    /**
     * Constructor
     * to add Middleware That needed to this controller
     *which are:
     *  1. user should be authenticated
     *  2. user should be admin if he/she going to delete,edit or add an item
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['delete']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')
            ->paginate($this->pagination_No);
        return view('invoice.all')->with(['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'date' => 'required|date',
            'items' => 'required',
        ]);

        $invoice =new Invoice($request->all());
        $invoice->save();
        $invoice->items()->sync($request->get('items'));
        return view('invoice.show')->with(['invoice' => $invoice,"autoPrint"=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);


        if ($invoice) {
            return view('invoice.show')->with(['invoice' => $invoice]);

        } else {
            return view('errors.Unauth')
                ->with(['msg' => 'variables.not_found']);
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
        $invoice = Invoice::find($id);
        if ($invoice)
        {

                return view('invoice.edit')->with(['invoice' => $invoice]);
        }
        else
        {
            return view('errors.Unauth')
                ->with(['msg' => 'variables.not_found']);
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
        $this->validate($request, [
            'date' => 'required|date',
            'items' => 'required',
//            'client_id' => 'required',
        ]);
        $invoice = Invoice::find($id);
        if ($invoice) {
            $invoice->update($request->all());
            $invoice->items()->sync($request->get('items'));
            return view('invoice.show')->with(['invoice' => $invoice]);
        } else {
            return view('errors.Unauth')
                ->with(['msg' => 'variables.not_found']);
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
        Invoice::destroy($id);
        return redirect('invoice');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {

        $invoices =Invoice::where('id','like',$request->get('query')."%")
                ->orWhere('date','like',$request->get('query')."%")
                ->paginate($this->pagination_No);
        $result = $invoices->toArray();
        $result['render'] = $invoices->render();
        if ($request->get('type') == 'json') {
            return response()->json($result);
        }
        return view('invoice.all')->with(['invoices' => $invoices]);
    }

    /**
     * @param $items list of items in invoice
     * @return array of prepared array to sync in db
     */
    private function prepareItems($items)
    {

        $items= json_decode($items, true);
        return $items;
    }
    public function getTotalFromDateToDateForm()
    {
        return view('invoice.report');
    }
    public function getTotalFromDateToDate(Request $request)
    {
//        dd($request->all());
        $invoices =Invoice::where('date','<=',$request->get('start_date'))
            ->where('date','>=',$request->get('end_date'))->get();
//        echo "<pre>";
        $items=[];
        $total_price=0;//actual
        $total_client_price=0;//selling price
        foreach($invoices as $i=>$invoice)
        {
//            var_dump("==================id================\n");
//            var_dump($invoice->id);
//            var_dump("\n");
//            var_dump($invoice->items);
//            var_dump("\n");
//            var_dump("==================================");
//            var_dump("\n");
            $total_client_price+=$invoice->total_after_sales_tax;
            foreach($invoice->items as $j=>$item)
            {
                //item

                    $total_price+=($item->pivot->quantity*$item->price);

                    if(!isset($items[$item->id]))
                    {
                        $items[$item->id]=[
                            "count"          => 0,
                            "buying_price"   => 0,
                            "selling_price"  => 0,
                            "name"           => $item->name
                        ];
                    }
                    $og_selling_price=($item->pivot->quantity*$item->client_price);
                    $items[$item->id]["count"]         += $item->pivot->quantity;
                    $items[$item->id]["buying_price"]  += ($item->pivot->quantity*$item->price);
                    $items[$item->id]["selling_price"] += ($og_selling_price-($og_selling_price*($item->discount_percent/100))-$item->discount_value);
            }

        }
        $result=[
            'total_price'=>$total_price,
            'total_client_price'=>$total_client_price,
            'items'=>$items,
            'start_date'=>$request->get('start_date'),
            'end_date'=>$request->get('end_date')
        ];
//        dd($result);
        return view('invoice.report',array('result'=>$result));
    }

}
