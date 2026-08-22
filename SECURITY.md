# Security Policy

This repository is a portfolio/demo Learning Management System. It is designed to demonstrate secure application patterns, but a public production deployment should still apply normal infrastructure and operational hardening.

## Security Controls Demonstrated

- Separate Laravel authentication guards for administrators, teachers, and students
- No public administrator or teacher self-registration
- Enrollment-based student access to courses and assessments
- Authenticated student identity used for assessment submissions
- Question-to-assessment ownership validation
- Student answer detail access scoped to the authenticated student
- Administrator-only payment receipt access
- Request validation on protected CRUD flows
- Laravel password hashing
- Sanitized fictional demo data
- Automated CI verification for migrations, tests, routes, syntax, and frontend build

## Production Deployment Expectations

A production deployment should additionally use:

- HTTPS only
- Strong environment-specific `APP_KEY` and database credentials
- Production-safe session and cookie settings
- Web-server and application rate limiting
- Regular dependency/security updates
- Database backups and least-privilege database users
- Centralized logging and monitoring
- Server-side file upload limits and malware scanning where appropriate
- Separate production secrets from source control

## Reporting a Security Issue

Please avoid publishing sensitive security findings in a public issue. Contact the repository owner privately through the contact information available on the GitHub profile.
