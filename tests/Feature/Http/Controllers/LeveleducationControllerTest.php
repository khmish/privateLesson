<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Leveleducation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LeveleducationController
 */
class LeveleducationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $leveleducations = Leveleducation::factory()->count(3)->create();

        $response = $this->get(route('leveleducation.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeveleducationController::class,
            'store',
            \App\Http\Requests\LeveleducationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;

        $response = $this->post(route('leveleducation.store'), [
            'name' => $name,
        ]);

        $leveleducations = Leveleducation::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $leveleducations);
        $leveleducation = $leveleducations->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $leveleducation = Leveleducation::factory()->create();

        $response = $this->get(route('leveleducation.show', $leveleducation));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeveleducationController::class,
            'update',
            \App\Http\Requests\LeveleducationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $leveleducation = Leveleducation::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('leveleducation.update', $leveleducation), [
            'name' => $name,
        ]);

        $leveleducation->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $leveleducation->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $leveleducation = Leveleducation::factory()->create();

        $response = $this->delete(route('leveleducation.destroy', $leveleducation));

        $response->assertNoContent();

        $this->assertDeleted($leveleducation);
    }
}
