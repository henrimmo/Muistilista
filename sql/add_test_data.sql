-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Account (username, password) VALUES ('Lollero','Pallero123');
INSERT INTO Account (username, password) VALUES ('Pallero','Lollero123');

INSERT INTO TaskClass (classname) VALUES ('Kotsa');
INSERT INTO TaskClass (classname) VALUES ('Testi');

INSERT INTO Task (taskname,priority,description, account) VALUES ('Vie roskat','kiire','vie jo!', (select id from account where username ='Pallero'));
INSERT INTO Task (taskname,priority,description, account) VALUES ('Vie pyykit','kiire','vie jo!', (select id from account where username ='Lollero'));


INSERT INTO Classes (task_id, class_id) VALUES ((select id from Task where taskname='Vie roskat'),(select id from TaskClass where classname='Kotsa'));
 INSERT INTO Classes (task_id, class_id) VALUES ((select id from Task where taskname='Vie pyykit'),(select id from TaskClass where classname='Testi'));
