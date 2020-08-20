<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Tasks
    |--------------------------------------------------------------------------
    |
    | Here you can register all the Tasks which should be used in the Workflow Package. You can also deactivate Tasks
    | just by deleting them here.
    |
    */
    'tasks' => [
        'SendMail' => the42coders\Workflows\Tasks\SendMail::class,
        'Execute' => the42coders\Workflows\Tasks\Execute::class,
        'PregReplace' => the42coders\Workflows\Tasks\PregReplace::class,
        'HtmlInput' => the42coders\Workflows\Tasks\HtmlInput::class,
        'DomPDF' => the42coders\Workflows\Tasks\DomPDF::class,
        'SaveFile' => the42coders\Workflows\Tasks\SaveFile::class,
        'HttpStatus' => the42coders\Workflows\Tasks\HttpStatus::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Data Resources
    |--------------------------------------------------------------------------
    |
    | Here you can register all the Data Resources which should be used in the Workflow Package. You can also
    | deactivate Data Resources just by deleting them here.
    |
    */
    'data_resources' => [
        'ValueResource' => the42coders\Workflows\DataBuses\ValueResource::class,
        'ModelResource' => the42coders\Workflows\DataBuses\ModelResource::class,
        'DataResource' => the42coders\Workflows\DataBuses\DataBusResource::class,
        'ConfigResource' => the42coders\Workflows\DataBuses\ConfigResource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Triggers
    |--------------------------------------------------------------------------
    |
    | Here you can register all the Triggers which should be used in the Workflow Package. You can also
    | deactivate Triggers just by deleting them here.
    |
    | Observers
    |
    | Events:
    | You can register all the events the Trigger should listen to here.
    |
    | Classes:
    | You can register the Classes which can be used for the ObserverTrigger.
    |
    */
    'triggers' => [

        'types' => [
            'ObserverTrigger' => the42coders\Workflows\Triggers\ObserverTrigger::class,
        ],

        'Observers' => [
            'events' => [
                'retrieved',
                'creating',
                'created',
                'updating',
                'updated',
                'saving',
                'saved',
                'deleting',
                'deleted',
                'restoring',
                'restored',
                'forceDeleted',
            ],
            'classes' => [
                \App\User::class => 'User',
                \the42coders\Workflows\Loggers\WorkflowLog::class => 'WorkflowLog',
            ]

        ],

    ],
    'queue' => 'redis',

    /*
    |--------------------------------------------------------------------------
    | Nova
    |--------------------------------------------------------------------------
    |
    | You can set the Nova Resources and the DynamicWorkflow Action to get an easy Nova integration.
    |
    */
    'nova' => [
        'resources' => [
            the42coders\Workflows\Nova\Workflow::class,
        ],
        'actions' => [
            new the42coders\Workflows\Nova\Actions\DynamicWorkflow,
        ],
    ]
];
