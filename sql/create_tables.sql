-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Account(
id SERIAL PRIMARY KEY,
username varchar(30) NOT NULL,
password varchar(30) NOT NULL
);

CREATE TABLE TaskClass(
id SERIAL PRIMARY KEY,
classname varchar(20)
);

CREATE TABLE PriorityScale(
id SERIAL PRIMARY KEY,
priority INTEGER NOT NULL,
CONSTRAINT priority_ck CHECK (priority between 1 AND 5),
description varchar(100)
);

CREATE TABLE Task(
id SERIAL PRIMARY KEY,
taskname varchar(30) NOT NULL,
priority varchar(10),
classname varchar(10),
description varchar(100), 
status boolean DEFAULT FALSE,
account_id INTEGER REFERENCES Account(id),
priority_id INTEGER REFERENCES PriorityScale(id),
class_id INTEGER REFERENCES TaskClass(id)
);



