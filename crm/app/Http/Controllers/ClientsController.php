<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Configuration;
use App\Models\Payment;
use App\Models\PaymentMode;
use App\Models\Project;
use App\Models\User;
use App\Models\Incentive;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(auth()->user()->hasRole(['Admin'])) {

        $clients = Client::latest()->paginate(15);
		}else{
			$clients = Client::where('closed_by',auth()->user()->id)->latest()->paginate(15);
		}

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_modes = PaymentMode::all();
        $projects = Project::all();
        $configurations = Configuration::all();
		$users = User::role([ 'Executive'])->orderby('no_of_enquiries_assigned', 'ASC')->get();
		//echo "<pre>";print_r($users);echo "</pre>";exit;
        return view('clients.create', compact('payment_modes', 'users','projects','configurations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6',
        ]);
		
        DB::beginTransaction();
        try {
			$attachment = '';
			if ($request->hasFile('attachment')){
				$image = $request->file('attachment');
				//echo "<pre>";print_r($image);exit;
				$profile_photo = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $profile_photo);
				$attachment = $profile_photo;
            }
            $client = Client::create([
                'name' => ucwords($request->input('name')),
                'business_name' => $request->input('business_name'),
                'email' => $request->input('email'),
                'contact_no' => $request->input('contact_no'),
                'subject' => $request->input('subject'),
                'carpet_area' => $request->input('carpet_area'),
                'agreement_value' => $request->input('agreement_value'),
                'booking_amount' => $request->input('booking_amount'),
                'remark' => $request->input('remark'),
                'lead_id' => $request->input('lead_id'),
                'rating' => $request->input('rating'),
                'floor_no' => $request->input('floor_no'),
                'unit_no' => $request->input('unit_no'),
                'tower_no' => $request->input('tower_no'),
                'actual_amount' => $request->input('actual_amount'),
                'cheque_no' => $request->input('cheque_no'),
                'payment_plan' => $request->input('payment_plan'),
                'attachment' => $attachment,
            ]);

            $project = Project::where('id', $request->input('project'))->first();
            $client->project()->associate($project);

            $configuration = Configuration::where('id', $request->input('configuration'))->first();
            $client->configuration()->associate($configuration);

            $payment_mode = PaymentMode::where('id', $request->input('payment_mode'))->first();
            $client->payment_mode()->associate($payment_mode);

            $client->closedBy()->associate(auth()->user());

            $client->save();
			if($request->input('due_payment_mode')){
            $payment_mode = PaymentMode::findorfail($request->input('due_payment_mode'));

            $payment = Payment::create([
                'amount' => $request->input('brokerage_amount'),
                'due_date' => $request->input('due_date'),
                'remark' => $request->input('brokerage_remark'),
                'payer' => $project->name,
            ]);

            $payment->payment_mode()->associate($payment_mode);
			$payment->client()->associate($client);
            $payment->createdBy()->associate(auth()->user());
			$payment->saveQuietly();
			}
			if($request->input('incentive_percent')){
				DB::table('incentive')
				->Insert(
					['lead_id' => $request->input('lead_id'),'user_id'=>1,'client_id'=>$client->id, 'incentive_percentage'=>$request->input('incentive_percent'),'incentive_amount'=>$request->input('incentive_amount'),'remarks'=>$request->input('incentive_remark'), ],
				);
				
			}
			if($request->input('emp_incentive')){
				$emp_incentive = $request->input('emp_incentive');
				foreach($emp_incentive as $inc){
					
						DB::table('incentive')
						->insert(
							['lead_id' => $request->input('lead_id'),'user_id'=>$inc['user_id'],'client_id'=>$client->id, 'incentive_percentage'=>$inc['incentive_employee_percent'],'incentive_amount'=>$inc['incentive_employee_amount'],'remarks'=>' ' ]
						);
					
				}
			}
			
           
            
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'db_error' => $e->getMessage(),
            ]);
        }
        DB::commit();

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findorfail($id);

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findorfail($id);
        $projects = Project::all();
        $payment_modes = PaymentMode::all();
        $configurations = Configuration::all();
        $incentive = DB::table('incentive')->where([['client_id',$id],['user_id',1]])->first();
		$emp_incentive = DB::table('incentive')->where([['client_id',$id],['user_id','!=',1]])->get();
		//echo "<pre>";print_r($emp_incentive);echo "</pre>";exit;
		$users = User::role(['Team Lead' , 'Executive'])->orderby('no_of_enquiries_assigned', 'ASC')->get();
        return view('clients.edit', compact('client', 'projects', 'payment_modes', 'configurations','incentive','emp_incentive','users'));
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
        $this->validate($request, [
            'name' => 'required',
            'contact_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6',
           // 'subject' => 'required',
        ]);
		//print_r($request->input('emp_incentive'));
		//print_r($request->input('incentive_employee_percent'));exit;
        DB::beginTransaction();
        try {
			$attachment = '';
			if ($request->hasFile('attachment')) {
				//  echo "has file";exit;
				$image = $request->file('attachment');
				//echo "<pre>";print_r($image);exit;
				$profile_photo = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $profile_photo);
				$attachment = $profile_photo;
            }
			//echo $attachment;exit;
            $client = Client::findorfail($id);
            $client->update([
                'name' => ucwords($request->input('name')),
                'business_name' => $request->input('business_name'),
                'email' => $request->input('email'),
                'contact_no' => $request->input('contact_no'),
                'subject' => $request->input('subject'),
                'carpet_area' => $request->input('carpet_area'),
                'agreement_value' => $request->input('agreement_value'),
                'booking_amount' => $request->input('booking_amount'),
                'remark' => $request->input('remark'),
                'rating' => $request->input('rating'),
                'attachment' => $attachment,
				'floor_no' => $request->input('floor_no'),
                'unit_no' => $request->input('unit_no'),
                'tower_no' => $request->input('tower_no'),
                'actual_amount' => $request->input('actual_amount'),
                'cheque_no' => $request->input('cheque_no'),
                'payment_plan' => $request->input('payment_plan'),
				
            ]);

            $project = Project::where('id', $request->input('project'))->first();
            $client->project()->associate($project);

            $configuration = Configuration::where('id', $request->input('configuration'))->first();
            $client->configuration()->associate($configuration);

            $payment_mode = PaymentMode::where('id', $request->input('payment_mode'))->first();
            $client->payment_mode()->associate($payment_mode);
			
			if($request->input('incentive_percent')){
				$client_exists = DB::table('incentive')->where('client_id',$client->id)->first();
				if($client_exists ){
					DB::table('incentive')->where('client_id',$client->id)
					->update(
						['lead_id' => $client->lead_id,'user_id'=>1,'client_id'=>$client->id, 'incentive_percentage'=>$request->input('incentive_percent'),'incentive_amount'=>$request->input('incentive_amount'),'remarks'=>$request->input('incentive_remark'), ]
					);
				}
				else{
					DB::table('incentive')
					->insert(
						['lead_id' => $client->lead_id,'user_id'=>1,'client_id'=>$client->id, 'incentive_percentage'=>$request->input('incentive_percent'),'incentive_amount'=>$request->input('incentive_amount'),'remarks'=>$request->input('incentive_remark'), ]
					);
				}
				
			}
			if($request->input('emp_incentive')){
				$emp_incentive = $request->input('emp_incentive');
				foreach($emp_incentive as $inc){
					$incentive_exists = DB::table('incentive')->where([['client_id',$client->id],['user_id',$inc['user_id']]])->first();
					if($incentive_exists){
						DB::table('incentive')->where([['client_id',$client->id],['user_id',$inc['user_id']]])
					->update(
						['lead_id' => $client->lead_id,'user_id'=>$inc['user_id'],'client_id'=>$client->id, 'incentive_percentage'=>$inc['incentive_employee_percent'],'incentive_amount'=>$inc['incentive_employee_amount'],'remarks'=>' ']
					);
					}else{
						DB::table('incentive')
						->insert(
							['lead_id' => $client->lead_id,'user_id'=>$inc['user_id'],'client_id'=>$client->id, 'incentive_percentage'=>$inc['incentive_employee_percent'],'incentive_amount'=>$inc['incentive_employee_amount'],'remarks'=>' ' ]
						);
					}
				}
			}
				
			

            if($request->has('is_active')) {
                $client->is_active = true;
                $client->save();
            } else {
                $client->is_active = false;
                $client->save();
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'db_error' => $e->getMessage(),
            ]);
        }
        DB::commit();

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findorfail($id);
        $client->deletedBy()->associate(auth()->user());
        $client->saveQuietly();
        $client->delete();

        return back();
    }
}
