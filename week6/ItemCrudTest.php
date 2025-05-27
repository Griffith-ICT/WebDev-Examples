<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// add the following:
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ItemCrudTest extends TestCase
{

    protected string $schemaSqlPath;
    /**
     * This method is called before the first test of this test class is run.
     * We can use it to set up things that are common for all tests in the class.
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        // Ensure the test database is configured (e.g., in phpunit.xml)
        // For SQLite in-memory, this is usually fine.
        // If using a file-based SQLite, ensure the file path is correctly configured
        // in phpunit.xml (e.g., DB_DATABASE=database/testing.sqlite)
    }

     /**
     * This method is called before each test.
     * We will manually set up our database schema and initial data here.
     */
    protected function setUp(): void
    {
        parent::setUp(); // Call the parent setup

        $this->schemaSqlPath = database_path('create_item_table.sql'); // Your SQL file

        // 1. Drop the table if it exists to ensure a clean state.
        //    Using Schema facade is a bit more database-agnostic for dropping.
        // if (DB::getSchemaBuilder()->hasTable('item')) {
        //    DB::getSchemaBuilder()->drop('item');
        // }
        // Alternatively, for raw SQL if preferred, especially if create script handles 'drop if exists':
        // DB::statement('DROP TABLE IF EXISTS item;'); // Specific to SQLite/MySQL syntax

        // 2. Execute the SQL script to create the table and insert initial data.
        if (File::exists($this->schemaSqlPath)) {
            DB::unprepared(File::get($this->schemaSqlPath));
        } else {
            $this->fail("Testing schema file not found at: " . $this->schemaSqlPath);
        }
    }

    /**
     * This method is called after each test.
     * For this specific manual setup, where setUp recreates everything,
     * tearDown might not need to do much for the database.
     * However, if you started transactions in setUp, you'd roll them back here.
     */
    protected function tearDown(): void
    {
        // If you wanted to be absolutely sure and drop the table after each test:
        // if (DB::getSchemaBuilder()->hasTable('item')) {
        //     DB::getSchemaBuilder()->drop('item');
        // }

        parent::tearDown(); // Call the parent teardown
    }

    // ... ALL YOUR TEST METHODS (test_home_page_lists_items, etc.) REMAIN THE SAME ...
    // The helper function createTestItem also remains the same.

    // Helper function to create an item directly for test setup
    private function createTestItem(array $attributes = []): object
    {
        $itemData = array_merge([
            'summary' => 'Test Summary ' . rand(1, 1000),
            'details' => 'Test Details ' . rand(1, 1000),
        ], $attributes);

        $id = DB::table('item')->insertGetId($itemData);
        return DB::table('item')->find($id);
    }

    // ... (rest of your test methods from the previous example) ...
    // Example:
    public function test_home_page_lists_items(): void
    {
        // Arrange: The schema is already seeded by setUp()

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('items.item_list');
        $response->assertViewHas('items');
        $response->assertSee("Canon PowerShot S110"); // From your create_item_table.sql
        $response->assertSee("Fujifilm X-Pro1");   // From your create_item_table.sql
    }

    /**
     * Test item details page for an existing (seeded) item.
     */
    public function test_item_detail_page_shows_seeded_item(): void
    {
        // Arrange: Get an ID of one of the seeded items.
        // Let's assume the "Canon PowerShot S110" is ID 1 after seeding.
        // A more robust way would be to query it if IDs are not guaranteed.
        $seededItem = DB::table('item')->where('summary', 'Canon PowerShot S110')->first();
        $this->assertNotNull($seededItem, "Seeded item 'Canon PowerShot S110' not found.");

        // Act: Make a GET request to the item detail page
        $response = $this->get('/item_detail/' . $seededItem->id);

        // Assert:
        $response->assertStatus(200);
        $response->assertViewIs('items.item_detail');
        $response->assertViewHas('item');
        $response->assertSee($seededItem->summary);
        $response->assertSee($seededItem->details);
    }

    /**
     * Test item details page for a non-existent item.
     */
    public function test_item_detail_page_for_non_existent_item(): void
    {
        $response = $this->get('/item_detail/9999');
        // As before, adjust based on how die() is handled or if you change to abort(404)
        $response->assertStatus(404);
    }

    /**
     * Test the page for adding an item.
     */
    public function test_add_item_page_is_accessible(): void
    {
        $response = $this->get('/add_item');
        $response->assertStatus(200);
        $response->assertViewIs('items.add_item');
    }

    /**
     * Test handles create item requests.
     */
    public function test_can_create_an_item(): void
    {
        $initialCount = DB::table('item')->count();
        $itemData = [
            'summary' => 'Newly Created Item',
            'details' => 'Details for the new item.',
        ];

        $response = $this->post('/add_item_action', $itemData);

        $this->assertDatabaseHas('item', $itemData);
        $this->assertEquals($initialCount + 1, DB::table('item')->count());

        $newItem = DB::table('item')->where('summary', $itemData['summary'])->first();
        $this->assertNotNull($newItem);
        $response->assertRedirect(url("item_detail/{$newItem->id}"));

        $this->get(url("item_detail/{$newItem->id}"))
             ->assertSee($itemData['summary'])
             ->assertSee($itemData['details']);
    }

    /**
     * Test the page for update item.
     */
    public function test_update_item_page_is_accessible(): void
    {
        $item = DB::table('item')->where('summary', 'Canon EOS 700D')->first();
        $this->assertNotNull($item, "Seeded item for update test not found.");

        $response = $this->get('/item_update/' . $item->id);

        $response->assertStatus(200);
        $response->assertViewIs('items.update_item');
        $response->assertViewHas('item', function ($viewItem) use ($item) {
            return $viewItem->id == $item->id && $viewItem->summary == $item->summary;
        });
        $response->assertSee($item->summary);
    }

    /**
     * Test handles update item requests.
     */
    public function test_can_update_an_item(): void
    {
        $itemToUpdate = DB::table('item')->where('summary', 'Canon EOS 7D')->first();
        $this->assertNotNull($itemToUpdate, "Seeded item for update test not found.");

        $originalSummary = $itemToUpdate->summary;
        $updatedData = [
            'id' => $itemToUpdate->id,
            'summary' => 'Updated Canon EOS 7D',
            'details' => 'Updated details for the 7D.',
        ];

        $response = $this->post('/update_item_action', $updatedData);

        $this->assertDatabaseHas('item', [
            'id' => $itemToUpdate->id,
            'summary' => $updatedData['summary'],
            'details' => $updatedData['details'],
        ]);
        $this->assertDatabaseMissing('item', [
            'id' => $itemToUpdate->id,
            'summary' => $originalSummary,
        ]);

        $response->assertRedirect(url("item_detail/{$itemToUpdate->id}"));

        $this->get(url("item_detail/{$itemToUpdate->id}"))
             ->assertSee($updatedData['summary'])
             ->assertSee($updatedData['details']);
    }

    /**
     * Test handles delete item requests.
     */
    public function test_can_delete_an_item(): void
    {
        $itemToDelete = DB::table('item')->where('summary', 'Fujifilm X-Pro1')->first();
        $this->assertNotNull($itemToDelete, "Seeded item for delete test not found.");
        $summaryToDelete = $itemToDelete->summary;

        $response = $this->get('/item_delete/' . $itemToDelete->id);

        $this->assertDatabaseMissing('item', ['id' => $itemToDelete->id]);
        $response->assertRedirect(url("/"));

        $this->get('/')->assertDontSee($summaryToDelete);
    }

}
