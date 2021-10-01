<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Leveleducation;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SubjectController
 */
class SubjectControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $subjects = Subject::factory()->count(3)->create();

        $response = $this->get(route('subject.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SubjectController::class,
            'store',
            \App\Http\Requests\SubjectStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $leveleducation = Leveleducation::factory()->create();
        $name = $this->faker->name;
        $pic = $this->faker->text;

        $response = $this->post(route('subject.store'), [
            'leveleducation_id' => $leveleducation->id,
            'name' => $name,
            'pic' => $pic,
        ]);

        $subjects = Subject::query()
            ->where('leveleducation_id', $leveleducation->id)
            ->where('name', $name)
            ->where('pic', $pic)
            ->get();
        $this->assertCount(1, $subjects);
        $subject = $subjects->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $subject = Subject::factory()->create();

        $response = $this->get(route('subject.show', $subject));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SubjectController::class,
            'update',
            \App\Http\Requests\SubjectUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $subject = Subject::factory()->create();
        $leveleducation = Leveleducation::factory()->create();
        $name = $this->faker->name;
        $pic = $this->faker->text;

        $response = $this->put(route('subject.update', $subject), [
            'leveleducation_id' => $leveleducation->id,
            'name' => $name,
            'pic' => $pic,
        ]);

        $subject->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($leveleducation->id, $subject->leveleducation_id);
        $this->assertEquals($name, $subject->name);
        $this->assertEquals($pic, $subject->pic);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $subject = Subject::factory()->create();

        $response = $this->delete(route('subject.destroy', $subject));

        $response->assertNoContent();

        $this->assertSoftDeleted($subject);
    }
}
