<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon;
use App\Model\user;
use App\Model\promocode;
use App\Model\subscribe;
use App\Model\activitylog;
use App\Model\termsandcondition;
use App\Model\userDetails;
use App\Model\agent_payment;
use App\Model\agent_commission;
use App\Model\sub_domain;

class DataTableController extends Controller
{
    public function datatable($table,$user_id=false){

    	switch ($table) {

    		case "user_datatable":

			return datatables()->eloquent(user::query()->where('user_role', '=', '1'))
			->setTransformer(function($item){
				if($item->banned == "N"){
					$status = "<label class='label label-primary'>Active</label>";
				}elseif($item->banned == "Y"){
					$status  = "<label class='label label-danger'>Deactive</label>";
				}

				$action = '
				<div class="btn-group">
					<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="'.url('/user-view/').'/'.$item->user_id.'" ><i class="fa fa-eye"></i> View</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="user_status_change" user_id="'.$item->user_id.'" ><i class="fa fa-ioxhost"></i> Change Status</a>
						</li>
					</ul>
				</div>
				';

				return [
					'user_id' => (int) $item->user_id,
					'name' => (string) $item->userDetails->first_name.' '.$item->userDetails->last_name,
					'username' => $item->username,
					'email' => $item->email,
					'phone' => $item->userDetails['phone'],
					'register_date' => (string) Carbon\Carbon::parse($item->register_date)->format('H:i:s d-m-Y'),
					'banned' => $status,
					'action' => $action,
                    ];
                })
			->toJson();

	    	break;

	    	case "user_subscribe_details":

			return datatables()->eloquent(subscribe::query()->where('user_id','=',$user_id))
			->setTransformer(function($item){
				if(!empty($item->plugins_id)){
					$name  = $item->plugin->plugins_name;
				}elseif(empty($item->plugins_id)){
					$name  = $item->software->software_title;
				}

				if($item->subscribe_status=='active'){
					$status  = '<button type="button" class="btn btn-primary btn-xs">Active</button>';
					$action_button = '<li><a href="javascript:void(0)" class="change_status" subscribe_id="'.$item->subscribe_id.'" todo="inactive" ><i class="fa fa-ioxhost"></i> Inctive</a></li>';
				}elseif($item->subscribe_status=='inactive'){
					$status  = '<button type="button" class="btn btn-warning btn-xs">Inactive</button>';
					$action_button = '<li><a href="javascript:void(0)" class="change_status" subscribe_id="'.$item->subscribe_id.'" todo="active" ><i class="fa fa-ioxhost"></i> Active</a></li>';
				}elseif($item->subscribe_status=='cancel'){
					$status  = '<button type="button" class="btn btn-info btn-xs">Cancel</button>';
					$action_button = false;
				}elseif($item->subscribe_status=='expire'){
					$status  = '<button type="button" class="btn btn-danger btn-xs">Expire</button>';
					$action_button = false;
				}

				$action = '
				<div class="btn-group">
					<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
					<ul class="dropdown-menu pull-right" role="menu">'.$action_button.'</ul>
				</div>'
				;
				
				return [
					'subscribe_type' => $item->subscribe_type,
					'name' => $name,
					'for' => $item->subscribePayment['subscribe_month'],
					'start' => Carbon\Carbon::parse($item->subscribe_date)->format('H:i:s d-m-Y'),
					'renew' => Carbon\Carbon::parse($item->subscribe_date)->addMonth($item->subscribePayment['subscribe_month'])->format('H:i:s d-m-Y'),
					'status' => $status,
					'action' => $action
                    ];
                })
			->toJson();

	    	break;

    		case "agent_datatable":

			return datatables()->eloquent(user::query()->where('user_role','=','2'))
			->setTransformer(function($item){
				if($item->banned == "N"){
					$status = "<label class='label label-primary'>Active</label>";
				}elseif($item->banned == "Y"){
					$status  = "<label class='label label-danger'>Deactive</label>";
				}

				$action = '
				<div class="btn-group">
					<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="'.url('/agent-details/').'/'.$item->user_id.'" ><i class="fa fa-eye"></i> View</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="agent_status_change" user_id="'.$item->user_id.'" ><i class="fa fa-ioxhost"></i> Change Status</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="cngcom" user_id="'.$item->user_id.'" commission="'.$item->agent_commission[$item->agent_commission->count()-1]['new_rate'].'" ><i class="fa fa-paypal"></i> Change Commission</a>
						</li>
					</ul>
				</div>
				';

				return [
					'user_id' => (int) $item->user_id,
					'name' => (string) $item->userDetails->first_name.' '.$item->userDetails->last_name,
					'username' => $item->username,
					'email' => $item->email,
					'phone' => $item->userDetails->phone,
					'register_date' => (string) Carbon\Carbon::parse($item->register_date)->format('H:i:s d-m-Y'),
					'commission' => $item->agent_commission[$item->agent_commission->count()-1]['new_rate'],
					'banned' => $status,
					'action' => $action,
                    ];
                })
			->toJson();

	    	break;

    		case "transaction_log":

			return datatables()->eloquent(agent_payment::query()->where('agent_id','=',$user_id))
			->orderColumn('agent_payment_id', '-agent_payment_id $1')
			->setTransformer(function($item){

				if($item->payment_status=='paid'){
					$status  = '<button type="button" class="btn btn-primary btn-xs">Paid</button>';
					$action_button = false;
				}elseif($item->payment_status=='due'){
					$status  = '<button type="button" class="btn btn-warning btn-xs">Due</button>';
					$action_button = '<li><a href="javascript:void(0)" class="agent_pay" amount="'.$item->payment_amount.'" payment_id="'.$item->agent_payment_id.'"><i class="fa fa-paypal"></i> Pay</a></li>';
				}elseif($item->payment_status=='cancel'){
					$status  = '<button type="button" class="btn btn-danger btn-xs">Cancel</button>';
					$action_button = false;
				}

				if(!empty($item->pay_document) && file_exists(public_path('/uploads/document/'.$item->pay_document))){
					$document = "<a href='".url('/download-file').'/'.$item->pay_document.'/log_document'."' class='label label-info'><i class='fa fa-file'></i></a>";
				}else{
					$document = '<i class="fa fa-times" aria-hidden="true"></i>';
				}

				$action = '
				<div class="btn-group">
					<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
					<ul class="dropdown-menu pull-right" role="menu">'.$action_button.'</ul>
				</div>
				';

				return [
					'payment_type' => $item->payment_type,
					'subscribe_id' => $item->subscribe_id,
					'subscribe_payment_id' => $item->subscribe_payment_id,
					'payment_date' => (string) Carbon\Carbon::parse($item->payment_date)->format('H:i:s d-m-Y'),
					'payment_amount' => $item->payment_amount,
					'payment_details' => $item->payment_details,
					'payment_status' => $status,
					'document' => $item->pay_document,
					'pay_note' => $item->pay_note,
					'pay_date' => (string) Carbon\Carbon::parse($item->pay_date)->format('d-m-Y'),
					'subscribe_payment_id' => $item->subscribe_payment_id,
					'document' => $document,
					'action' => $action
                    ];
                })
			->toJson();

	    	break;

    		case "commision_log_datatable":

			return datatables()->eloquent(agent_commission::query()->where('agent_id','=',$user_id))
			->orderColumn('commission_id', '-commission_id $1')
			->setTransformer(function($item){

				if(!empty($item->document) && file_exists(public_path('/uploads/document/'.$item->document))){
					$document = "<a href='".url('/download-file').'/'.$item->document.'/log_document'."' class='label label-info'><i class='fa fa-file'></i></a>";
				}else{
					$document = '<i class="fa fa-times" aria-hidden="true"></i>';
				}

				return [
					'commission_id' => (int) $item->commission_id,
					'previous_rate' => $item->previous_rate,
					'new_rate' => $item->new_rate,
					'commission_note' => $item->commission_note,
					'document' => $document,
					'created_at' => (string) Carbon\Carbon::parse($item->created_at)->format('H:i:s d-m-Y')
                    ];
                })
			->toJson();

	    	break;

    		case "sub_domain_datatable":

			return datatables()->eloquent(sub_domain::query()->whereHas('user', function ($query) {
			        $query->where('status_now', '!=', 'Mojammel');
			    }))
			->orderColumn('domain_id', '-domain_id $1')
			->setTransformer(function($item){

				return [
					'domain_id' => (int) $item->domain_id,
					'user_id' => $item->user->userDetails['first_name'].' '.$item->user->userDetails['last_name'],
					'sub_domain' => (string) $item->sub_domain
                    ];
                })
			->toJson();

	    	break;
    		
    		case "super_admin_datatable":

			return datatables()->eloquent(user::query()->where('user_role','=','4'))
			->orderColumn('user_id', '-user_id $1')
			->setTransformer(function($item){

				if($item->banned == "N"){
					$status = "<label class='label label-primary'>Active</label>";
				}elseif($item->banned == "Y"){
					$status  = "<label class='label label-danger'>Deactive</label>";
				}

				$action = '
				<div class="btn-group">
					<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="javascript:void(0)" class="admin_status_change" user_id="'.$item->user_id.'" ><i class="fa fa-ioxhost"></i> Change Status</a>
						</li>
					</ul>
				</div>
				';

				return [
					'user_id' => (int) $item->user_id,
					'name' => (string) $item->userDetails['first_name'].' '.$item->userDetails['last_name'],
					'email' => (string) $item->email,
					'username' => (string) $item->username,
					'permission' => $item->permission,
					'status' => $status,
					'action' => $action
                    ];
                })
			->toJson();

	    	break;

	    	case "subscription_log":

			return datatables()->eloquent(subscribe::query()->whereHas('user', function ($query) {
		        $query->where('status_now', '!=', 'Mojammel');
		    }))
			->orderColumn('subscribe_id', '-subscribe_id $1')
			->setTransformer(function($item){

				if($item->subscribe_status=='active'){
					$status  = '<button type="button" class="btn btn-primary btn-xs">Active</button>';
				}elseif($item->subscribe_status=='inactive'){
					$status  = '<button type="button" class="btn btn-warning btn-xs">Inactive</button>';
				}elseif($item->subscribe_status=='cancel'){
					$status  = '<button type="button" class="btn btn-info btn-xs">Cancel</button>';
				}elseif($item->subscribe_status=='expire'){
					$status  = '<button type="button" class="btn btn-danger btn-xs">Expire</button>';
				}

				$action = '
				<div class="btn-group">
					<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="'.url('/subscribepayment').'/'.$item->subscribe_id.'" ><i class="fa fa-eye"></i> View</a>
						</li>
					</ul>
				</div>
				';

				return [
					'subscribe_id' => (int) $item->subscribe_id,
					'user' => (string) $item->user->userDetails['first_name'].' '.$item->user->userDetails['last_name'],
					'agent' => $item->agentDetails->userDetails['first_name'].' '.$item->agentDetails->userDetails['last_name'],
					'software' => $software ?? "N/A",
					'variation_name' => $variation_name ?? "N/A",
					'subscribe_date' => $item->subscribe_date ,
					'subscribe_billing_trams' =>$item->subscribe_billing_trams,
					'subscribe_cupon' => $item->subscribe_cupon | "N/A",
					'status' => $status,
					'action' => $action
                    ];
                })
			->toJson();

	    	break;

    		case "promocode_datatable":

			return datatables()->eloquent(promocode::query())
			->orderColumn('promocode_id', '-promocode_id $1')
			->setTransformer(function($item){
				if($item->status == "active"){
					$status = "<label class='label label-primary'>".$item->status."</label>";
				}elseif($item->status == "deactive"){
					$status  = "<label class='label label-danger'>".$item->status."</label>";
				}

				if(!empty($item->document)){
					$document = "<a href='".url('/download-file').'/'.$item->document.'/promo_document'."' class='label label-success'><i class='fa fa-file'></i></a>";
				}else{
					$document = "<label class='label label-danger'><i class='fa fa-times'></label>";
				}

				$action = '
				<div class="btn-group">
					<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="javascript:void(0)" class="promocode_status_change" promocode_id="'.$item->promocode_id.'"  ><i class="fa fa-ioxhost"></i> Change Status</a>
						</li>
					</ul>
				</div>
				';

				return [
					'promocode_id' => (int) $item->promocode_id,
					'title' => (string) $item->title,
					'code' => $item->code,
					'amount' => $item->amount,
					'publish_for' => (string) $item->publish_for,
					'use_limit' => (int) $item->use_limit,
					'used' => (int) $item->used,
					'created_at' => (string) Carbon\Carbon::parse($item->created_at)->format('H:i:s d-m-Y'),
					'expiry' => (string) Carbon\Carbon::parse($item->expiry)->format('d-m-Y'),
					'status' => $status,
					'document' => $document,
					'action' => $action,
                    ];
                })
			->toJson();

	    	break;

	    	case "activity_log_datatable":

			return datatables()->eloquent(activitylog::query())
			->orderColumn('log_id', '-log_id $1')
			->setTransformer(function($item){

				if(!empty($item->note)){
					$note = "<a href='javascript:void(0)' class='label label-warning note' note='$item->note' ><i class='fa fa-sticky-note'></i></a>";
				}else{
					$note = "<i class='fa fa-times'></i>";
				}

				if(!empty($item->document)){
					$document = "<a href='".url('/download-file').'/'.$item->document.'/log_document'."' class='label label-info'><i class='fa fa-file'></i></a>";
				}else{
					$document = "<i class='fa fa-times'></i>";
				}

				return [
					'log_id' => (int) $item->log_id,
					'subject' => (string) $item->subject,
					'resone' => (string) $note,
					'document' => $document,
					'ip' => (string) $item->ip,
					'agent' => (string) $item->agent,
					'user_id' => (string) $item->userDetails['first_name'].' '.$item->userDetails['last_name'],
					'created_at' => (string) Carbon\Carbon::parse($item->created_at)->format('H:i:s d-m-Y'),
                    ];
                })
			->toJson();

	    	break;
	    	case "tc_datatable":
	    	
			return datatables()->eloquent(termsandcondition::query())
	    	->setTransformer(function($item){
				if($item->status == "active"){
					$status = "<label class='label label-primary'>".ucwords($item->status)."</label>";
				}elseif($item->status == "deactive"){
					$status  = "<label class='label label-danger'>".ucwords($item->status)."</label>";
				}

				if(!empty($item->document)){
					$document = "<a href='".url('/download-file').'/'.$item->document.'/terms&condition'."' class='btn btn-sm btn-success'><i class='fa fa-file'></i></a>";
				}else{
					$document = "<label class='label label-danger'><i class='fa fa-times'></label>";
				}
				if(!empty($item->body_text)){
					$body="<button class='btn btn-sm btn-success' onclick='show_modal(this)' text='".$item->body_text."'><i class='fa fa-eye'></button>";
				}
				$user = userDetails::find($item->added_by);
				$username = $user['first_name'].' '.$user['last_name'];
				$action = '
				<div class="btn-group">
					<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="'.url('/terms-condition/edit/').'/'.$item->t_c_id.'" ><i class="fa fa-edit"></i> Edit</a>
						</li>
						<li>
							<a href="'.url('/terms-condition/delete/').'/'.$item->t_c_id.'" ><i class="fa fa-trash"></i> Delete</a>
						</li>
					</ul>
				</div>
				';

				return [
					't_c_id'   => $item->t_c_id,
					'body'     => $body,
					'added_by' => $username,
					'status'   => $status,
					'document' => $document,
					'action'   => $action,
                    ];
                })->toJson();

	    	break;

	    	default:

	    	break;
	    }
    }
}
