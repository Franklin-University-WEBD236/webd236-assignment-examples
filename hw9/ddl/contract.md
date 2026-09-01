Create the resume database DDL [4 points]

Write the CREATE TABLE statements, primary keys, and foreign keys for the resume application in resume.sql. Your design may include additional tables or columns, but the following minimum naming contract is required so the database can be tested automatically.

Required tables and minimum columns:

- job_seeker: job_seeker_id, first_name, last_name, email
- resume: resume_id, job_seeker_id, title, objective
- work_experience: work_experience_id, resume_id, employer, job_title, start_date, end_date, description
- education: education_id, resume_id, institution, credential, start_date, end_date
- skill: skill_id, name
- resume_skill: resume_id, skill_id
- professional_organization: professional_organization_id, resume_id, name
- publication: publication_id, resume_id, title, published_on

Required keys and relationships:

- Every required table must have a primary key. resume_skill may use the composite primary key (resume_id, skill_id).
- resume.job_seeker_id references job_seeker.job_seeker_id.
- work_experience.resume_id, education.resume_id, professional_organization.resume_id, and publication.resume_id each reference resume.resume_id.
- resume_skill.resume_id references resume.resume_id.
- resume_skill.skill_id references skill.skill_id.

The four visible one-point tests check required tables, minimum columns, primary keys, and foreign-key relationships separately. Extra well-designed schema elements are allowed.
