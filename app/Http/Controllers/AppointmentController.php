<?php
    
namespace App\Http\Controllers;
    
use App\Models\Appointment;
use Illuminate\Http\Request;
    
class AppointmentController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:appointments-list|appointments-create|appointments-edit|appointments-delete', ['only' => ['index','show']]);
         $this->middleware('permission:appointments-create', ['only' => ['create','store']]);
         $this->middleware('permission:appointments-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:appointments-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (\Auth::user()->roles[0]->id != '1') && $appointments = Appointment::where('user_id',\Auth::user()->id)->latest()->paginate(10);
        (\Auth::user()->roles[0]->id == '1') && $appointments = Appointment::latest()->paginate(10);
       
        return view('appointments.index',compact('appointments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appointments.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'patient' => 'required|min:2',
            'category' => 'required',
            'stime' => 'required',
            'etime' => 'required',
        ]);

        $params = $request->all();
        $params['user_id'] = \Auth::user()->id;
        unset($params['_token']);
        Appointment::insert($params);    
        return redirect()->route('appointments.index')
                        ->with('success','Appointment created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointments = Appointment::where('id',$id)->first();
        return view('appointments.show',compact('appointments'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointments = Appointment::where('id',$id)->first();
        return view('appointments.edit',compact('appointments'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'patient' => 'required|min:2',
            'category' => 'required',
            'stime' => 'required',
            'etime' => 'required',
        ]);

        $params = $request->all();
        $params['user_id'] = \Auth::user()->id;
        unset($params['_token'],$params['_method']);
        Appointment::where('id',$id)->update($params);   
        return redirect()->route('appointments.index')
                        ->with('success','Appointment updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Appointment::where('id',$id)->delete();       
        return redirect()->route('appointments.index')
                        ->with('success','Appointment deleted successfully');
    }


    public function changeStatus($id,$status)
    {
        ($status == "3") && $statusTxt = 'Cancel';
        ($status == "2") && $statusTxt = 'Confirm';
        ($status == "1") && $statusTxt = 'Pending';    
        Appointment::where('id',$id)->update(['status' => $status]);       
        return redirect()->route('appointments.index')
                        ->with('success','Appointment status changed successfully');
    }


}