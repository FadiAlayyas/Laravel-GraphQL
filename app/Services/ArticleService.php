<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function getAllArticles(): array
    {

        $articles = Article::with('author', 'category')->get();
        return ['articles' => $articles];
    }

    /**
     * Get an article by its ID.
     *
     * @param int $id
     * @return Article
     */
    public function getById(int $id): Article
    {
        $article = Article::with('author', 'category')->findOrFail($id);
        return $article;
    }

    /**
     * Create a new article.
     *
     * @param array $data
     * @return Article
     */
    public function createArticle(array $data): Article
    {
        $article = Article::create($data);
        return $article->load('author', 'category');
    }

    /**
     * Update an existing article.
     *
     * @param Article $article
     * @param array $data
     * @return Article
     */
    public function updateArticle(Article $article, array $data): Article
    {
        $article->update($data);
        return $article->load('author', 'category');
    }

    /**
     * Delete an article.
     *
     * @param Article $article
     * @return void
     */
    public function deleteArticle(Article $article): void
    {
        $article->delete();
    }
}
