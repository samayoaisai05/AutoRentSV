<?php

namespace Tests\Feature;

use App\Models\Reserva;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_total_gastado_only_counts_approved_and_finalized_reservas(): void
    {
        $user = User::factory()->create();

        $vehiculo = Vehiculo::create([
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'anio' => 2024,
            'color' => 'Blanco',
            'placa' => 'ABC123',
            'precio_dia' => 50,
            'imagen' => null,
            'descripcion' => 'Vehículo de prueba',
            'estado' => 'Disponible',
        ]);

        Reserva::create([
            'user_id' => $user->id,
            'vehiculo_id' => $vehiculo->id,
            'fecha_inicio' => '2026-06-01',
            'fecha_fin' => '2026-06-02',
            'dias' => 1,
            'precio_dia' => 100,
            'total' => 100,
            'estado' => 'Pendiente',
        ]);

        Reserva::create([
            'user_id' => $user->id,
            'vehiculo_id' => $vehiculo->id,
            'fecha_inicio' => '2026-06-03',
            'fecha_fin' => '2026-06-04',
            'dias' => 1,
            'precio_dia' => 200,
            'total' => 200,
            'estado' => 'Cancelada',
        ]);

        Reserva::create([
            'user_id' => $user->id,
            'vehiculo_id' => $vehiculo->id,
            'fecha_inicio' => '2026-06-05',
            'fecha_fin' => '2026-06-06',
            'dias' => 1,
            'precio_dia' => 300,
            'total' => 300,
            'estado' => 'Aprobada',
        ]);

        Reserva::create([
            'user_id' => $user->id,
            'vehiculo_id' => $vehiculo->id,
            'fecha_inicio' => '2026-06-07',
            'fecha_fin' => '2026-06-08',
            'dias' => 1,
            'precio_dia' => 50,
            'total' => 50,
            'estado' => 'Finalizada',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('$ 350.00');
        $response->assertDontSee('$ 650.00');
    }
}
