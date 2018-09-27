<?php

namespace Vanguard\Http\Controllers\Web;

use Cache;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Device\DeviceRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Device;
use Vanguard\Transaction;
use Vanguard\User;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vanguard\Repositories\Transaction\TransactionRepository;
use Vanguard\TransactionDetails;
use Vanguard\Support\Enum\TransactionType;
use Illuminate\Support\Facades\Input;


/**
 * Class RolesController
 * @package Vanguard\Http\Controllers
 */
class TransactionController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $devices;
    private $transaction;

    /**
     * RolesController constructor.
     * @param RoleRepository $roles
     */
    public function __construct(DeviceRepository $devices,TransactionRepository $transaction,UserRepository $users)
    {
		$this->middleware('auth');
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);
        $this->middleware('permission:Transactions');
        $this->devices = $devices;
		$this->users = $users;
        $this->transaction = $transaction;
    }

    /**
     * Display page with all available roles.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $transactions = $this->transaction->findByUser(Auth::user()->present()->id,Input::get('search_phone'), Input::get('search_date'), Input::get('device_number'), Input::get('transaction_type'));
		
		$transaction_type = ['' => trans('app.all')." ".trans('app.transaction_type')] + TransactionType::lists();
		
		$device_number = ['' => trans('app.all')." ".trans('app.device_number')] +$this->devices->get_device_number(Auth::user()->present()->id)->toArray();
		$device_numbers = [];
		$i=0;
		foreach($device_number as $d_number){
			if($i==0){
				$device_numbers[] = $d_number;
			} else {
				$device_numbers[$d_number] = $d_number;
			}
			$i++;
		}
		$device_number = $device_numbers;
		
		return view('transaction.index', compact('transactions','transaction_type','device_number'));
    }

    /**
     * Display form for creating new role.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $edit = false;
		$profile = false;
        return view('company.add-edit', compact('edit','profile'));
    }

    /**
     * Store newly created role to database.
     *
     * @param CreateRoleRequest $request
     * @return mixed
     */
    public function store(CreateCompanyRequest $request)
    {
        $this->companies->create($request->all());

        return redirect()->route('company.index')
            ->withSuccess(trans('app.company_created'));
    }

    /**
     * Display for for editing specified role.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Device $device)
    {
        return view('device.view', compact('device'));
    }

    /**
     * Update specified role with provided data.
     *
     * @param Role $role
     * @param UpdateRoleRequest $request
     * @return mixed
     */
    public function update(Company $company, UpdateCompanyRequest $request)
    {
		$data = $request->all();
		
		$profile = 0;
		if($data["profile"] == 1){
			$profile = 1;
		}
		
		unset($data["profile"]);
        $this->companies->update($company->id, $data);
		
		if($profile == 1){
			return redirect()->route('company.profile.edit')
				->withSuccess(trans('app.company_updated'));
		} else {
			//event(new Updated($company));
			return redirect()->route('company.index')
				->withSuccess(trans('app.company_updated'));
		}
		
    }

    /**
     * Remove specified role from system.
     *
     * @param Role $role
     * @param UserRepository $userRepository
     * @return mixed
     */
    public function delete(Device $device, DeviceRepository $deviceRepository)
    {
        /* if (! $role->removable) {
            throw new NotFoundHttpException;
        }

        $userRole = $this->roles->findByName('User');

        $userRepository->switchRolesForUsers($role->id, $userRole->id);
 */
		$data["status"] = PhoneStatus::BANNED;
        $this->devices->update($device->id,$data);

        Cache::flush();

        return redirect()->route('device.index')
            ->withSuccess(trans('app.device_disabled'));
    }
	
	public function activate(Device $device, DeviceRepository $deviceRepository)
    {
        /* if (! $role->removable) {
            throw new NotFoundHttpException;
        }

        $userRole = $this->roles->findByName('User');

        $userRepository->switchRolesForUsers($role->id, $userRole->id);
 */
		$data["status"] = PhoneStatus::ACTIVE;
        $this->devices->update($device->id,$data);

        Cache::flush();

        return redirect()->route('device.index')
            ->withSuccess(trans('app.device_actiavated'));
    }
	
	/**
     * Update company's avatar from some external source (Gravatar, Facebook, Twitter...)
     *
     * @param User $user
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatarExternal(Company $company, Request $request, CompanyAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded($company);

        $this->companies->update($company->id, ['avatar' => $request->get('url')]);

       // event(new UpdatedByAdmin($user));

        return redirect()->route('company.profile.edit')
            ->withSuccess(trans('app.avatar_changed'));
    }
	
	public function updateAvatar(Company $company, CompanyAvatarManager $avatarManager, Request $request)
    {
        $this->validate($request, ['avatar' => 'image']);

        if ($name = $avatarManager->uploadAndCropAvatar($company)) {
			
            $this->companies->update($company->id, ['avatar' => $name]);

            return redirect()->route('company.profile.edit')
                ->withSuccess(trans('app.avatar_changed'));
        }

        return redirect()->route('company.profile.edit')
            ->withErrors(trans('app.avatar_not_changed'));
    }
	
	public function editCompany()
    {
        $edit = true;
		$profile = true;
		$company = $this->companies->findByCode(Auth::user()->present()->company_code);
		
		$updateUrl = route('company.update.avatar.external', $company->id);
        return view('company.add-edit', compact('edit', 'company','updateUrl','profile'));
    }
	
	public function view(Transaction $transaction)
    {
		$user = $this->users->find($transaction->user_id);
		if(Auth::user()->hasRole('Admin')){
			$flag = true;
		} else if(Auth::user()->hasRole('CompanyAdmin')){
			
			if(Auth::user()->company_code == $user->company_code) {
				$flag = true;
			} else {
				$flag = false;
			}
		} else if(Auth::user()->company_code == $user->id){
			$flag = true;
		} else {
			$flag = false;
		}
		
		if($flag){
			$transaction = $this->transaction->find($transaction->id);
			$transaction_details = $transaction->details()->get();
			$transaction_key_array = array("sid","date_created","date_updated","date_sent","from","account_sid");
			return view('transaction.view', compact('transaction','transaction_details','transaction_key_array'));
		} else {
			return abort('403');
		}
		
    }

}