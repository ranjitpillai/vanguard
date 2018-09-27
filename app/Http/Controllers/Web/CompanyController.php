<?php

namespace Vanguard\Http\Controllers\Web;
use Cache;
use Vanguard\Http\Controllers\Controller;
/* use Vanguard\Events\Company\Created;
use Vanguard\Events\Company\Deleted;
use Vanguard\Events\Company\Updated; */
use Vanguard\Http\Requests\Company\CreateCompanyRequest;
use Vanguard\Http\Requests\Company\UpdateCompanyRequest;
use Vanguard\Http\Requests\Company\UpdateAddressDetailsRequest;
use Vanguard\Repositories\Company\CompanyRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Services\Upload\CompanyAvatarManager;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Company;
use Vanguard\User;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class RolesController
 * @package Vanguard\Http\Controllers
 */
class CompanyController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $companies;

    /**
     * RolesController constructor.
     * @param RoleRepository $roles
     */
    public function __construct(CompanyRepository $companies)
    {
		$this->middleware('auth');
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);
       // $this->middleware('permission:manage.companies');
        $this->companies = $companies;
    }

    /**
     * Display page with all available roles.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
		
        $companies = $this->companies->getAllWithCompanyUsersCount();
		return view('company.index', compact('companies'));
    }
	
	public function users(Company $company)
    {
        $company_users = $this->companies->getAllCompanyUsers($company->id);
		return view('company.users', compact('company_users'));
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
        return view('company.add', compact('edit','profile'));
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
    public function edit(Company $company,CountryRepository $countryRepository)
    {
        $edit = true;
		$profile = false;
		$updateUrl = route('company.update.avatar.external', $company->id);
        $countries = $this->parseCountries($countryRepository);
        $company_users = $this->companies->getAllCompanyUsers($company->id);
		
        return view('company.edit', compact('edit', 'company','updateUrl','profile','countries','company_users'));
    }

    private function parseCountries(CountryRepository $countryRepository)
    {
        return [0 => 'Select a Country'] + $countryRepository->lists()->toArray();
    }

    /**
     * Update specified role with provided data.
     *
     * @param Role $role
     * @param UpdateRoleRequest $request
     * @return mixed
     */
    public function updateDetails(Company $company, UpdateCompanyRequest $request)
    {
		$data = $request->all();
		
		$profile = 0;
		if(isset($data["profile"]) && $data["profile"] == 1){
			$profile = 1;
		}
		
		unset($data["profile"]);
        $this->companies->update($company->id, $data);
		
		if($request->get('page') == "profile"){
			return redirect()->route('company.profile.edit')
				->withSuccess(trans('app.company_details_updated'));
		} else {
			//event(new Updated($company));
			 return redirect('company/'.$company->id.'/edit')
                ->withSuccess(trans('app.company_details_updated'));
		}
       
    }

    /**
     * Remove specified role from system.
     *
     * @param Role $role
     * @param UserRepository $userRepository
     * @return mixed
     */
    public function delete(Company $company, UserRepository $userRepository)
    {
        /* if (! $role->removable) {
            throw new NotFoundHttpException;
        }

        $userRole = $this->roles->findByName('User');

        $userRepository->switchRolesForUsers($role->id, $userRole->id);
 */
        $status = $this->companies->delete($company->id);
		

        Cache::flush();
        return redirect()->route('company.index')
            ->withSuccess(trans('app.company_deleted'));
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
            ->withSuccess(trans('app.logo_changed'));
    }
	
	public function updateAvatar(Company $company, CompanyAvatarManager $avatarManager, Request $request)
    {
        $this->validate($request, ['avatar' => 'image']);

        if ($name = $avatarManager->uploadAndCropAvatar($company)) {
			
            $this->companies->update($company->id, ['avatar' => $name]);

            if($request->get("page") == "edit"){
                return redirect('company/'.$company->id.'/edit')
                ->withSuccess(trans('app.avatar_changed'));
            } else {
                return redirect()->route('company.profile.edit')
                ->withSuccess(trans('app.avatar_changed'));
            }
            
        }

        return redirect()->route('company.profile.edit')
            ->withErrors(trans('app.avatar_not_changed'));
    }
	
	public function editCompany(CountryRepository $countryRepository)
    {
        $edit = true;
		$profile = true;
		$company = $this->companies->findByCode(Auth::user()->present()->company_code);
		$countries = $this->parseCountries($countryRepository);
		$updateUrl = route('company.update.avatar.external', $company->id);
		$company_users = $this->companies->getAllCompanyUsers($company->id);
        return view('company.edit', compact('edit', 'company','updateUrl','profile','countries','company_users'));
    }
	
	public function viewProfile()
    {   
		$company = $this->companies->findByCode(Auth::user()->present()->company_code);
		
        return view('company.view', compact('company'));
    }

    public function updateAddressDetails(Company $company, UpdateAddressDetailsRequest $request)
    {
        $this->companies->update($company->id, $request->all());
        
        //event(new UpdatedByAdmin($user));

        return redirect()->back()
            ->withSuccess(trans('app.company_updated'));
    }

    public function updateSocialNetworks(company $company, Request $request)
    {
        $this->companies->update($company->id, $request->all());

        //event(new UpdatedByAdmin($user));

        if($request->get("page") == "edit"){
            return redirect()->route('company.edit', $company->id)
            ->withSuccess(trans('app.socials_updated'));
        } else {
            return redirect()->route('company.profile.edit')
            ->withSuccess(trans('app.socials_updated'));
        }

    }


}