<?php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Policy
 * @package App\Policies
 * @property bool $check
 * @property array $replace
 * @property array $policies
 * @property Model $model
 */
class Policy
{
    use HandlesAuthorization;
    /**
     * @var bool $check The attributes that are default check .
     */
    protected $check = false;
    /**
     * @var array $replace The attributes that are replacement methods.
     */
    protected $replace = [
        'store' => 'create',
        'update' => 'edit',
        'destroy' => 'delete',
        'show' => 'view',
    ];
    /**
     * @var array $policies The attributes that are main methods .
     */
    public $policies = ['index', 'create', 'edit', 'view', 'delete'];
    /**
     * @var Model $model The attributes that are related model class .
     */
    public $model = null;
    /**
     * Get related permissions
     * @param User $user
     * @return mixed
     */
    public function getPermissions(User $user)
    {
        $user->load('role');
        return $user->getRelation('role')->permission;
    }
    /**
     * Check permissions before the action
     * @param User $user
     * @param $ability
     * @param $model
     */
    public function before(User $user, $ability, $model)
    {
        $func = $ability;
        if (array_key_exists($func, $this->replace)) {
            $func = $this->replace[$func];
        }

        $class = get_class($model);
        if ($user->role_id == 1) {
            $this->check = true;
        }

        $permissions = $this->getPermissions($user);
       //dd($permissions);
        if (isset($permissions[$class]) && is_array($permissions[$class]) && in_array($func, $permissions[$class])) {
            $this->check = true;

        }
    }
}

