SELECT COUNT(DISTINCT table_name) AS tables_with_primary_keys
FROM information_schema.table_constraints
WHERE constraint_schema = DATABASE()
  AND constraint_type = 'PRIMARY KEY'
  AND table_name IN (
    'job_seeker', 'resume', 'work_experience', 'education',
    'skill', 'resume_skill', 'professional_organization', 'publication'
  );
