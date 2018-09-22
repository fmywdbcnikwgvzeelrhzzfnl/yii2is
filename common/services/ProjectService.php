<?php
/**
 * Created by PhpStorm.
 * User: Миша_2
 * Date: 12.09.2018
 * Time: 20:17
 */

namespace common\services;


use common\models\ProjectModel;
use common\models\ProjectUserModel;
use common\models\User;
use yii\base\Component;
use yii\base\Event;

/**
 * Class AssignRoleEvent
 * Класс, описывающий событие
 * @package common\services
 */
class AssignRoleEvent extends Event
{
    public $project;
    public $user;
    public $role;

    public function dump()
    {
        return ['project' => $this->project->id, 'user' => $this->user->id, 'role' => $this->role];
    }
}

/**
 * Class ProjectService
 * Сервис, генерирующий событие
 * @package backend\services
 */
class ProjectService extends Component
{
    const EVENT_ASSIGN_ROLE = 'event_assign_role';

    public function assignRole(ProjectModel $project, User $user, $role)
    {
        $event = new AssignRoleEvent();
        $event->project = $project;
        $event->user = $user;
        $event->role = $role;
        $this->trigger(self::EVENT_ASSIGN_ROLE, $event);

    }

    /**
     * @param ProjectModel $project
     * @param User $user
     * @return array
     */
    public function getRoles(ProjectModel $project, User $user)
    {
        return $project->getProjectUsers()->byUser($user->id)->select('role')->column();
    }

    public function getAllRoles(ProjectModel $project)
    {
        return $project->getProjectUsers()->select('role')->column();
    }

    public function hasRole(ProjectModel $project, User $user, $role)
    {
        return in_array($role, $this->getRoles($project, $user));
    }


}