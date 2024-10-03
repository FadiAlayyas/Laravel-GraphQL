<?php

namespace App\GraphQL\Mutations\Article;

use App\Models\Article;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;

class DeleteArticleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteArticle',
        'description' => 'Deletes an article by ID',
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the article to delete',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $article = Article::findOrFail($args['id']);
        return $article->delete();
    }
}
