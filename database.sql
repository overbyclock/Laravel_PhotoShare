CREATE DATABASE IF NOT EXISTS photoshare;

USE photoshare;

CREATE TABLE IF NOT EXISTS users(
  id         int(255) auto_increment not null,
  rol        varchar(20)  not null,
  name       varchar(100) not null,
  surname    varchar(150) not null,
  nick       varchar(150) not null,
  email      varchar(150) not null,
  password   varchar(150) not null,
  image      varchar(250) not null,
  created_at datetime,
  updated_at datetime,
  remember_token varchar(300),
  CONSTRAINT pk_users PRIMARY KEY(id),
  CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO users
VALUES(NULL,'admin','Juan','Medina','overbyclock','juan@gmail.com',
       '123456',
       'no photo',
       CURTIME(),
       CURTIME(),
       NULL
       );
INSERT INTO users
VALUES(NULL,'user','Natalia','Medina','natamontada','natalia@gmail.com',
       '123456',
       'no photo',
       CURTIME(),
       CURTIME(),
       NULL
       );

INSERT INTO users
VALUES(NULL,'user','Javi','Ambrona','dreyius','javi@gmail.com',
       '123456',
       'no photo',
       CURTIME(),
       CURTIME(),
       NULL
       );


CREATE TABLE IF NOT EXISTS images(
  id          int(255) auto_increment not null,
  user_id     int(255) not null,
  image_path  varchar(300) not null,
  description text not null,
  created_at  datetime,
  updated_at  datetime,
  CONSTRAINT pk_images PRIMARY KEY(id),
  CONSTRAINT fk_user_id FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
)ENGINE=InnoDb;

INSERT INTO images
VALUES(NULL,1,'test1.jpg','This is a test',CURTIME(),CURTIME());

INSERT INTO images
VALUES(NULL,2,'test2.jpg','This is a test',CURTIME(),CURTIME());

INSERT INTO images
VALUES(NULL,3,'test3.jpg','This is a test',CURTIME(),CURTIME());

CREATE TABLE IF NOT EXISTS likes(
  id       int(255) auto_increment not null,
  user_id  int(255) not null,
  image_id int(255) not null,
  created_at datetime,
  updated_at datetime,
  CONSTRAINT pk_likes PRIMARY KEY(id),
  CONSTRAINT fk_likes_users  FOREIGN KEY(user_id)  REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id) ON DELETE CASCADE
)ENGINE=InnoDb;

INSERT INTO likes
VALUES(NULL,1,1,CURTIME(),CURTIME());

INSERT INTO likes
VALUES(NULL,2,2,CURTIME(),CURTIME());

INSERT INTO likes
VALUES(NULL,3,3,CURTIME(),CURTIME());


CREATE TABLE IF NOT EXISTS coments(
  id int(255) auto_increment not null,
  user_id  int(255) not null,
  image_id int(255) not null,
  content text not null,
  created_at datetime,
  updated_at datetime,
  CONSTRAINT pk_comments PRIMARY KEY(id),
  CONSTRAINT fk_comments_users  FOREIGN KEY(user_id)  REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id) ON DELETE CASCADE
)ENGINE=InnoDb;

INSERT INTO coments
VALUES(NULL,1,1,'This is a test comment',CURTIME(),CURTIME());

INSERT INTO coments
VALUES(NULL,2,2,'This is a test comment',CURTIME(),CURTIME());

INSERT INTO coments
VALUES(NULL,2,2,'This is a test comment',CURTIME(),CURTIME());
