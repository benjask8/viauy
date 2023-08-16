SELECT
    *
FROM
    alquiler a
INNER JOIN persona ON a.persona_id = persona.id
INNER JOIN casa ON a.casa_id = casa.id;