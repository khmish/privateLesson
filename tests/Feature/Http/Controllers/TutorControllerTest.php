<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TutorController
 */
class TutorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $tutors = Tutor::factory()->count(3)->create();

        $response = $this->get(route('tutor.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TutorController::class,
            'store',
            \App\Http\Requests\TutorStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user = User::factory()->create();
        $title_cert = $this->faker->word;
        $price = $this->faker->word;
        $type = $this->faker->word;

        $response = $this->post(route('tutor.store'), [
            'user_id' => $user->id,
            'title_cert' => $title_cert,
            'price' => $price,
            'type' => $type,
        ]);

        $tutors = Tutor::query()
            ->where('user_id', $user->id)
            ->where('title_cert', $title_cert)
            ->where('price', $price)
            ->where('type', $type)
            ->get();
        $this->assertCount(1, $tutors);
        $tutor = $tutors->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $tutor = Tutor::factory()->create();

        $response = $this->get(route('tutor.show', $tutor));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TutorController::class,
            'update',
            \App\Http\Requests\TutorUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $tutor = Tutor::factory()->create();
        $user = User::factory()->create();
        $title_cert = $this->faker->word;
        $price = $this->faker->word;
        $type = $this->faker->word;

        $response = $this->put(route('tutor.update', $tutor), [
            'user_id' => $user->id,
            'title_cert' => $title_cert,
            'price' => $price,
            'type' => $type,
        ]);

        $tutor->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $tutor->user_id);
        $this->assertEquals($title_cert, $tutor->title_cert);
        $this->assertEquals($price, $tutor->price);
        $this->assertEquals($type, $tutor->type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $tutor = Tutor::factory()->create();

        $response = $this->delete(route('tutor.destroy', $tutor));

        $response->assertNoContent();

        $this->assertSoftDeleted($tutor);
    }
}
