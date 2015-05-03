-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Account (username, password) VALUES ('Testi','sala');
INSERT INTO Account (username, password) VALUES ('Testi2','sala2');

INSERT INTO TaskClass (classname) VALUES ('Kotsa');
INSERT INTO TaskClass (classname) VALUES ('Testi');

INSERT INTO Task (taskname,priority, status, description, account) VALUES ('Vie roskat',1,1,'vie jo!', (select id from account where username ='Testi'));
INSERT INTO Task (taskname,priority,description, account) VALUES ('Vie pyykit',2,'vie jo!', (select id from account where username ='Testi2'));


INSERT INTO Classes (task_id, class_id) VALUES ((select id from Task where taskname='Vie roskat'),(select id from TaskClass where classname='Kotsa'));
INSERT INTO Classes (task_id, class_id) VALUES ((select id from Task where taskname='Vie pyykit'),(select id from TaskClass where classname='Testi'));
