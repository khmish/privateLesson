<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Review;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReviewController
 */
class ReviewControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $reviews = Review::factory()->count(3)->create();

        $response = $this->get(route('review.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReviewController::class,
            'store',
            \App\Http\Requests\ReviewStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $stars = $this->faker->word;
        $teacher = Teacher::factory()->create();
        $student = Student::factory()->create();

        $response = $this->post(route('review.store'), [
            'stars' => $stars,
            'teacher_id' => $teacher->id,
            'student_id' => $student->id,
        ]);

        $reviews = Review::query()
            ->where('stars', $stars)
            ->where('teacher_id', $teacher->id)
            ->where('student_id', $student->id)
            ->get();
        $this->assertCount(1, $reviews);
        $review = $reviews->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $review = Review::factory()->create();

        $response = $this->get(route('review.show', $review));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReviewController::class,
            'update',
            \App\Http\Requests\ReviewUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $review = Review::factory()->create();
        $stars = $this->faker->word;
        $teacher = Teacher::factory()->create();
        $student = Student::factory()->create();

        $response = $this->put(route('review.update', $review), [
            'stars' => $stars,
            'teacher_id' => $teacher->id,
            'student_id' => $student->id,
        ]);

        $review->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($stars, $review->stars);
        $this->assertEquals($teacher->id, $review->teacher_id);
        $this->assertEquals($student->id, $review->student_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $review = Review::factory()->create();

        $response = $this->delete(route('review.destroy', $review));

        $response->assertNoContent();

        $this->assertSoftDeleted($review);
    }
}
