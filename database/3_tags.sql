CREATE TABLE tags(
    id integer primary key ,
    title text
);

insert into tags (title) values
                            ('Ashraf'),
                            ('Ahmad'),
                            ('Omar');



CREATE TABLE tasks_tags(
    task_id integer,
    tag_id integer,
    PRIMARY KEY (task_id, tag_id),
    FOREIGN KEY (task_id) References tasks(id)
     on delete cascade
     on update cascade


    FOREIGN KEY (tag_id) REFERENCES tags(id)
        on delete cascade
        on update cascade

);