-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Account (username, password) VALUES ('Lollero','Pallero123');
INSERT INTO Account (username, password) VALUES ('Pallero','Lollero123');

INSERT INTO Task (taskname,priority,classname,description) VALUES ('Vie roskat','kiire','koti','vie jo!');

INSERT INTO TaskClass (classname) VALUES ('Kotsa');

INSERT INTO PriorityScale (priority, description) VALUES (5,'Pitäs olla jo!');
