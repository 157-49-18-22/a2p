<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use SoftDeletes;

    protected $table = 'invoice';

    protected $fillable = [
        'bill_no', 'bill_date', 'bill_type', 'customer_name', 'company_developer', 'company_address', 'property_amount', 'gst', 'amount_for_developer', 'gst_status', 'bill_status', 'tds', 'amount_after_tds', 'after_customer_passon', 'remarks', 'deleted_by', 'created_at', 'updated_at', 'commission_1_name', 'commission_1_date', 'commission_1_cheque_no', 'commission_1_company_amount', 'commission_1_tds', 'commission_1_amount', 'commission_2_name', 'commission_2_date', 'commission_2_cheque_no', 'commission_2_company_amount', 'commission_2_tds', 'commission_2_amount', 'commission_3_name', 'commission_3_date', 'commission_3_cheque_no', 'commission_3_company_amount', 'commission_3_tds', 'commission_3_amount', 'commission_4_name', 'commission_4_date', 'commission_4_cheque_no', 'commission_4_company_amount', 'commission_4_tds', 'commission_4_amount', 'commission_5_name', 'commission_5_date', 'commission_5_cheque_no', 'commission_5_company_amount', 'commission_5_tds', 'commission_5_amount', 'commission_6_name', 'commission_6_date', 'commission_6_cheque_no', 'commission_6_company_amount', 'commission_6_tds', 'commission_6_amount', 
    ];

    
}
