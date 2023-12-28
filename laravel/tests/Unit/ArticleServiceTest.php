<?php

namespace Tests\Unit;

use App\Enums\PublicationStatus;
use App\Models\Article;
use App\Models\User;
use App\Services\ArticleService;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ArticleServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $articleService;

    protected function setUp(): void
    {
        parent::setUp();

        // Run some seeders before tests
        $this->seed(PermissionSeeder::class);
        $this->seed(UserSeeder::class);

        // Create an instance of the ArticleService
        $this->articleService = app(ArticleService::class);
    }

    public function test_it_can_get_published_articles()
    {
        // Arrange: Create a user
        $user = User::factory()->create();

        // Act: Create a draft article
        $draftArticle = Article::factory()->create([
            'author_id' => $user->id,
            'publication_date' => now(),
            'publication_status' => PublicationStatus::DRAFT->value,
        ]);

        // Create a published article
        $publishedArticle = Article::factory()->create([
            'author_id' => $user->id,
            'publication_date' => now(),
            'publication_status' => PublicationStatus::PUBLISH->value,
        ]);

        // Call the service method to get published articles
        $results = $this->articleService->getPublished();

        // Assert: Check if the published article is in the results
        $this->assertTrue($results->contains($publishedArticle));
        $this->assertFalse($results->contains($draftArticle));
    }

    public function test_it_can_index_own_articles_for_authenticated_user()
    {
        // Arrange: Create an authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act: Create articles for the authenticated user
        $userArticles = Article::factory()->count(5)->create([
            'author_id' => $user->id,
            'publication_date' => now(),
        ]);

        // Call the service method to get indexed articles
        $results = $this->articleService->index();

        // Assert: Check if the user's articles are in the result
        $this->assertEmpty($results->diff($userArticles)->toArray());
        $this->assertCount(count($userArticles), $results);
    }

    public function test_it_can_index_all_articles_for_authenticated_admin()
    {
        // Arrange: Create an authenticated admin with the Admin role
        $user = User::factory()->create();

        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $this->actingAs($admin);

        // Act: Create articles for the authenticated admin
        Article::factory()->count(2)->create([
            'author_id' => $user->id,
            'publication_date' => now(),
        ]);
        Article::factory()->count(3)->create([
            'author_id' => $admin->id,
            'publication_date' => now(),
        ]);
        $allArticles = Article::all();

        // Call the service method to get indexed articles
        $results = $this->articleService->index();

        // Assert: Check if the all articles are in the result
        $this->assertEmpty($allArticles->diff($results)->toArray());
        $this->assertCount(count($allArticles), $results);
    }

    public function test_it_can_store_an_article()
    {
        // Arrange: Create a user
        $user = User::factory()->create();

        // Act: Create an article
        $articleData = [
            'title' => 'Test Article',
            'content' => 'Lorem ipsum',
        ];

        $this->actingAs($user); // Simulate authentication
        $this->articleService->store($articleData);

        // Assert: Check if the article is stored in the database
        $this->assertDatabaseHas('articles', $articleData);
    }

    public function test_it_can_update_an_article()
    {
        // Arrange: Create a user and an article
        $user = User::factory()->create();
        $article = Article::factory()->create(['author_id' => $user->id]);

        // Act: Update the article
        $this->actingAs($user); // Simulate authentication
        $updatedData = ['title' => 'Updated Title', 'content' => 'Updated Content'];
        $this->articleService->update($article->id, $updatedData);

        // Assert: Check if the article is updated in the database
        $this->assertDatabaseHas('articles', array_merge(['id' => $article->id], $updatedData));
    }

    public function test_it_can_destroy_an_article()
    {
        // Arrange: Create a user and an article
        $user = User::factory()->create();
        $article = Article::factory()->create(['author_id' => $user->id]);

        // Act: Destroy the article
        $this->actingAs($user); // Simulate authentication
        $this->articleService->destroy($article->id);

        // Assert: Check if the article is soft-deleted in the database
        $this->assertSoftDeleted('articles', ['id' => $article->id]);
    }

    public function test_it_can_publish_an_article()
    {
        // Arrange: Create a user and a draft article
        $user = User::factory()->create();
        $draftArticle = Article::factory()->create(['author_id' => $user->id, 'publication_status' => PublicationStatus::DRAFT->value]);

        // Act: Publish the article
        $this->actingAs($user); // Simulate authentication
        $this->articleService->publish($draftArticle->id);

        // Assert: Check if the article is published in the database
        $this->assertDatabaseHas('articles', ['id' => $draftArticle->id, 'publication_status' => PublicationStatus::PUBLISH->value]);
    }

    public function test_it_can_get_trashed_articles()
    {
        // Arrange: Create a user and some trashed articles
        $user = User::factory()->create();
        $trashedArticles = Article::factory()->count(3)->create(['author_id' => $user->id, 'deleted_at' => now()]);

        // Act: Get trashed articles
        $this->actingAs($user); // Simulate authentication
        $results = $this->articleService->trash();

        // Assert: Check if the results contains trashed articles
        $this->assertEmpty($results->diff($trashedArticles)->toArray());
        $this->assertCount(count($trashedArticles), $results);
    }

    public function test_it_can_restore_a_trashed_article()
    {
        // Arrange: Create a user and a trashed article
        $user = User::factory()->create();
        $trashedArticle = Article::factory()->create(['author_id' => $user->id, 'deleted_at' => now()]);

        // Act: Restore the trashed article
        $this->actingAs($user); // Simulate authentication
        $this->articleService->restore($trashedArticle->id);

        // Assert: Check if the article is restored in the database
        $this->assertDatabaseHas('articles', ['id' => $trashedArticle->id, 'deleted_at' => null]);
    }
}
