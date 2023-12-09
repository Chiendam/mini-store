<?php

namespace App\Repositories\User;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use function Symfony\Component\String\u;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories\User;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getUsersPaginate($data)
    {
        $limit = $data['limit'] ?? config('constants.limit_pagination', 20);
        $q = $data['q'] ?? '';
        $query = $this;
        if ($q) {
            $query = $query->where('username', 'like', "%$q%")
                ->orWhere('full_name', 'like', "%$q%");
        }
        return $query->orderBy('created_at')->paginate($limit);
    }

    public function createMany(array $listUser)
    {
        $usernameList = collect($listUser)->map((function ($item) {
            return $item['user_name'];
        }))->flatten(1)->toArray();
        $listUsername = $this->select('username')->whereIn('username', $usernameList)->get()->flatten(1)->map(function ($user) {
            return $user->username;
        })->toArray();
        foreach ($listUser as $user) {
            if(in_array($user['user_name'], $listUsername) || is_null($user['user_name'])) continue;
            $this->create([
                ...$user,
                'username' => $user['user_name'],
                'password' => $user['phone_number'],
                'role' => RoleEnum::User,
                'status' => StatusEnum::Active,
            ]);
        }
    }
}
