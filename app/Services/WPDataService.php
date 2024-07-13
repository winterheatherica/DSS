<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class WPDataService
{
    public static function getWP1Data($history_id)
    {
        return DB::table('tb_criteria_proportion as cp')
            ->join('tb_criteria as c', 'cp.criteria_id', '=', 'c.criteria_id')
            ->crossJoin(DB::raw('(SELECT SUM(criteria_value) AS total_criteria_value FROM tb_criteria_proportion WHERE history_id = ' . $history_id . ') t'))
            ->select(
                'cp.criteria_id',
                'c.criteria_name',
                'c.criteria_status',
                'cp.criteria_value',
                DB::raw('CASE WHEN c.criteria_status = \'c\' THEN (cp.criteria_value / t.total_criteria_value) * -1 ELSE cp.criteria_value / t.total_criteria_value END AS Normalisasi_Criteria')
            )
            ->where('cp.history_id', $history_id)
            ->get();
    }

    public static function getWP2Data($history_id)
    {
        return DB::table(DB::raw('
            (WITH Total_Criteria_Value AS (
                SELECT 
                    SUM(criteria_value) AS total_criteria_value
                FROM 
                    tb_criteria_proportion
                WHERE 
                    history_id = ' . $history_id . '
            ),
            Normalisasi_Criteria AS (
                SELECT 
                    cp.criteria_id,
                    CASE
                        WHEN c.criteria_status = \'c\' THEN (cp.criteria_value * -1) / t.total_criteria_value
                        ELSE cp.criteria_value / t.total_criteria_value
                    END AS normalisasi_criteria
                FROM 
                    tb_criteria_proportion cp
                JOIN 
                    tb_criteria c ON cp.criteria_id = c.criteria_id
                CROSS JOIN 
                    Total_Criteria_Value t
                WHERE 
                    cp.history_id = ' . $history_id . '
            ),
            Alternative_Normalisasi AS (
                SELECT 
                    ac.alternative_id,
                    EXP(SUM(LOG(ac.alternative_criteria_value) * nc.normalisasi_criteria)) AS normalisasi_alternative
                FROM 
                    tb_alternative_criteria ac
                JOIN 
                    Normalisasi_Criteria nc ON ac.criteria_id = nc.criteria_id
                GROUP BY 
                    ac.alternative_id
            )
            SELECT 
                alternative_id,
                normalisasi_alternative AS Normalisasi_Alternative
            FROM 
                Alternative_Normalisasi) as wp2_data'))
            ->get();
    }

    public static function getWP3Data($history_id)
    {
        return DB::table(DB::raw('
            (WITH Total_Normalisasi AS (
                SELECT 
                    SUM(normalisasi_alternative) AS total_normalisasi_alternative
                FROM (
                    SELECT 
                        ac.alternative_id,
                        EXP(SUM(LOG(POWER(ac.alternative_criteria_value, nc.normalisasi_criteria)))) AS normalisasi_alternative
                    FROM 
                        tb_alternative_criteria ac
                    JOIN 
                        (
                            SELECT 
                                cp.criteria_id,
                                CASE
                                    WHEN c.criteria_status = \'c\' THEN (cp.criteria_value * -1) / t.total_criteria_value
                                    ELSE cp.criteria_value / t.total_criteria_value
                                END AS normalisasi_criteria
                            FROM 
                                tb_criteria_proportion cp
                            JOIN 
                                tb_criteria c ON cp.criteria_id = c.criteria_id
                            CROSS JOIN (
                                SELECT 
                                    SUM(criteria_value) AS total_criteria_value
                                FROM 
                                    tb_criteria_proportion
                                WHERE 
                                    history_id = ' . $history_id . '
                            ) t
                            WHERE 
                                cp.history_id = ' . $history_id . '
                        ) nc ON ac.criteria_id = nc.criteria_id
                    GROUP BY 
                        ac.alternative_id
                ) AS subquery_total
            )
            SELECT 
                subquery_final.alternative_id,
                subquery_final.normalisasi_alternative / tn.total_normalisasi_alternative AS Hasil_Akhir
            FROM (
                SELECT 
                    ac.alternative_id,
                    EXP(SUM(LOG(POWER(ac.alternative_criteria_value, nc.normalisasi_criteria)))) AS normalisasi_alternative
                FROM 
                    tb_alternative_criteria ac
                JOIN 
                    (
                        SELECT 
                            cp.criteria_id,
                            CASE
                                WHEN c.criteria_status = \'c\' THEN (cp.criteria_value * -1) / t.total_criteria_value
                                ELSE cp.criteria_value / t.total_criteria_value
                            END AS normalisasi_criteria
                        FROM 
                            tb_criteria_proportion cp
                        JOIN 
                            tb_criteria c ON cp.criteria_id = c.criteria_id
                        CROSS JOIN (
                            SELECT 
                                SUM(criteria_value) AS total_criteria_value
                            FROM 
                                tb_criteria_proportion
                            WHERE 
                                history_id = ' . $history_id . '
                        ) t
                        WHERE 
                            cp.history_id = ' . $history_id . '
                    ) nc ON ac.criteria_id = nc.criteria_id
                GROUP BY 
                    ac.alternative_id
            ) AS subquery_final
            JOIN 
                Total_Normalisasi tn) as wp3_data'))
            ->get();
    }
}
