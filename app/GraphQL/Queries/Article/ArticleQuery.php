<?php

namespace App\GraphQL\Queries\Article;

use App\Models\Article;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ArticleQuery extends Query
{
    protected $attributes = [
        'name' => 'articles',
    ];

    public function type(): Type
    {
        return GraphQL::type('Article');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the articles',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Article::with(['author', 'category'])->findOrFail($args['id']);
    }
}
