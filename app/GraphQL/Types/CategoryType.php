<?php

namespace App\GraphQL\Types;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'A type that represents a category',
        'model' => Category::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the category',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the category',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The SEO-friendly URL of the category',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'A short description of the category',
            ],
            'articles' => [
                'type' => Type::listOf(GraphQL::type('Article')),
                'description' => 'A list of articles under this category',
                'resolve' => function($root) {
                    return $root->articles; // Assuming a relationship is defined in the model
                },
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The creation date of the category',
                'resolve' => function($root) {
                    return $root->created_at->toDateTimeString();
                },
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The last update date of the category',
                'resolve' => function($root) {
                    return $root->updated_at->toDateTimeString();
                },
            ],
        ];
    }

    public function resolveField($root, $args, $context, $info)
    {
        return $root->{$info->fieldName};
    }
}
