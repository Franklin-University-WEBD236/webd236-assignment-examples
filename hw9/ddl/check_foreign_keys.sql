SELECT COUNT(*) AS required_foreign_keys
FROM information_schema.key_column_usage
WHERE constraint_schema = DATABASE()
  AND referenced_table_name IS NOT NULL
  AND CONCAT(table_name, '.', column_name, '>', referenced_table_name, '.', referenced_column_name) IN (
    'resume.job_seeker_id>job_seeker.job_seeker_id',
    'work_experience.resume_id>resume.resume_id',
    'education.resume_id>resume.resume_id',
    'resume_skill.resume_id>resume.resume_id',
    'resume_skill.skill_id>skill.skill_id',
    'professional_organization.resume_id>resume.resume_id',
    'publication.resume_id>resume.resume_id'
  );
