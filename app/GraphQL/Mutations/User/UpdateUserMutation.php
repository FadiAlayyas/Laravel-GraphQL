<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUser',
        'description' => 'Updates an existing user',
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => ['type' => Type::string()],
            'email' => ['type' => Type::string()],
            'password' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::findOrFail($args['id']);
        
        if (isset($args['name'])) {
            $user->name = $args['name'];
        }
        
        if (isset($args['email'])) {
            $user->email = $args['email'];
        }

        if (isset($args['password'])) {
            $user->password = bcrypt($args['password']); // Hash the password
        }

        $user->save();

        return $user;
    }
}
