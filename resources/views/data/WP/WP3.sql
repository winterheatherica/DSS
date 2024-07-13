WITH Total_Normalisasi AS (
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
                        WHEN c.criteria_status = 'c' THEN (cp.criteria_value * -1) / t.total_criteria_value
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
                        history_id = 1
                ) t
                WHERE 
                    cp.history_id = 1
            ) nc ON ac.criteria_id = nc.criteria_id
        GROUP BY 
            ac.alternative_id
    ) AS subquery_total
)

SELECT 
    subquery_final.alternative_id,
    subquery_final.normalisasi_alternative / tn.total_normalisasi_alternative AS `Hasil Akhir`
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
                    WHEN c.criteria_status = 'c' THEN (cp.criteria_value * -1) / t.total_criteria_value
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
                    history_id = 1
            ) t
            WHERE 
                cp.history_id = 1
        ) nc ON ac.criteria_id = nc.criteria_id
    GROUP BY 
        ac.alternative_id
) AS subquery_final
JOIN 
    Total_Normalisasi tn;