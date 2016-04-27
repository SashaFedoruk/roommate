SELECT id, from_id, MAX(created_at) as updated_at
FROM (SELECT id, from_id, created_at
FROM messages
WHERE for_id = 1
UNION SELECT id, for_id, created_at
FROM messages
WHERE from_id = 1
ORDER BY created_at DESC) as talks
GROUP BY from_id
ORDER BY created_at DESC;

SELECT id, from_id, MAX(created_at) as updated_at
FROM (SELECT id, from_id, created_at
FROM messages
WHERE for_id = 2
UNION SELECT id, for_id, created_at
FROM messages
WHERE from_id = 2
ORDER BY created_at DESC) as talks
GROUP BY from_id
ORDER BY created_at DESC;