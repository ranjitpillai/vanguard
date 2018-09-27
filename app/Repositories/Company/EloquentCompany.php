<?php

namespace Vanguard\Repositories\Company;

use Vanguard\Events\Company\Created;
use Vanguard\Events\Company\Deleted;
use Vanguard\Events\Company\Updated;
use Vanguard\Company;
use Vanguard\User;
use Vanguard\Support\Authorization\CacheFlusherTrait;
use DB;

class EloquentCompany implements CompanyRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Role::all();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllWithCompanyUsersCount()
    {
		$companies = Company::get();
		
		for($i=0;$i<count($companies);$i++){
			$companies[$i]->users_count = count(User::where(DB::raw('BINARY `company_code`'), $companies[$i]->company_code)->where('company_code','!=',"")->get());
		}
		
		return $companies;
    }
	
	public function getAllCompanyUsers($id)
    {
		$company = Company::find($id);
		
		$users = User::where(DB::raw('BINARY `company_code`'), $company->company_code)->get();
		
        return $users;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Company::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $company = Company::create($data);

        event(new Created($company));

        return $company;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $company = $this->find($id);
		
        $company->update($data);

        event(new Updated($company));

        return $company;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $role = $this->find($id);

        event(new Deleted($role));

        return $role->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function updatePermissions($roleId, array $permissions)
    {
        $role = $this->find($roleId);

        $role->syncPermissions($permissions);
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'name', $key = 'id')
    {
        return Role::pluck($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        return Role::where('name', $name)->first();
    }
	
	public function findByCode($company_code)
    {
       return DB::table("company")->where('company_code', $company_code)->first();
    }
}
