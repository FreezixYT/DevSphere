USE `DevSphere`;
-- Passwords are 'Super'

INSERT INTO `User` (`name`, `lastname`, `username`, `email`, `password`, `type`)
VALUES
('Alice', 'Martin', 'alice_m', 'alice@example.com',
 '$2a$12$uJqBMRAPiGgnuyL0A2OV1.qSqRgCKdgYkUV9rUKFP1AZ.IB9hL8da', 'Member'),

('Bob', 'Durand', 'bobbyd', 'bob@example.com',
 '$2a$12$uJqBMRAPiGgnuyL0A2OV1.qSqRgCKdgYkUV9rUKFP1AZ.IB9hL8da', 'Member'),

('Charlie', 'Nguyen', 'charlie_dev', 'charlie@example.com',
 '$2a$12$uJqBMRAPiGgnuyL0A2OV1.qSqRgCKdgYkUV9rUKFP1AZ.IB9hL8da', 'Admin'),

('Diana', 'Lopez', 'diana_codes', 'diana@example.com',
 '$2a$12$uJqBMRAPiGgnuyL0A2OV1.qSqRgCKdgYkUV9rUKFP1AZ.IB9hL8da', 'Member'),

('Ethan', 'Keller', 'ethank', 'ethan@example.com',
 '$2a$12$uJqBMRAPiGgnuyL0A2OV1.qSqRgCKdgYkUV9rUKFP1AZ.IB9hL8da', 'Member');


INSERT INTO `Tag` (`name`)
VALUES
('JavaScript'),
('Python'),
('Node.js'),
('React'),
('SQL'),
('DevOps'),
('UI/UX'),
('Machine Learning');


INSERT INTO `UserTag` (`userId`, `tagId`)
VALUES
(1, 4), -- Alice: React
(1, 7), -- Alice: UI/UX
(2, 1), -- Bob: JavaScript
(2, 3), -- Bob: Node.js
(3, 5), -- Charlie: SQL
(3, 6), -- Charlie: DevOps
(4, 4), -- Diana: React
(4, 1), -- Diana: JavaScript
(5, 8); -- Ethan: Machine Learning


INSERT INTO `Project` (`name`, `description`, `userId`)
VALUES
('TaskFlow', 'A task management app for teams.', 1),
('EcoTrack', 'Track your carbon footprint with smart suggestions.', 2),
('DevMatch', 'A platform to match developers to open-source projects.', 3),
('FitBuddy', 'AI-powered fitness assistant.', 5);


-- NEW: Role table without userId
INSERT INTO `Role` (`id`, `name`, `description`, `projectId`)
VALUES
(1, 'Frontend Developer', 'Build UI components in React.', 1),
(2, 'Backend Developer', 'Implement API and database logic.', 1),
(3, 'Data Scientist', 'Develop ML models for recommendations.', 2),
(4, 'DevOps Engineer', 'Manage CI/CD pipelines.', 3),
(5, 'Mobile Developer', 'Create mobile interface for the app.', 4);


-- NEW: UserRole join table (replacing Role.userId)
-- From your original data:
-- Role 2 had userId = 2 (Bob)
INSERT INTO `UserRole` (`userId`, `roleId`)
VALUES
(2, 2); -- Bob is Backend Developer


INSERT INTO `RoleTag` (`roleId`, `tagId`)
VALUES
-- Role 1: Frontend Developer (React UI)
(1, 1),  -- JavaScript
(1, 4),  -- React
(1, 7),  -- UI/UX

-- Role 2: Backend Developer (Node.js + SQL)
(2, 1),  -- JavaScript
(2, 3),  -- Node.js
(2, 5),  -- SQL

-- Role 3: Data Scientist (ML + Python)
(3, 2),  -- Python
(3, 8),  -- Machine Learning

-- Role 4: DevOps Engineer
(4, 6),  -- DevOps
(4, 5),  -- SQL

-- Role 5: Mobile Developer (UI + JS)
(5, 1),  -- JavaScript
(5, 7);  -- UI/UX


INSERT INTO `Request` (`roleId`, `userId`, `message`, `status`)
VALUES
(1, 2, 'I would love to help with the React UI.', 'Pending'),
(1, 4, 'Experienced with React, happy to join.', 'Accepted'),
(3, 5, 'I can help with ML models.', 'Pending'),
(4, 1, 'Interested in DevOps tasks.', 'Declined'),
(5, 2, 'I can build the mobile version.', 'Pending');