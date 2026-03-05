create  table projects(
    id   integer PRIMARY KEY  AUTOINCREMENT,
    title TEXT ,
    description TEXT
);

insert into projects (title, description)
values ('prject1', 'project1 description'),
       ('project2', 'project2 description'),
       ('project3 ', 'project3 description');