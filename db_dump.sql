CREATE TABLE `users`
(
    `id`       INT(20)   NOT NULL AUTO_INCREMENT,
    `login`    VARCHAR(255) NOT NULL,
    `email`    VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    UNIQUE KEY `email_unique` (`email`) USING BTREE,
    UNIQUE KEY `login_unique` (`email`) USING BTREE,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `phones` (
      `id` INT(20) AUTO_INCREMENT,
      `user_id` INT(20),
      `name` VARCHAR(255) NOT NULL,
      `surname` VARCHAR(255) NOT NULL,
      `phone` VARCHAR(255) NOT NULL,
      `email` VARCHAR(255) NOT NULL,
      `image_name` VARCHAR(255) NOT NULL,
      PRIMARY KEY (`id`)
) ENGINE=InnoDB;
ALTER TABLE phones ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;