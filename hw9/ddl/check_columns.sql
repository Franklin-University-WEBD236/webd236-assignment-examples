SELECT COUNT(*) AS required_columns
FROM information_schema.columns
WHERE table_schema = DATABASE()
  AND CONCAT(table_name, '.', column_name) IN (
    'job_seeker.job_seeker_id', 'job_seeker.first_name', 'job_seeker.last_name', 'job_seeker.email',
    'resume.resume_id', 'resume.job_seeker_id', 'resume.title', 'resume.objective',
    'work_experience.work_experience_id', 'work_experience.resume_id', 'work_experience.employer',
    'work_experience.job_title', 'work_experience.start_date', 'work_experience.end_date', 'work_experience.description',
    'education.education_id', 'education.resume_id', 'education.institution', 'education.credential',
    'education.start_date', 'education.end_date',
    'skill.skill_id', 'skill.name',
    'resume_skill.resume_id', 'resume_skill.skill_id',
    'professional_organization.professional_organization_id', 'professional_organization.resume_id',
    'professional_organization.name',
    'publication.publication_id', 'publication.resume_id', 'publication.title', 'publication.published_on'
  );
