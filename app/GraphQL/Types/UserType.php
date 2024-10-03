<?php

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type that represents a user',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the user',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of the user',
            ],
            'email_verified_at' => [
                'type' => Type::string(),
                'description' => 'The email verified timestamp of the user',
                'resolve' => function ($root) {
                    return $root->email_verified_at ? $root->email_verified_at->toDateTimeString() : null;
                },
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The creation date of the user',
                'resolve' => function ($root) {
                    return $root->created_at->toDateTimeString();
                },
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The last update date of the user',
                'resolve' => function ($root) {
                    return $root->updated_at->toDateTimeString();
                },
            ],
            'articles' => [
                'type' => Type::listOf(GraphQL::type('Article')),
                'description' => 'List of articles'
            ]
        ];
    }

    // Implement resolver that uses the field name to access properties dynamically from the model
    public function resolveField($root, $args, $context, $info)
    {
        return $root->{$info->fieldName};
    }
}
