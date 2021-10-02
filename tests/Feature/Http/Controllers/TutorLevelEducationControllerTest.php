<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Leveleducation;
use App\Models\Tutor;
use App\Models\TutorLevelEducation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TutorLevelEducationController
 */
class TutorLevelEducationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $tutorLevelEducations = TutorLevelEducation::factory()->count(3)->create();

        $response = $this->get(route('tutor-level-education.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TutorLevelEducationController::class,
            'store',
            \App\Http\Requests\TutorLevelEducationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $tutor = Tutor::factory()->create();
        $leveleducation = Leveleducation::factory()->create();

        $response = $this->post(route('tutor-level-education.store'), [
            'tutor_id' => $tutor->id,
            'leveleducation_id' => $leveleducation->id,
        ]);

        $tutorLevelEducations = TutorLevelEducation::query()
            ->where('tutor_id', $tutor->id)
            ->where('leveleducation_id', $leveleducation->id)
            ->get();
        $this->assertCount(1, $tutorLevelEducations);
        $tutorLevelEducation = $tutorLevelEducations->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $tutorLevelEducation = TutorLevelEducation::factory()->create();

        $response = $this->get(route('tutor-level-education.show', $tutorLevelEducation));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TutorLevelEducationController::class,
            'update',
            \App\Http\Requests\TutorLevelEducationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $tutorLevelEducation = TutorLevelEducation::factory()->create();
        $tutor = Tutor::factory()->create();
        $leveleducation = Leveleducation::factory()->create();

        $response = $this->put(route('tutor-level-education.update', $tutorLevelEducation), [
            'tutor_id' => $tutor->id,
            'leveleducation_id' => $leveleducation->id,
        ]);

        $tutorLevelEducation->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($tutor->id, $tutorLevelEducation->tutor_id);
        $this->assertEquals($leveleducation->id, $tutorLevelEducation->leveleducation_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $tutorLevelEducation = TutorLevelEducation::factory()->create();

        $response = $this->delete(route('tutor-level-education.destroy', $tutorLevelEducation));

        $response->assertNoContent();

        $this->assertSoftDeleted($tutorLevelEducation);
    }
}
