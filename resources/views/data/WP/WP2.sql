WITH Total_Criteria_Value AS (
    SELECT 
        SUM(criteria_value) AS total_criteria_value
    FROM 
        tb_criteria_proportion
    WHERE 
        history_id = 1
),
Normalisasi_Criteria AS (
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
    CROSS JOIN 
        Total_Criteria_Value t
    WHERE 
        cp.history_id = 1
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
    normalisasi_alternative AS `Normalisasi Alternative`
FROM 
    Alternative_Normalisasi;