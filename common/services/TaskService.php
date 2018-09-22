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
use common\models\TaskModel;
use common\models\User;
use Yii;
use yii\base\Component;
use yii\base\Event;


/**
 * Сервис, обслуживающий Task Controller
 * @package backend\services
 */
class TaskService extends Component
{
    /**
     * Проверяющий может ли пользователь управлять задачами в проекте - может если менеджер в проекте, используйте hasRole() из Project сервиса
     * @param ProjectModel $project
     * @param User $user
     * @return bool
     */
    public function canManage(ProjectModel $project, User $user)
    {
        return Yii::$app->projectService->hasRole($project, $user, ProjectUserModel::ROLE_MANAGER);
    }

    /**
     * Проверяющий может ли пользователь взять задачу в работу - может если деверолер в проекте (используйте hasRole() из Project сервиса), и поле executor_id у задачи пустое.
     * @param TaskModel $task
     * @param User $user
     * @return bool
     */
    public function canTake(TaskModel $task, User $user)
    {
        return Yii::$app->projectService->hasRole($task->project, $user, ProjectUserModel::ROLE_DEVELOPER)
            && !$task->started_at;
    }

    /**
     * Проверяющий может ли пользователь закончить работу - может если пользователь в поле executor_id у задачи и поле completed_at пустое.
     * @param TaskModel $task
     * @param User $user
     * @return bool
     */
    public function canCompele(TaskModel $task, User $user)
    {
        return Yii::$app->projectService->hasRole($task->project, $user, ProjectUserModel::ROLE_DEVELOPER)
            && $task->started_at
            && !$task->completed_at;
    }


    /**
     * взять задачу в работу - изменяем start_at и executor_id
     * @param TaskModel $task
     * @param User $user
     * @return bool
     */
    public function takeTask(TaskModel $task, User $user)
    {
        $task->executor_id = $user->id;
        $task->started_at = time();
        return $task->save();
    }


    /**
     * закончить работу - изменяем completed_at
     * @param TaskModel $task
     * @param User $user
     * @return bool
     */
    public function completeTask(TaskModel $task, User $user)
    {
        $task->completed_at = time();
        return $task->save();
    }

    public function getProjects($user){
        $projects = ProjectModel::find()
            ->byUser($user)//задачи можно прикрепить только к проектам, где пользователь - менеджер
            ->select('title')
            ->indexBy('id')
            ->column();
        return $projects;
    }

}