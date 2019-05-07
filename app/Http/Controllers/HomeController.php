<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Carbon;
	use Hash;
	use Session;
	use DB;
	use Config;
	use App\Model\user;
	use App\Model\subscribePayment;
	use ActivityLog;
	
	class HomeController extends Controller
	{
		public function __construct()
	    {
	        // ActivityLog::addToLog('Using HomeController.');
	    }

	    public function test(){
			return view('test');
		}

		public function test_submit(Request $request){
			
		}

		public function dashboard(){

			$current_date = Carbon::now()->format('Y-m-d');
			
			$data=array(
			'today_user'=>0,
			'total_user'=>0,
			'total_active_user'=>0,
			'total_inactive_user'=>0,
			'today_agent'=>0,
			'total_agent'=>0,
			'total_active_agent'=>0,
			'total_inactive_agent'=>0,
			'total_bill'=>0,
			'total_paid_bill'=>0,
			'total_unpaid_bill'=>0,
			'total_support'=>0,
			'total_pending_support'=>0,
			'total_complete_support'=>0,
			);
			/*
				User Data 
			*/
			$today_user=user::whereDate('register_date',$current_date)->where('user_role','=','1')->where('status_now', '!=', 'Mojammel')->count();
			$data['today_user']=$today_user;
			$total_user=user::where('user_role','=','1')->where('status_now', '!=', 'Mojammel')->count();
			$data['total_user']=$total_user;
			$total_active_user=user::where('banned','=','N')->where('user_role','=','1')->where('status_now', '!=', 'Mojammel')->count();
			$data['total_active_user']=$total_active_user;
			$total_inactive_user=user::where('banned','=','Y')->where('user_role','=','1')->where('status_now', '!=', 'Mojammel')->count();
			$data['total_inactive_user']=$total_inactive_user;
			/*
				Agent Data 
			*/
			$today_agent=user::whereDate('register_date',$current_date)->where('user_role','=','2')->count();
			$data['today_agent']=$today_agent;
			$total_agent=user::where('user_role','=','2')->count();
			$data['total_agent']=$total_agent;
			$total_active_agent=user::where('user_role','=','2')->where('banned','=','N')->count();
			$data['total_active_agent']=$total_active_agent;
			$total_inactive_agent=user::where('user_role','=','2')->where('banned','=','Y')->count();
			$data['total_inactive_agent']=$total_inactive_agent;
			
			$total_bill = subscribePayment::whereHas('user', function ($query) {
								        $query->where('status_now', '!=', 'Mojammel');
								    })->count();
			$data['total_bill']=$total_bill;
			$total_paid_bill=subscribePayment::where('subscribe_payment_status','=','paid')
			->whereHas('user', function ($query) {
		        $query->where('status_now', '!=', 'Mojammel');
		    })->count();
			$data['total_paid_bill']=$total_paid_bill;
			$total_unpaid_bill=subscribePayment::where('subscribe_payment_status','=','due')
			->whereHas('user', function ($query) {
		        $query->where('status_now', '!=', 'Mojammel');
		    })->count();
			$data['total_unpaid_bill']=$total_unpaid_bill;
			
			return view('SuperAdmin.dashboard',compact('data'));
		}  

		public function login(){
			if (Session::get('admin_data')[0] ['admin_id']){
				return redirect('/dashboard');
				}else{
				return view('SuperAdmin.login');
			}
		}
		
		public function login_submit(Request $login){
			$user_admin_data = user::with('userDetails')->where(['username' => $login->input('username'), 'user_role' => '4'])->first();
			
			if (isset($user_admin_data)) {
				
				if ($this->hashPassword(hash('sha512',$login->input('password'))) == $user_admin_data->password){
					
					if ($user_admin_data->banned=='N') {
						$session_data = [
						'admin_id' => $user_admin_data->user_id,
						'email' => $user_admin_data->email,
						'username' => $user_admin_data->username,
						'register_date' => $user_admin_data->register_date,
						'permission' => $user_admin_data->permission,
						'first_name' => $user_admin_data->userDetails->first_name,
						'last_name' => $user_admin_data->userDetails->last_name,
						];
						
						Session::push('admin_data', $session_data);
						
						$redirect = array('url' => url('/dashboard'), 'status' => 'true');
						return Response()->json($redirect);

						}else{
							$error_message = array('msg' => 'Sorry, Your account is temporary blocked !!', 'status' => 'false');
							return Response()->json($error_message);
						}
					
					}else{
						$error_message = array('msg' => 'Password do not match!', 'status' => 'false');
						return Response()->json($error_message);
					}
				
				}else{
					$error_message = array('msg' => 'Username or Password do not match!', 'status' => 'false');
					return Response()->json($error_message);
				}			
		}
		
		public function logout(Request $logout){
			Session::flush();
			return redirect('/');
		}
		
		private function hashPassword($password){
			$salt = "$2a$" . PASSWORD_BCRYPT_COST . "$" . PASSWORD_SALT;
			if (PASSWORD_ENCRYPTION == "bcrypt") {
				return crypt($password, $salt);
			}
			
			$newPassword = $password;
			for ($i = 0; $i < PASSWORD_SHA512_ITERATIONS; $i++) {
				$newPassword = hash('sha512', $salt.$newPassword.$salt);
			}
		}

		public function change_password(Request $change_password){
			$user_data = user::find(session('admin_data')[0]['admin_id']);

			if ($this->hashPassword(hash('sha512',$change_password->input('current_password'))) !== $user_data->password){
				$response = array('msg' => 'The password you have entered does not match your current one.', 'status' => 'error');
				return Response()->json($response);
			}else{
				$new_password = $this->hashPassword(hash('sha512',$change_password->input('new_password')));

				$user_data->password = $new_password;
				$user_data->save();

				$arr = array('msg' => 'Password changed successfully.', 'status' => 'success');
				return Response()->json($arr);
			}
		}

		public function download_file($filename,$for){
			$file = public_path('/uploads/document/'.$filename );
			if(!empty($filename) && file_exists($file)){
				$extention = substr($filename, strpos($filename, ".") + 1);
				$headers = array(
			              'Content-Type: application/'.$extention,
			            );
				return Response()->download($file,$for.'.'.$extention);
			}else{
				abort(404);
			}
		}

		public function activity_log(){
			return view('SuperAdmin.activity_log');
		}
	}