SELECT 
    cp.criteria_id,
    c.criteria_name,
    c.criteria_status,
    cp.criteria_value,
    CASE
        WHEN c.criteria_status = 'c' THEN (cp.criteria_value / t.total_criteria_value) * -1
        ELSE cp.criteria_value / t.total_criteria_value
    END AS `Normalisasi Criteria`
FROM 
    tb_criteria_proportion cp
JOIN
    tb_criteria c ON cp.criteria_id = c.criteria_id
CROSS JOIN
    (SELECT SUM(criteria_value) AS total_criteria_value 
     FROM tb_criteria_proportion 
     WHERE history_id = 1) t
WHERE 
    cp.history_id = 1;