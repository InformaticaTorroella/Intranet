<?php

namespace App\Http\Controllers;

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
                se.serie,          -- añadido nombre serie
                t.codi
            FROM quadres_classificacions q
            JOIN seccions s ON q.fk_id_seccio = s.id_seccio
            JOIN subseccions ss ON q.fk_id_subseccio = ss.id_subseccio
            JOIN series se ON q.fk_id_serie = se.id_serie  -- join para nombre serie
            LEFT JOIN quadres_classificacions_tipologies qct ON q.id = qct.fk_id_quadre_classificacio
            LEFT JOIN tipologies_gial t ON qct.fk_id_tipologia_gial = t.id
            ORDER BY q.id
        ");

        $grouped = [];
        foreach ($data as $row) {
            $id = $row->id_quadre;
            if (!isset($grouped[$id])) {
                $grouped[$id] = [
                    'id_seccio' => $row->id_seccio,
                    'seccio' => $row->seccio,
                    'id_subseccio' => $row->id_subseccio,
                    'subseccio' => $row->subseccio,
                    'fk_id_serie' => $row->fk_id_serie,
                    'serie' => $row->serie,   
                    'tipologies' => [],
                ];
            }
            if ($row->codi !== null) {
                $grouped[$id]['tipologies'][] = $row->codi;
            }
        }

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
            fwrite($file, "\xEF\xBB\xBF");

            $header = [
                'ID Seccio',
                'Seccio',
                'ID Subseccio',
                'Subseccio',
                'ID Serie',
                'Serie',
            ];
            for ($i = 1; $i <= $maxTipologies; $i++) {
                $header[] = "Tipología $i";
            }
            fputcsv($file, $header, ';');

            foreach ($grouped as $row) {
                $line = [
                    $row['id_seccio'],
                    $row['seccio'],
                    $row['id_subseccio'],
                    $row['subseccio'],
                    $row['fk_id_serie'],
                    $row['serie'],
                ];
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
