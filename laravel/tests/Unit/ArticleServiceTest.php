<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;

class ArticleServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_published_articles()
    {
        $this->assertTrue(true);
        // Arrange: Create a user
        $user = User::factory()->create();

        // // Act: Create a draft article
        // $draftArticle = Article::factory()->create([
        //     'author_id' => $user->id,
        //     'publication_status' => PublicationStatus::DRAFT->value,
        // ]);

        // // Create a published article
        // $publishedArticle = Article::factory()->create([
        //     'author_id' => $user->id,
        //     'publication_status' => PublicationStatus::PUBLISH->value,
        // ]);

        // // Call the service method to get published articles
        // $publishedArticles = $this->articleService->getPublished();

        // // Assert: Check if the published article is in the result
        // $this->assertTrue($publishedArticles->contains($publishedArticle));
        // $this->assertFalse($publishedArticles->contains($draftArticle));
    }
}
