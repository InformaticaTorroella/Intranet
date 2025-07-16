<?php

namespace App\Http\Controllers;

use App\Models\QuadreClassificacio;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function exportCsv()
    {
        $filename = "export_quadres.csv";

        $data = DB::select("
            SELECT
                q.id AS id_quadre,
                s.id_seccio,
                s.seccio,
                ss.id_subseccio,
                ss.subseccio,
                q.fk_id_serie,
                t.codi
            FROM quadres_classificacions q
            JOIN seccions s ON q.fk_id_seccio = s.id_seccio
            JOIN subseccions ss ON q.fk_id_subseccio = ss.id_subseccio
            LEFT JOIN quadres_classificacions_tipologies qct ON q.id = qct.fk_id_quadre_classificacio
            LEFT JOIN tipologies_gial t ON qct.fk_id_tipologia_gial = t.id
            ORDER BY q.id
        ");

        // Agrupar tipologías por cuadro
        $grouped = [];
        foreach ($data as $row) {
            $id = $row->id_quadre;
            if (!isset($grouped[$id])) {
                $grouped[$id] = [
                    'id_seccio' => $row->id_seccio,
                    'seccio' => $row->seccio,
                    'id_subseccio' => $row->id_subseccio,
                    'subseccio' => $row->subseccio,
                    'id_quadre' => $row->id_quadre,
                    'fk_id_serie' => $row->fk_id_serie,
                    'tipologies' => [],
                ];
            }
            if ($row->codi !== null) {
                $grouped[$id]['tipologies'][] = $row->codi;
            }
        }

        // Calcular máximo número de tipologías para columnas
        $maxTipologies = 0;
        foreach ($grouped as $item) {
            $count = count($item['tipologies']);
            if ($count > $maxTipologies) {
                $maxTipologies = $count;
            }
        }

        $headers = [
            "Content-Type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($grouped, $maxTipologies) {
            $file = fopen('php://output', 'w');

            // Escribir BOM UTF-8 para que Excel lo detecte bien
            fwrite($file, "\xEF\xBB\xBF");

            // Encabezados básicos
            $header = [
                'ID Seccio',
                'Seccio',
                'ID Subseccio',
                'Subsecció',
                'ID Quadre',
                'ID Serie',
            ];
            // Añadir encabezados para cada tipología
            for ($i = 1; $i <= $maxTipologies; $i++) {
                $header[] = "Tipología $i";
            }
            // Usar ; como delimitador en fputcsv:
            fputcsv($file, $header, ';');

            foreach ($grouped as $row) {
                $line = [
                    $row['id_seccio'],
                    $row['seccio'],
                    $row['id_subseccio'],
                    $row['subseccio'],
                    $row['id_quadre'],
                    $row['fk_id_serie'],
                ];
                // Añadir tipologías, rellenando con '' si no hay suficientes
                for ($i = 0; $i < $maxTipologies; $i++) {
                    $line[] = $row['tipologies'][$i] ?? '';
                }

                fputcsv($file, $line, ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
