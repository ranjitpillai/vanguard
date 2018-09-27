<?php

namespace Vanguard\Http\Controllers\Web;

use Cache;
use Vanguard\Http\Controllers\Controller;
/* use Vanguard\Events\Company\Created;
use Vanguard\Events\Company\Deleted;
use Vanguard\Events\Company\Updated; */
use Vanguard\Http\Requests\Company\CreateCompanyRequest;
use Vanguard\Http\Requests\Company\UpdateCompanyRequest;
use Vanguard\Repositories\Device\DeviceRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Presenters\UserPresenter;
use Vanguard\Services\Upload\CompanyAvatarManager;
use Vanguard\Support\Enum\PhoneStatus;
use Vanguard\Device;
use Vanguard\User;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vanguard\Repositories\Transaction\TransactionRepository;
use Vanguard\TransactionDetails;


/**
 * Class RolesController
 * @package Vanguard\Http\Controllers
 */
class DeviceController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $devices;
    private $transaction;
    private $users;

    /**
     * RolesController constructor.
     * @param RoleRepository $roles
     */
    public function __construct(DeviceRepository $devices,TransactionRepository $transaction,UserRepository $users)
    {
		$this->middleware('auth');
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);
        $this->middleware('permission:devices');
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
        $devices = $this->devices->get_devices(Auth::user()->present()->id);
        $active_devices = $this->devices->get_active_devices(Auth::user()->present()->id);
        $deactive_devices = $this->devices->get_deactive_devices(Auth::user()->present()->id);
		
		return view('device.index', compact('devices','deactive_devices','active_devices'));
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
	
	public function view(Device $device)
    {
		$flag = false;
		$user = $this->users->find($device->user_id);
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
			$transactions = $this->transaction->findByDeviceID($device->device_id);
			return view('device.view', compact('device','transactions'));
		} else {
			return abort('403');
		}
    }

}