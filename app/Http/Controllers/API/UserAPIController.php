<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\CustomFieldRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Localbank;
use App\Models\EProvider;


class UserAPIController extends Controller
{
    private $userRepository;
    private $uploadRepository;
    private $roleRepository;
    private $customFieldRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, UploadRepository $uploadRepository, RoleRepository $roleRepository, CustomFieldRepository $customFieldRepo)
    {
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->roleRepository = $roleRepository;
        $this->customFieldRepository = $customFieldRepo;
    }

    function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {

            // Authentication passed...
            $user = auth()->user();
            $user->device_token = $request->input('device_token', '');
            $user->save();
            $user->getRoleNames()->toArray();

            return $this->sendResponse($user, 'Signin Successful');
        } else {

            return response()->json([
                'type' => 'error', 'message' => trans('Account Email or Password Error')
            ], 400);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return
     */
    function register(Request $request)
    {
        $validator = Validator::make($request->all(), User::$rules);


        if ($validator->fails()) {

            $msd = array('email' => 'The email address has already been taken');

            return response()->json([
                'type' => 'error', 'message' => $msd
            ], 400);
        } else {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->device_token = $request->input('device_token', '');
            $user->password = Hash::make($request->input('password'));
            $user->api_token = Str::random(60);
            $user->mac_adddress = $request->input('mac_adddress');
            $user->ip_address = $request->input('ip_address');
            $user->acctype = $request->input('acctype');
            $user->save();

            $uuid = $user->id;

            if ($request->input('acctype')  == 'customer') {
                $defaultRoles = $this->roleRepository->findByField('default', '1');
                $defaultRoles = $defaultRoles->pluck('name')->toArray();
                $user->assignRole($defaultRoles);
            } else {

                $defaultRoles = $this->roleRepository->findByField('name', 'vendor');
                $defaultRoles = $defaultRoles->pluck('name')->toArray();
                $user->assignRole($defaultRoles);
                $user->provider()->save(new EProvider());
            }

            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());

            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $user->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }

            $userdata = $this->userRepository->findWithoutFail($uuid);
            $userdata->getRoleNames()->toArray();


            return $this->sendResponse($userdata, 'Account created successfully');
        }
    }

    function logout(Request $request)
    {
        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();
        if (!$user) {
            return $this->sendError('User not found', 200);
        }
        try {
            auth()->logout();
        } catch (Exception $e) {
            $this->sendError($e->getMessage(), 200);
        }
        return $this->sendResponse($user['name'], 'User logout successfully');
    }

    function user(Request $request)
    {
        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();
        $user->getRoleNames()->toArray();

        if (!$user) {
            return $this->sendError('User not found', 200);
        }



        return $this->sendResponse($user, 'User retrieved successfully');
    }

    function validatebvn(Request $request)
    {

        $bvn = isset($_GET['bvn']) ? $_GET['bvn'] : '';

        $url = 'https://api.paystack.co/bank/resolve_bvn/' . $bvn;
        $header = array(
            'Authorization: Bearer ' . env('PAYSTACK_SECRET')
        );
        $curl_response = $this->initGetCurl($url, $header);

        $response = json_decode($curl_response);

        if ($response->status == true) {

            return response()->json($response, 200);
        } else {

            $msd = "BVN Verification Failed";
            return response()->json([
                'type' => 'error', 'message' => $msd
            ], 400);
        }
    }

    function Addvalidatebvn(Request $request)
    {

        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();

        $user->bvn = $request->bvn;
        $user->bvnname = $request->bvnname;
        $user->bvndob = $request->bvndob;
        $user->bvnphone = $request->bvnmobile;
        $user->save();

        $success = trans('BVN Verified Successfully');

        return response()->json([
            'type' => 'success', 'message' => $success
        ]);
    }


    function addwithdrawal(Request $request)
    {
    }



    function validateaccount(Request $request)
    {

        $acc_num = $request->accnum;
        $bankcode = $request->bcode;

        $url = 'https://api.paystack.co/bank/resolve?account_number=' . $acc_num . '&bank_code=' . $bankcode;
        $header = array(
            'Authorization: Bearer ' . env('PAYSTACK_SECRET')
        );
        $curl_response = $this->initGetCurl($url, $header);

        $response = json_decode($curl_response);

        if ($response->status == true) {

            return response()->json($response, 200);
        } else {

            $msd = "Account Not Found";
            return response()->json([
                'type' => 'error', 'message' => $msd
            ], 400);
        }
    }

    function banklist()
    {

        $localbank = Localbank::all();

        return response()->json($localbank, 200);
    }

    function resentOTP()
    {

        $phone = isset($_GET['phone']) ? $_GET['phone'] : '';

        $code = DB::table('temptable')->where('phone', $phone)->orderBy('id', 'DESC')->count();

        if ($code) {

            $characters = '0123456789';
            $activationKey = '';
            $max = strlen($characters) - 1;
            for ($i = 0; $i < 6; $i++) {
                $activationKey .= $characters[mt_rand(0, $max)];
            }

            DB::table('temptable')
                ->where('phone', $phone)
                ->update(['code' => $activationKey]);


            $sval = urlencode('Dear Customer, The OTP to Verify Phone Number is ' . $activationKey);


            $res  = file_get_contents("http://www.daftsms.com/sms_api.php?username=Ehis&password=emma123&sender=CarryWork&dest=$phone&msg=$sval");


            if ($res == '146') {

                return $this->sendResponse(true, 'Verification OTP Sent successfully', 200);
            } else {

                return $this->sendError('Code Not Send Try Again', 400);
            }
        } else {

            return $this->sendError('Code Not Send Try Again', 400);
        }
    }

    function sendVerificationSms(Request $request)
    {


        $phone = isset($_GET['phone']) ? $_GET['phone'] : '';

        $characters = '0123456789';
        $activationKey = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 6; $i++) {
            $activationKey .= $characters[mt_rand(0, $max)];
        }

        $code = DB::table('temptable')->where('phone', $phone)->where('status', 1)->orderBy('id', 'DESC')->count();

        if ($code < 1) {

            DB::table('temptable')->insert([
                [
                    'phone' => $phone,
                    'code' => $activationKey
                ],
            ]);


            $sval = urlencode('Dear Customer, The OTP to Verify Phone Number is ' . $activationKey);


            $res  = file_get_contents("http://www.daftsms.com/sms_api.php?username=Ehis&password=emma123&sender=CarryWork&dest=$phone&msg=$sval");


            if ($res == '146') {

                return $this->sendResponse(true, 'Verification OTP Sent successfully', 200);
            } else {

                return $this->sendError('Code Not Send Try Again', 400);
            }
        } else {

            $msd = "The Phone Number has already been taken";

            return response()->json([
                'type' => 'error', 'message' => $msd
            ], 400);
        }
    }

    function VerifyCode()
    {
        $phone = isset($_GET['code']) ? $_GET['code'] : '';

        $code = DB::table('temptable')->where('code', $phone)->orderBy('id', 'DESC')->first();

        if ($code) {

            DB::table('temptable')
                ->where('code', $phone)
                ->update(['status' => 1]);

            return $this->sendResponse(true, 'Verification successfully', 200);
        } else {

            return $this->sendError('Code Not Found', 400);
        }
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param Request $request
     *
     */
    public function update($id, Request $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }
        $input = $request->except(['api_token']);
        try {
            if ($request->has('device_token')) {
                $user = $this->userRepository->update($request->only('device_token'), $id);
            } else {
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());
                if (isset($input['password'])) {
                    $input['password'] = Hash::make($request->input('password'));
                }
                $user = $this->userRepository->update($input, $id);

                foreach (getCustomFieldsValues($customFields, $request) as $value) {
                    $user->customFieldsValues()
                        ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
                }
            }
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage(), 200);
        }

        return $this->sendResponse($user, __('lang.updated_successfully', ['operator' => __('lang.user')]));
    }

    function sendResetLinkEmail(Request $request): JsonResponse
    {
        try {
            $this->validate($request, ['email' => 'required|email|exists:users']);
            $response = Password::broker()->sendResetLink(
                $request->only('email')
            );
            if ($response == Password::RESET_LINK_SENT) {
                return $this->sendResponse(true, 'Reset link was sent successfully');
            } else {
                return $this->sendError('Reset link not sent');
            }
        } catch (ValidationException $e) {
            return $this->sendError($e->getMessage());
        } catch (Exception $e) {
            return $this->sendError("Email not configured in your admin panel settings");
        }
    }

    public function initGetCurl($url, $header)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        if (curl_error($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
}
