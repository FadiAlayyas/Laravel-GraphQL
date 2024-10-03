<?php

namespace App\GraphQL\Mutations\Category;

use App\Models\Category;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateCategory',
        'description' => 'Updates an existing category'
    ];

    public function type(): Type
    {
        return GraphQL::type('Category');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of the category to update',
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'description' => 'Name of the category',
            ],
            'slug' => [
                'name' => 'slug',
                'type' => Type::string(),
                'description' => 'Slug of the category',
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
                'description' => 'Short description of the category',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $category = Category::findOrFail($args['id']);
        $category->update($args);
        return $category;
    }
}
