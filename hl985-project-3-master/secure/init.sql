-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables

-- CREATE TABLE `examples` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`name`	TEXT NOT NULL
-- );
CREATE TABLE 'images'(
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'description' TEXT,
    'ext' TEXT NOT NULL,
    'source' TEXT NOT NULL,
    'user_id' INTEGER NOT NULL
);

CREATE TABLE 'users'(
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'username' TEXT NOT NULL UNIQUE,
    'password' TEXT NOT NULL
);

CREATE TABLE 'tags'(
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'tag' TEXT NOT NULL UNIQUE
);

CREATE TABLE 'image_tags'(
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'image_id' INTEGER NOT NULL,
    'tag_id' INTEGER
);

CREATE TABLE sessions(
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    user_id INTEGER NOT NULL,
    session TEXT NOT NULL UNIQUE
);
-- TODO: initial seed data
-- seed images
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (1,'jpg','baby golden retriever', 'https://pbs.twimg.com/profile_images/834022160708444161/pthU739M_400x400.jpg', 1);
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (2,'jpg','mad dog','https://i.pinimg.com/736x/8d/5c/9f/8d5c9fb9fd800ca1644a211e81d662b4.jpg', 1);
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (3,'jpg','tongue out shiba inu', 'https://img1.daumcdn.net/thumb/S600x434/?scode=1boon&fname=https://t1.daumcdn.net/liveboard/holapet/d5d2b53d56054c6fbe9f167d27aa0893.jpg', 1);
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (4,'jpg','happy shiba inu', 'http://file3.instiz.net/data/file3/2018/03/09/b/d/2/bd2ba93f9ef96da9280624186ba89510.jpg', 1);
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (5,'jpg','stubborn shiba inu', 'https://img1.daumcdn.net/thumb/S600x434/?scode=1boon&fname=http://t1.daumcdn.net/section/oc/d529036f35b5402198e1fea71f6e858d', 1);
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (6,'jpg','sleeping shiba inu', 'https://www.instagram.com/p/BbXDfQsAUw1/media?size=l', 1);
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (7,'png','shiba inu brothers', 'http://edublog.amdsb.ca/myblogjamieson602/files/2017/02/IMG_0016-2400nts.jpg', 1);
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (8,'jpg','sleepy ugly cute dog', 'http://optimal.inven.co.kr/upload/2017/10/20/bbs/i15168880477.jpg', 1);
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (9,'jpg','flying corgi', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQczZmexSJqxs1gYlMb55bbJwlvJjBy4eZ7LLygLN_GrzqnNd-_', 1);

INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (10, 'jpg', 'luscious coco', 'http://photos.google.com', 2);
INSERT INTO 'images' (id, ext, description, source, user_id) VALUES (11,'jpg', 'german shepherd', 'http://photos.google.com', 3);


-- tags
INSERT INTO 'tags' (id, tag) VALUES(1,'brown');
INSERT INTO 'tags' (id, tag) VALUES(2,'happy');
INSERT INTO 'tags' (id, tag) VALUES(3,'sleepy');
INSERT INTO 'tags' (id, tag) VALUES(4,'angry');
INSERT INTO 'tags' (id, tag) VALUES(5,'corgi');
INSERT INTO 'tags' (id, tag) VALUES(6,'shiba inu');
INSERT INTO 'tags' (id, tag) VALUES(7,'golden retriever');
INSERT INTO 'tags' (id, tag) VALUES(8, 'black');
INSERT INTO 'tags' (id, tag) VALUES(9, 'luscious');
-- INSERT INTO 'tags' (id, tag) VALUES();

-- image_tags
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (1,1,7);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (2,1,1);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (3,1,2);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (4,2,4);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (5,2,1);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (6,3,1);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (7,3,6);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (8,3,2);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (9,4,6);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (10,4,1);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (11,4,2);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (12,5,6);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (13,6,6);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (14,6,3);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (15,7,2);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (16,7,6);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (17,8,3);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (18,9,5);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (19, 10, 8);
INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES (20, 10, 9);
-- INSERT INTO 'image_tags' (id, image_id, tag_id) VALUES ();

-- FOR HASHED PASSWORDS, LEAVE A COMMENT WITH THE PLAIN TEXT PASSWORD!
INSERT INTO 'users' (id, username, password) VALUES (1, 'hl985', '$2y$10$NK7/ga43ImeR49ZfNit.e.KPiRlbeCO.hPdJ6dcLzjAFHP0QKdYma'); -- password: password
INSERT INTO 'users' (id, username, password) VALUES (2, 'joshspitsfire', '$2y$10$fqGUQfK/9BfSvZ7tSHqVo.vcOV1ccB/bQxjtY/SWZDA7rpibqTLLC'); -- password: joshlovescoco
INSERT INTO 'users' (id, username, password) VALUES (3, 'hz297', '$2y$10$/A1fOAO4ykLOwGG0U8gPXed0siXmeg1YZNfxwHkWthnw1mVPuOYm6'); -- helen
COMMIT;
