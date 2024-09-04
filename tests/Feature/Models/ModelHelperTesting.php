<?php
namespace Tests\Feature\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

trait ModelHelperTesting
{
    public function testInserData(): void
    {
        $model = $this->model();
        $table = $model->getTable();
        $data = $model::factory()->make()->toArray();
        $model::create($data);
        $this->assertDatabaseHas($table, $data);
    }
    abstract protected function model(): Model;
}
