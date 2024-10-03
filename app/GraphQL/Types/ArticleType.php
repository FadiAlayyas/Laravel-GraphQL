<?php

namespace App\GraphQL\Types;

use App\Models\Article;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ArticleType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Article',
        'description' => 'A type that represents an article',
        'model' => Article::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the article',
            ],
            'author' => [
                'type' => GraphQL::type('User'),
                'description' => 'The author of the article',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of the article',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The SEO-friendly URL of the article',
            ],
            'body' => [
                'type' => Type::string(),
                'description' => 'The main content of the article',
            ],
            'excerpt' => [
                'type' => Type::string(),
                'description' => 'A short summary of the article',
            ],
            'tags' => [
                'type' => Type::listOf(Type::string()),
                'description' => 'Tags for categorization',
                'resolve' => function($root) {
                    return json_decode($root->tags, true);
                },
            ],
            'category' => [
                'type' => GraphQL::type('Category'),
                'description' => 'The category of the article',
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'The status of the article (draft, published, archived)',
            ],
            'published_at' => [
                'type' => Type::string(),
                'description' => 'The publication date of the article',
                'resolve' => function($root) {
                    return $root->published_at ? $root->published_at->toDateTimeString() : null;
                },
            ],
            'is_featured' => [
                'type' => Type::boolean(),
                'description' => 'Whether the article is featured',
            ],
            'views_count' => [
                'type' => Type::int(),
                'description' => 'The number of views of the article',
            ],
            'thumbnail' => [
                'type' => Type::string(),
                'description' => 'The URL of the thumbnail image',
            ],
            'metadata' => [
                'type' => Type::listOf(Type::string()),
                'description' => 'Additional metadata for the article (e.g., SEO keywords)',
                'resolve' => function($root) {
                    return json_decode($root->metadata, true);
                },
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The creation date of the article',
                'resolve' => function($root) {
                    return $root->created_at->toDateTimeString();
                },
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The last update date of the article',
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
