SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

CREATE TABLE `event`
(
    `id`         int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       varchar(255)     NOT NULL,
    `start`      timestamp        NULL DEFAULT NULL,
    `end`        timestamp        NULL DEFAULT NULL,
    `created_at` timestamp        NULL DEFAULT NULL,
    `updated_at` timestamp        NULL DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `user`
(
    `id`         int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_name`  varchar(255)     NULL DEFAULT NULL,
    `user_email` varchar(255)     NOT NULL,
    `created_at` timestamp        NULL DEFAULT NULL,
    `updated_at` timestamp        NULL DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `shift_department`
(
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `shift_id`      int(11) UNSIGNED NOT NULL,
    `department_id` int(11) UNSIGNED NOT NULL,
    `created_at`    timestamp        NULL DEFAULT NULL,
    `updated_at`    timestamp        NULL DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `department`
(
    `id`         int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       varchar(255)     NOT NULL,
    `created_at` timestamp        NULL DEFAULT NULL,
    `updated_at` timestamp        NULL DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `shift`
(
    `id`         int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `type`       varchar(255)     NOT NULL,
    `start`      timestamp        NULL DEFAULT NULL,
    `end`        timestamp        NULL DEFAULT NULL,
    `user_id`    int(11) UNSIGNED NOT NULL,
    `location`   varchar(255)     NOT NULL,
    `event_id`   int(11) UNSIGNED NULL DEFAULT NULL,
    `rate`       int(11) UNSIGNED NULL DEFAULT NULL,
    `charge`     int(11) UNSIGNED NULL DEFAULT NULL,
    `area`       varchar(255)     NULL DEFAULT NULL,
    `created_at` timestamp        NULL DEFAULT NULL,
    `updated_at` timestamp        NULL DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

COMMIT;
