SELECT
    c.id as idC, c.calle, c.numero,
    p.id as idP, p.nombre, 
    a.id as isA, a.costo, a.duracionMeses as duracion 
FROM 
    alquiler a
INNER JOIN persona p ON a.persona_id = p.id
INNER JOIN casa c ON a.casa_id = c.id;