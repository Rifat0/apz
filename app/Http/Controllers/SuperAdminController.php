<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Hash;
	use App\Model\user;
	use App\Model\userDetails;
	use App\Model\promocode;
	use App\Model\subscribePayment;
	use App\Model\agent_payment;
	use App\Model\sub_domain;
	use App\Model\subscribe;
	use App\Model\pos_requirements;
	use App\Model\agent_commission;
	use Image;
	use Carbon;
	use ActivityLog;

	class SuperAdminController extends Controller
	{
		public function __construct()
	    {
	        // ActivityLog::addToLog('Using SuperAdminController.');
	    }
		    
		public function user_manage(){
			return view('SuperAdmin.user_manage');
		}
		
		public function user_view($id){
			$user_data = user::find($id);
			$plugins=user::whereHas('subscribtion', function ($query) {
		        $query->where('subscribe_type', '=', 'plugins');
		    })->count();
			return view('SuperAdmin.user_details',compact('user_data','plugins'));			
		}
		
		public function user_status_change(Request $status){
			if($status->hasFile('document')){
	    		$document = $status->file('document');
	    		$filename = time() . '.' . $document->getClientOriginalExtension();
	    		Image::make($document)->save( public_path('/uploads/document/' . $filename ) );
	    	}else{
	    		$filename = false;
	    	}
			    	
			$find = user::find($status->user_id);
			if ($find->banned =="N"){
				$from = "Active";
				user::where('user_id', '=', $status->user_id)->update(array('banned' => 'Y'));
				$to = "Deactive";
			}elseif($find->banned=="Y"){
				$from = "Deactive";
				user::where('user_id', '=', $status->user_id)->update(array('banned' => 'N'));
				$to = "Active";
			}
			ActivityLog::addToLog($find->userDetails['first_name'].' '.$find->userDetails['last_name'].' status changed from '.$from.' to '.$to,$status->resone,$filename);
			$arr = array('msg' => 'Successfully status changed.', 'user' => $find->username);
			return Response()->json($arr);			
		}

		public function subscribe_change(Request $subscribe){	
			
			if($subscribe->hasFile('document')){
	    		$document = $subscribe->file('document');
	    		$filename = time() . '.' . $document->getClientOriginalExtension();
	    		Image::make($document)->save( public_path('/uploads/document/' . $filename ) );
	    	}else{
	    		$filename = false;
	    	}

			$subscribe_details = subscribe::find($subscribe->subscribe_id);
			$subscribe_details->subscribe_status = $subscribe->todo;
			$subscribe_details->save();

			if(!empty($subscribe_details->plugins_id)){
				$name  = $subscribe_details->plugin->plugins_name;
			}elseif(empty($subscribe_details->plugins_id)){
				$name  = $subscribe_details->software->software_title;
			}
			ActivityLog::addToLog($subscribe_details->user->userDetails['first_name'].' '.$subscribe_details->user->userDetails['last_name'].' '.$name.' status changed to '.$subscribe->todo,$subscribe->resone,$filename);

			$arr = array('msg' => 'Successfully status changed.', 'status' => true);
			return Response()->json($arr);
		}
		
		public function agent_manage(){
			return view('SuperAdmin.agent_manage');
		}
		
		public function subdomain_manage(){
			return view('SuperAdmin.subdomain_manage');
		}

		public function agentdetails($agent_id){
			$user_data = user::find($agent_id);
			return view('SuperAdmin.agent_details',compact('user_data'));
		}

		public function commission_submit(Request $submit){

			if($submit->hasFile('document')){
	    		$document = $submit->file('document');
	    		$filename = time() . '.' . $document->getClientOriginalExtension();
	    		Image::make($document)->save( public_path('/uploads/document/' . $filename ) );
	    	}else{
	    		$filename = false;
	    	}

			$commission = new agent_commission;
			$commission->agent_id = $submit->user_id;
			$commission->previous_rate = $submit->old_commission;
			$commission->new_rate = $submit->commission;
			$commission->commission_note = $submit->commission_note;
			$commission->document = $filename;
			$commission->save();

			$user_info = user::find($submit->user_id);

			ActivityLog::addToLog($user_info->userDetails['first_name'].' '.$user_info->userDetails['last_name'].' commission changed from '.$submit->old_commission.' to '.$submit->commission);

			$arr = array('msg' => 'Successfully commission changed.', 'status' => true);
			return Response()->json($arr);
		}
		
		public function agent_pay(Request $agent_pay){
			
			if($agent_pay->hasFile('payment_document')){
	    		$document = $agent_pay->file('payment_document');
	    		$filename = time() . '.' . $document->getClientOriginalExtension();
	    		Image::make($document)->save( public_path('/uploads/document/' . $filename ) );
	    	}else{
	    		$filename = false;
	    	}

			$agent_payment = agent_payment::find($agent_pay->payment_id);
			$agent_payment->pay_document = @$filename;
			$agent_payment->pay_note = $agent_pay->payment_note;
			$agent_payment->pay_date = Carbon::now();
			$agent_payment->payment_status = 'paid';
			$agent_payment->save();

			ActivityLog::addToLog($agent_payment->agent->userDetails['first_name'].' '.$agent_payment->agent->userDetails['last_name'].' agent bill paid by '.$agent_pay->amount,false,$filename);

			$arr = array('msg' => 'Payment action successful.', 'status' => true);
			return Response()->json($arr);
		}
		
		public function super_admin_manage(){
			return view('SuperAdmin.super_admin_manage');
		}
		
		public function super_admin_submit(Request $superadmin){
			if(!empty($superadmin->account) && !empty($superadmin->maintainer)){
				$comma = ',';
			}else{
				$comma = false;
			}

			$permission = $superadmin->account.$comma.$superadmin->maintainer;
			
			$user = new user;

			$pass = '$2a$13$UPj8EVJWvP73FZ9Ih0xzUebANa.Jwzy83Q4Nij.mDbivHo2pDGRE.';
	        $user->username = $superadmin->mobile;
	        $user->email = $superadmin->email;
	        $user->password = $pass;
	        $user->user_role = "4";
	        $user->permission = $permission;

	        if ($user->save()) {
                $last_insert_id = $user->user_id;

                $userDetails = new userDetails;

    	        $userDetails->user_id = $last_insert_id;
    	        $userDetails->first_name = $superadmin->first_name;
    	        $userDetails->last_name = $superadmin->last_name;
    	        $userDetails->dob = $superadmin->dob;
    	        $userDetails->phone = $superadmin->mobile;

    			$userDetails->save();
            }

            $arr = array('msg' => 'Successfully super admin added.', 'status' => true);
	        return Response()->json($arr);
		}		
		
		public function subscribelist(){
			return view('SuperAdmin.subscribelist');
		}
		
		public function subscribe_details($subscribe_id){
			$check_result = subscribePayment::where('subscribe_id','=',$subscribe_id)->get();
			return view('SuperAdmin.subscribedetails',compact('check_result'));
		}
		
		public function manualactive($subscribe_id){
			$subscribePayment = subscribePayment::where('subscribe_id','=',$subscribe_id);
			$subscribePayment->payment_method = "Office Cash";
			$subscribePayment->subscribe_payment_status = "paid";
			$subscribePayment->save();

			if ($subscribePayment->agent_id!=null) {
				$check_payment = agent_payment::where('subscribe_payment_id','=',$subscribePayment->subscribe_payment_id)->first();
				if ($check_payment==null) {
					$agent_commission = $subscribePayment->payment_amount * AGENT_COMMISSION / 100;

					$payment_details = "You have received ".$agent_commission." TK Commission for Software Subscription From user id :".$subscribePayment->user_id;

					$agent_payment = new agent_payment;

			        $agent_payment->user_id = $subscribePayment->user_id;
			        $agent_payment->agent_id = $subscribePayment->agent_id;
			        $agent_payment->subscribe_id = $subscribePayment->subscribe_id;
			        $agent_payment->subscribe_payment_id = $subscribePayment->subscribe_payment_id;
			        $agent_payment->payment_method = $subscribePayment->payment_method;
			        $agent_payment->payment_status = "due";

			        $agent_payment->save();

			    } else {
					
					$agent_payment = agent_payment::where('subscribe_payment_id','=',$subscribePayment->subscribe_payment_id);
					$agent_payment->payment_method = $subscribePayment->payment_method;
					$agent_payment->payment_date = Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s');
					$agent_payment->payment_amount = $agent_commission;
					$agent_payment->payment_details = $payment_details;
					$agent_payment->payment_status = $subscribePayment->subscribe_payment_status;
					$agent_payment->save();

				}
				
			}			

			$subscribe = subscribe::find($subscribe_id);
			$subscribe->subscribe_status = "active";
			$subscribe->save();

			return redirect()->back();
		}
		
		public function pos_requirements(){
			$pos_requirements=pos_requirements::whereHas('user', function ($query) {
		        $query->where('status_now', '!=', 'Mojammel');
		    })->get();
			return view('SuperAdmin.pos_requirements',compact('pos_requirements'));
		}

		public function promotion(){
			return view('SuperAdmin.promotion_manage');
		}

		public function promocode_list(){
			return datatables()->eloquent(promocode::query())
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
							<a href="'.url('/promocode-status/').'/'.$item->promocode_id.'" ><i class="fa fa-ioxhost"></i> Change Status</a>
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
		}

		public function promocode_submit(Request $promocode){	
			
			if($promocode->hasFile('document')){
	    		$document = $promocode->file('document');
	    		$filename = time() . '.' . $document->getClientOriginalExtension();
	    		Image::make($document)->save( public_path('/uploads/document/' . $filename ) );
	    	}

			$promocodes = new promocode;

	        $promocodes->title = $promocode->title;
	        $promocodes->code = $promocode->code;
	        $promocodes->amount = $promocode->amount;
	        $promocodes->publish_for = $promocode->publish_for;
	        $promocodes->use_limit = $promocode->use_limit;
	        $promocodes->expiry = $promocode->expiry;
	        $promocodes->document = @$filename;

	        $promocodes->save();
			$arr = array('msg' => 'Successfully promocode added.', 'status' => true);
			return Response()->json($arr);
		}

		public function promocode_delete($id){
			promocode::where('promocode_id', $id)->delete();
			return redirect('/promotion-manage');
		} 

		public function promocode_status($id){
			$promocodes = promocode::findOrFail($id);
			if($promocodes->status == "deactive"){
		        $promocodes->status = "active";
		    } elseif($promocodes->status == "active") {
		        $promocodes->status = "deactive";
		    }
			$promocodes->save();
			return redirect('/promotion-manage');
		}                   
	}
