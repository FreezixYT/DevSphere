DROP DATABASE IF EXISTS `DevSphere`;
CREATE DATABASE `DevSphere`;

USE `DevSphere`;

CREATE TABLE `User`(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) UNIQUE NOT NULL,
    `lastname` VARCHAR(100) NOT NULL,
    `username` VARCHAR(20) UNIQUE NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `type` ENUM('Member', 'Admin') NOT NULL,
    `createdAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE `Tag`(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE `UserTag`(
    `userId` INT UNSIGNED NOT NULL,
    `tagId` INT UNSIGNED NOT NULL,
    PRIMARY KEY(`userId`,`tagId`),
    CONSTRAINT fk_usertag_user
        FOREIGN KEY (`userId`) REFERENCES `User`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_usertag_tag
        FOREIGN KEY (`tagId`) REFERENCES `Tag`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE `Project`(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `description` TEXT NOT NULL,
    `userId` INT UNSIGNED NOT NULL,
    CONSTRAINT fk_project_user
        FOREIGN KEY (`userId`) REFERENCES `User`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE `ProjectTag`(
    `projectId` INT UNSIGNED NOT NULL,
    `tagId` INT UNSIGNED NOT NULL,
    PRIMARY KEY(`projectId`,`tagId`),
    CONSTRAINT fk_projecttag_project
        FOREIGN KEY (`projectId`) REFERENCES `Project`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_projecttag_tag
        FOREIGN KEY (`tagId`) REFERENCES `Tag`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE `Role`(
    `id` INT UNSIGNED NOT NULL PRIMARY KEY,
    `name` VARCHAR(30) NOT NULL,
    `description` VARCHAR(150) NOT NULL,
    `projectId` INT UNSIGNED NOT NULL,
    CONSTRAINT fk_role_project
        FOREIGN KEY (`projectId`) REFERENCES `Project`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE `UserRole`(
    `roleId` INT UNSIGNED NOT NULL,
    `userId` INT UNSIGNED NOT NULL,
    PRIMARY KEY(`roleId`,`userId`),
    CONSTRAINT fk_roleuser_role
        FOREIGN KEY (`roleId`) REFERENCES `Role`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_roleuser_user
        FOREIGN KEY (`userId`) REFERENCES `User`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE `RoleTag`(
    `roleId` INT UNSIGNED NOT NULL,
    `tagId` INT UNSIGNED NOT NULL,
    PRIMARY KEY(`roleId`,`tagId`),
    CONSTRAINT fk_roletag_role
        FOREIGN KEY (`roleId`) REFERENCES `Role`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_roletag_tag
        FOREIGN KEY (`tagId`) REFERENCES `Tag`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE `Request`(
    `roleId` INT UNSIGNED NOT NULL,
    `userId` INT UNSIGNED NOT NULL,
    `message` VARCHAR(150) NOT NULL,
    `status` ENUM('Pending','Accepted','Declined') NOT NULL DEFAULT 'Pending',
    `createdAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT fk_request_role
        FOREIGN KEY (`roleId`) REFERENCES `Role`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_request_user
        FOREIGN KEY (`userId`) REFERENCES `User`(id)
        ON DELETE CASCADE ON UPDATE RESTRICT
);