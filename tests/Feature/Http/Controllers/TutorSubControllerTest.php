<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Subject;
use App\Models\Tutor;
use App\Models\TutorSub;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TutorSubController
 */
class TutorSubControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $tutorSubs = TutorSub::factory()->count(3)->create();

        $response = $this->get(route('tutor-sub.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TutorSubController::class,
            'store',
            \App\Http\Requests\TutorSubStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $tutor = Tutor::factory()->create();
        $subject = Subject::factory()->create();

        $response = $this->post(route('tutor-sub.store'), [
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
        ]);

        $tutorSubs = TutorSub::query()
            ->where('tutor_id', $tutor->id)
            ->where('subject_id', $subject->id)
            ->get();
        $this->assertCount(1, $tutorSubs);
        $tutorSub = $tutorSubs->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $tutorSub = TutorSub::factory()->create();

        $response = $this->get(route('tutor-sub.show', $tutorSub));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TutorSubController::class,
            'update',
            \App\Http\Requests\TutorSubUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $tutorSub = TutorSub::factory()->create();
        $tutor = Tutor::factory()->create();
        $subject = Subject::factory()->create();

        $response = $this->put(route('tutor-sub.update', $tutorSub), [
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
        ]);

        $tutorSub->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($tutor->id, $tutorSub->tutor_id);
        $this->assertEquals($subject->id, $tutorSub->subject_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $tutorSub = TutorSub::factory()->create();

        $response = $this->delete(route('tutor-sub.destroy', $tutorSub));

        $response->assertNoContent();

        $this->assertSoftDeleted($tutorSub);
    }
}
