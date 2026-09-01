SELECT COUNT(*) AS required_tables
FROM information_schema.tables
WHERE table_schema = DATABASE()
  AND table_name IN (
    'job_seeker', 'resume', 'work_experience', 'education',
    'skill', 'resume_skill', 'professional_organization', 'publication'
  );
