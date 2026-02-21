<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\PaymentMode;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::orderBy('id', 'DESC')->paginate(15);
		if(auth()->user()->hasRole(['Admin'])) {$wallet ='No Wallet'; }
		else{
		$wallet = Wallet::where([['user_id', Auth::user()->id]])->sum('balance');
		}
		//print_r($wallet);exit;
        return view('expenses.index', compact('expenses','wallet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$expense_categories = ExpenseCategory::all();
        $payment_modes = PaymentMode::all();

        return view('expenses.create', compact('payment_modes'));
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
            'payment_mode' => 'required',
            'expense_category' => 'required',
            'payee' => 'required',
            'amount_paid' => 'required',
            'date_of_payment' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $profile_photo ='';
			 if ($request->hasFile('bill_attachment')) {
				$image = $request->file('bill_attachment');
				//echo "<pre>";print_r($image);exit;
				$profile_photo = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $profile_photo);
			 }
            $payment_mode = PaymentMode::findorfail($request->input('payment_mode'));

            $expense = Expense::create([
                'payee' => $request->input('payee'),
                'amount_paid' => $request->input('amount_paid'),
                'date_of_payment' => $request->input('date_of_payment'),
                'remark' => $request->input('remark'),
                'expense_category' => $request->input('expense_category'),
                'bill_no' => $request->input('bill_no'),
                'address' => $request->input('address'),
                'status' => $request->input('status'),
                'cheque_no' => $request->input('cheque_no'),
                'bill_attachment' => $profile_photo,
            ]);
          //  $expense->expense_category()->associate($expense_category);
            $expense->payment_mode()->associate($payment_mode);
            $expense->createdBy()->associate(auth()->user());
            $expense->saveQuietly();
			if($request->input('status') == 'Paid'){
				
				$wallet = Wallet::where([['user_id',auth()->user()->id]])->orderby('id','desc')->first();
				//echo "<pre>";print_r($wallet);exit;
				if($wallet){
					
					$remaining_balance = $wallet->balance - $request->input('amount_paid');
					$wallet->update([
						'balance' => $remaining_balance,
						
					]);
					$wallet->save();
				}
			}
			
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'db_error' => $e->getMessage(),
            ]);
        }
        DB::commit();

        return redirect(route('expenses.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::findorfail($id);
       // $expense_categories = ExpenseCategory::all();
        $payment_modes = PaymentMode::all();

        return view('expenses.edit', compact('expense',  'payment_modes'));
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
            'payment_mode' => 'required',
            'expense_category' => 'required',
            'payee' => 'required',
            'amount_paid' => 'required',
            'date_of_payment' => 'required',
        ]);

        DB::beginTransaction();
        try {
            //$expense_category = ExpenseCategory::findorfail($request->input('expense_category'));

            $payment_mode = PaymentMode::findorfail($request->input('payment_mode'));
			
            $expense = Expense::findorfail($id);
			$profile_photo  = '';
			if ($request->hasFile('bill_attachment')) {
				if($expense->bill_attachment !== null) {
                    $file_path = public_path('/storage/galeryImages/' . $expense->bill_attachment);
                    @unlink($file_path);
                }

				$image = $request->file('bill_attachment');
				$profile_photo = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $profile_photo);
			 }
            $expense->update([
                'payee' => $request->input('payee'),
                'amount_paid' => $request->input('amount_paid'),
                'date_of_payment' => $request->input('date_of_payment'),
                'remark' => $request->input('remark'),
                'expense_category' => $request->input('expense_category'),
				 'bill_no' => $request->input('bill_no'),
                'address' => $request->input('address'),
                'status' => $request->input('status'),
                'cheque_no' => $request->input('cheque_no'),
                'bill_attachment' => $profile_photo,
            ]);
			
			
           // $expense->expense_category()->associate($expense_category);
            $expense->payment_mode()->associate($payment_mode);
            $expense->lastEditedBy()->associate(auth()->user());
            $expense->saveQuietly();
			if($request->input('status') == 'Paid'){
				
				$wallet = Wallet::where([['user_id',auth()->user()->id]])->orderby('id','desc')->first();
				//echo "<pre>";print_r($wallet);exit;
				if($wallet){
					
					$remaining_balance = $wallet->balance - $request->input('amount_paid');
					$wallet->update([
						'balance' => $remaining_balance,
						
					]);
					$wallet->save();
				}
			}
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'db_error' => $e->getMessage(),
            ]);
        }
        DB::commit();

        return redirect(route('expenses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::findorfail($id);
        $expense->deletedBy()->associate(auth()->user());
        $expense->saveQuietly();
        $expense->delete();

        return back();
    }
}
