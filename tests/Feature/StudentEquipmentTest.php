<?php

use App\Models\StudentEquipment;

test('active student equipments', function () {
    StudentEquipment::factory()->count(2)->create(['active' => true]);

    $response = $this->get("/api/student_equipments-active");

    $response->assertStatus(200)
             ->assertJsonCount(2);
});

test('finish student equipment', function () {
    $equipment = StudentEquipment::factory()->create(['active' => true]);

    $response = $this->put("/api/student_equipments/{$equipment->id}/finish");

    $response->assertStatus(200);

    $equipment->refresh();
    expect($equipment->active)->toBeFalse();
});
