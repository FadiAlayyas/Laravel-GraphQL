<?php

namespace App\GraphQL\Mutations\Article;

use App\Models\Article;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateArticleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createArticle',
        'description' => 'Creates a new article',
    ];

    public function type(): Type
    {
        return GraphQL::type('Article');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the article',
            ],
            'body' => [
                'name' => 'body',
                'type' => Type::string(),
                'description' => 'The main content of the article',
            ],
            'tags' => [
                'name' => 'tags',
                'type' => Type::string(),
                'description' => 'Tags for the article',
            ],
            'excerpt' => [
                'name' => 'excerpt',
                'type' => Type::string(),
                'description' => 'excerpts for the article',
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'The category ID',
            ],
            'author_id' => [
                'name' => 'author_id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'The author ID',
            ],
            'status' => [
                'name' => 'status',
                'type' => Type::string(),
                'description' => 'The status of the article (draft, published, etc.)',
            ],
            'is_featured' => [
                'name' => 'is_featured',
                'type' => Type::boolean(),
                'description' => 'Is the article featured?',
            ],
            'thumbnail' => [
                'name' => 'thumbnail',
                'type' => Type::string(),
                'description' => 'URL of the article thumbnail',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $article = new Article();
        $article->fill($args);
        $article->save();

        return $article;
    }
}
