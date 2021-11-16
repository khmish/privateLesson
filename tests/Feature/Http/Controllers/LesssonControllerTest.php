<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Lessson;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LesssonController
 */
class LesssonControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $lesssons = Lessson::factory()->count(3)->create();

        $response = $this->get(route('lessson.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LesssonController::class,
            'store',
            \App\Http\Requests\LesssonStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $subject = Subject::factory()->create();
        $state = $this->faker->word;

        $response = $this->post(route('lessson.store'), [
            'subject_id' => $subject->id,
            'state' => $state,
        ]);

        $lesssons = Lessson::query()
            ->where('subject_id', $subject->id)
            ->where('state', $state)
            ->get();
        $this->assertCount(1, $lesssons);
        $lessson = $lesssons->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $lessson = Lessson::factory()->create();

        $response = $this->get(route('lessson.show', $lessson));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LesssonController::class,
            'update',
            \App\Http\Requests\LesssonUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $lessson = Lessson::factory()->create();
        $subject = Subject::factory()->create();
        $state = $this->faker->word;

        $response = $this->put(route('lessson.update', $lessson), [
            'subject_id' => $subject->id,
            'state' => $state,
        ]);

        $lessson->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($subject->id, $lessson->subject_id);
        $this->assertEquals($state, $lessson->state);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $lessson = Lessson::factory()->create();

        $response = $this->delete(route('lessson.destroy', $lessson));

        $response->assertNoContent();

        $this->assertSoftDeleted($lessson);
    }
}
