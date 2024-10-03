<?php

declare(strict_types=1);

return [
    'route' => [

        'prefix' => 'graphql',

        'controller' => Rebing\GraphQL\GraphQLController::class . '@query',

        'middleware' => [],

        'group_attributes' => [],
    ],

    'default_schema' => 'default',

    'batching' => [

        'enable' => true,
    ],

    'schemas' => [

        'default' => [

            'query' => [
                App\GraphQL\Queries\User\UsersQuery::class,
                App\GraphQL\Queries\User\UserQuery::class,

                App\GraphQL\Queries\Category\CategoryQuery::class,
                App\GraphQL\Queries\Category\CategoriesQuery::class,

                App\GraphQL\Queries\Article\ArticleQuery::class,
                App\GraphQL\Queries\Article\ArticlesQuery::class,
            ],

            'mutation' => [
                App\GraphQL\Mutations\Category\CreateCategoryMutation::class,
                App\GraphQL\Mutations\Category\UpdateCategoryMutation::class,
                App\GraphQL\Mutations\Category\DeleteCategoryMutation::class,

                App\GraphQL\Mutations\Article\CreateArticleMutation::class,
                App\GraphQL\Mutations\Article\UpdateArticleMutation::class,
                App\GraphQL\Mutations\Article\DeleteArticleMutation::class,

                \App\GraphQL\Mutations\User\CreateUserMutation::class,
                \App\GraphQL\Mutations\User\UpdateUserMutation::class,
                \App\GraphQL\Mutations\User\DeleteUserMutation::class,
            ],

            'types' => [
                App\GraphQL\Types\UserType::class,
                App\GraphQL\Types\ArticleType::class,
                App\GraphQL\Types\CategoryType::class,
            ],

            // Laravel HTTP middleware
            'middleware' => [
             
            ],

            // Supported HTTP methods; must be given in UPPERCASE!
            'method' => ['GET', 'POST', 'PUT'],

            // Array of middlewares, overrides global ones
            'execution_middleware' => null,
        ],

    ],

    'types' => [
        App\GraphQL\Types\UserType::class,
        App\GraphQL\Types\ArticleType::class,
        App\GraphQL\Types\CategoryType::class,
    ],


    'error_formatter' => [Rebing\GraphQL\GraphQL::class, 'formatError'],

    'errors_handler' => [Rebing\GraphQL\GraphQL::class, 'handleErrors'],

    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false,
    ],

    'pagination_type' => Rebing\GraphQL\Support\PaginationType::class,

    'simple_pagination_type' => Rebing\GraphQL\Support\SimplePaginationType::class,

    'defaultFieldResolver' => null,

    'headers' => [],

    'json_encoding_options' => 0,

    'apq' => [

        'enable' => env('GRAPHQL_APQ_ENABLE', false),

        'cache_driver' => env('GRAPHQL_APQ_CACHE_DRIVER', config('cache.default')),

        'cache_prefix' => config('cache.prefix') . ':graphql.apq',

        'cache_ttl' => 300,
    ],

    'execution_middleware' => [
        Rebing\GraphQL\Support\ExecutionMiddleware\ValidateOperationParamsMiddleware::class,
        Rebing\GraphQL\Support\ExecutionMiddleware\AutomaticPersistedQueriesMiddleware::class,
        Rebing\GraphQL\Support\ExecutionMiddleware\AddAuthUserContextValueMiddleware::class,
    ],

    'resolver_middleware_append' => null,
];
