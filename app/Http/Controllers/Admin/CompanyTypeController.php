<?php

namespace App\Http\Controllers\Admin;

use App\Model\CompanyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CaseType;
use Validator;
use App\Traits\DatatablTrait;
use Session;
use DB;
// use App\Helpers\LogActivity;

class CompanyTypeController extends Controller
{
        use DatatablTrait;
	public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $user = \Auth::guard('admin')->user();
        if(! $user->can('company_type_list')){
            abort(403, 'Unauthorized action.');
        }
        return view('admin.settings.company-type.company_type');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

                return response()->json([
                    'html' =>  view('admin.settings.company-type.company_type_create')->render()
                ]);
    }

    public function companyTypeList(Request $request) {

         $user = \Auth::guard('admin')->user();
         $isEdit=$user->can('court_type_edit');
         $isDelete=$user->can('court_type_edit');


              // Listing column to show
        $columns = array(
            0 => 'id',
            1 => 'company_type_name',
            2 => 'is_active',
        );


        $totalData = DB::table('company_types')->where('id', '!=', 0)->count();
        $totalRec = $totalData;


        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');


        $customcollections = DB::table('company_types')
                            ->where('id', '!=', 0)
                            ->when($search, function ($query, $search) {
                            return $query->where('company_type_name', 'LIKE', "%{$search}%");
                        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {

            // $row['id'] = $item->id;

         if (empty($request->input('search.value'))) {
                    $final = $totalRec-$start;
                    $row['id'] = $final;
                    $totalRec--;
                }else{
                    $start++;
                    $row['id'] = $start;
                }


            $row['type'] = $item->company_type_name;

        if($isEdit=="1"){
            $row['is_active'] = $this->status($item->is_active,$item->id , route('company.type.companytype.status')) ;
        }else{
             $row['is_active'] =[];

        }


     if($isEdit=="1" || $isDelete=="1"){
            $row['action'] = $this->action([
                'edit_modal' => collect([
                    'id' => $item->id,
                    'action' => route('company-type.edit', $item->id),
                    'target' => '#addtag'
                ]),
                'edit_permission' => $isEdit,
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('company-type.destroy', $item->id),
                ]),
             'delete_permission' => $isDelete,
            ]);
        }else{
             $row['action'] = [];
        }

            $data[] = $row;

        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'company_name'   => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $data = new CompanyType();
        $data->advocate_id     = "1";
        $data->company_type_name  = $request->company_name;
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Company type added successfully',

        ],200);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data['company']= CompanyType::findorfail($id);
         return response()->json([
                    'html' =>  view('admin.settings.company-type.company_type_edit',$data)->render()
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_name'   => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $data = CompanyType::findorfail($id);
        $data->advocate_id     = "1";
        $data->company_type_name  = $request->company_name;
        $data->save();


          return response()->json([
            'success' => true,
            'message' => 'Company type updated successfully',

        ],200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

         public function changeStatus(Request $request) {
            // dd($request->all());

       $statuscode = 400;
       $data = CompanyType::findOrFail($request->id);
       $data->is_active  = $request->status == 'true' ? 'Yes' : 'No' ;

        if($data->save()) {
            $statuscode = 200 ;
        }
        $status = $request->status == 'Yes' ? 'Yes' : 'No' ;
        $message = 'Company type status changed successfully.' ;

        return response()->json([
            'success' => true ,
            'message' => $message
        ],$statuscode);

    }

    public function destroy($id)
    {
      return response()->json([
                   'success' => true ,
                   'message' => 'Company type deleted successfully.'
                   ],200);

    }
}
