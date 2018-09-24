<?php
return [
    'name'=>'TEST IS APP', //наименование приложения
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'language' => 'ru',
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //кеширование обращений к схеме базы данных
        'db' => [
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 500,
        ],
        //регистрируем сервис и подписываемся на события
        'projectService' => [
            'class' => \common\services\ProjectService::class,
            //подписываем задачи на событие в сервисе ProjectService (делать такой сложный код в конфиге - плохо, лучше сделать в bootstrap или отдельном файле)
            'on ' . \common\services\ProjectService::EVENT_ASSIGN_ROLE => function (\common\services\AssignRoleEvent $e) {
                //логирование
                //Yii::info('_event`s works_', '_');
                //отправка письма
                $views = ['html' => 'assignRoleToProject-html', 'text' => 'assignRoleToProject-text'];
                $data = ['user' => $e->user, 'project' => $e->project, 'role' => $e->role];
                Yii::$app->emailService->send($e->user->email, 'New role', $views, $data);
            }
        ],
        'emailService' => [
            'class' => \common\services\EmailService::class,
        ],
        'taskService' => [
            'class' => \common\services\TaskService::class,
        ],
        //https://github.com/yii2mod/yii2-comments
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
                // ...
            ],
        ],
    ],
    'modules' => [
        'chat' => [
            'class' => 'common\modules\chat\Module'],
        //https://github.com/yii2mod/yii2-comments
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],
    ]
];
