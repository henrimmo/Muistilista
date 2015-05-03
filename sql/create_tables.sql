-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Account(
id SERIAL PRIMARY KEY,
username varchar(30) NOT NULL,
password varchar(30) NOT NULL
);

CREATE TABLE TaskClass(
id SERIAL PRIMARY KEY,
classname varchar(20) NOT NULL
);


CREATE TABLE Task(
id SERIAL PRIMARY KEY,
taskname varchar(30) NOT NULL,
priority INTEGER,
description varchar(100), 
status INTEGER DEFAULT 0,
account INTEGER REFERENCES Account(id)
);

CREATE TABLE Classes(
task_id INTEGER REFERENCES Task(id),
class_id INTEGER REFERENCES TaskClass(id)
);



