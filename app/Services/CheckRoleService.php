<?php

namespace App\Services;

use Auth;
use Exception;
use App\Services\Service;
use App\Models\RoleProfile;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Interfaces\IRoleProfileRepository;


class CheckRoleService extends Service
{
	private $roleProfileRepository;

	public function __construct()
    {
		$this->roleProfileRepository = resolve('App\Repositories\Interfaces\IRoleProfileRepository');
	}

	public function CheckRole($profileId,$role)
    {
		try
		{
			$profilesRoles = $this->cacheProfileRoles();
			$rolesProfile = $profilesRoles->where('profile_id',$profileId)->first();
			if(in_array($role, $rolesProfile['roles']))
				return true;
		}
		catch(Exception $e)
		{
			return false;
		}
		
        return false;
    }

	private function cacheProfileRoles()
	{
        try
        {
            $cache = Cache::remember('ch_profiles_roles', now()->addMinutes(1), function () {

				$rolesProfiles = $this->roleProfileRepository->getRoleProfileForCache();

				return $this->formatRolesProfile($rolesProfiles);
			});
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
		}
		
		return $cache;
	}

	private function formatRolesProfile($rolesProfiles)
	{
		try
		{
			$result = $rolesProfiles->groupBy('profile_id')->map(function($item){

				$roles = array();

				foreach($item as $i){
					$role = $i->system_abrrev . '_' . $i->role;
					if(!in_array($role, $roles))
						$roles[] = $role;

					$roles[] = $role . '_' . $i->slug;
				}

				return array(
					'profile_id' => $item[0]->profile_id,
					'roles' => $roles
				);
			});
		}
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
		}

		return $result;
	}
}