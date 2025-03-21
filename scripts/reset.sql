DELETE FROM crm2.users
WHERE id NOT IN (
    SELECT user_id
    FROM crm2.role_user ru
    JOIN crm2.roles r ON ru.role_id = r.id
    WHERE r.name = 'administrator'
);
