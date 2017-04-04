/* Prime Ministers database in MySQL. */
drop table if exists pms;

create table pms (
  id integer primary key autoincrement,
  number int, /* 0 = subsequent term */
  name varchar(40) not null,
  start date not null,
  finish date,
  party varchar(40),
  duration varchar(40),
  state varchar(40)
);

/* Column names changed to avoid MySQL reserved words. */

insert into pms(number, name, party, duration, state, start, finish) values (1,'Edmund Barton','Protectionist','2 years, 8 months, 24 days','New South Wales','1901-01-01','1903-09-24');
insert into pms(number, name, party, duration, state, start, finish) values (2,'Alfred Deakin','Protectionist','0 years, 7 months, 4 days','Victoria','1903-09-24','1904-04-27');
insert into pms(number, name, party, duration, state, start, finish) values (3,'Chris Watson','Labour','0 years, 3 months, 21 days','New South Wales','1904-04-27','1904-08-18');
insert into pms(number, name, party, duration, state, start, finish) values (4,'George Reid','Free Trade','0 years, 10 months, 18 days','New South Wales','1904-08-18','1905-07-05');
insert into pms(number, name, party, duration, state, start, finish) values (0,'Alfred Deakin','Protectionist','3 years, 4 months, 9 days','Victoria','1905-07-05','1908-11-13');
insert into pms(number, name, party, duration, state, start, finish) values (5,'Andrew Fisher','Labour','0 years, 6 months, 21 days','Queensland','1908-11-13','1909-06-02');
insert into pms(number, name, party, duration, state, start, finish) values (0,'Alfred Deakin','Commonwealth Liberal','0 years, 10 months, 28 days','Victoria','1909-06-02','1910-04-29');
insert into pms(number, name, party, duration, state, start, finish) values (0,'Andrew Fisher','Labor','3 years, 1 month, 26 days','Queensland','1910-04-29','1913-06-24');
insert into pms(number, name, party, duration, state, start, finish) values (6,'Joseph Cook','Commonwealth Liberal','1 year, 2 months, 25 days','New South Wales','1913-06-24','1914-09-17');
insert into pms(number, name, party, duration, state, start, finish) values (0,'Andrew Fisher','Labor','1 year, 1 month, 11 days','Queensland','1914-09-17','1915-10-27');
insert into pms(number, name, party, duration, state, start, finish) values (7,'Billy Hughes','Labor/Nationalist','7 years, 3 months, 14 days','New South Wales, Victoria','1915-10-27','1923-02-09');
insert into pms(number, name, party, duration, state, start, finish) values (8,'Stanley Bruce','Nationalist','6 years, 8 months, 14 days','Victoria','1923-02-09','1929-10-22');
insert into pms(number, name, party, duration, state, start, finish) values (9,'James Scullin','Labor','2 years, 2 months, 16 days','Victoria','1929-10-22','1932-01-06');
insert into pms(number, name, party, duration, state, start, finish) values (10,'Joseph Lyons','United Australia','7 years, 3 months, 2 days','Tasmania','1932-01-06','1939-04-07');
insert into pms(number, name, party, duration, state, start, finish) values (11,'Earle Page','Country','0 years, 0 months, 20 days','New South Wales','1939-04-07','1939-04-26');
insert into pms(number, name, party, duration, state, start, finish) values (12,'Robert Menzies','United Australia','2 years, 4 months, 4 days','Victoria','1939-04-26','1941-08-28');
insert into pms(number, name, party, duration, state, start, finish) values (13,'Arthur Fadden','Country','0 years, 1 month, 9 days','Queensland','1941-08-28','1941-10-07');
insert into pms(number, name, party, duration, state, start, finish) values (14,'John Curtin','Labor','3 years, 8 months, 29 days','Western Australia','1941-10-07','1945-07-05');
insert into pms(number, name, party, duration, state, start, finish) values (15,'Frank Forde','Labor','0 years, 0 months, 8 days','Queensland','1945-07-06','1945-07-13');
insert into pms(number, name, party, duration, state, start, finish) values (16,'Ben Chifley','Labor','4 years, 5 months, 7 days','New South Wales','1945-07-13','1949-12-19');
insert into pms(number, name, party, duration, state, start, finish) values (0,'Robert Menzies','Liberal','16 years, 1 month, 8 days','Victoria','1949-12-19','1966-01-26');
insert into pms(number, name, party, duration, state, start, finish) values (17,'Harold Holt','Liberal','1 year, 10 months, 23 days','Victoria','1966-01-26','1967-12-19');
insert into pms(number, name, party, duration, state, start, finish) values (18,'John McEwen','Country','0 years, 0 months, 23 days','Victoria','1967-12-19','1968-01-10');
insert into pms(number, name, party, duration, state, start, finish) values (19,'John Gorton','Liberal','3 years, 2 months, 0 days','Victoria','1968-01-10','1971-03-10');
insert into pms(number, name, party, duration, state, start, finish) values (20,'William McMahon','Liberal','1 year, 8 months, 25 days','New South Wales','1971-03-10','1972-12-05');
insert into pms(number, name, party, duration, state, start, finish) values (21,'Gough Whitlam','Labor','2 years, 11 months, 7 days','New South Wales','1972-12-05','1975-11-11');
insert into pms(number, name, party, duration, state, start, finish) values (22,'Malcolm Fraser','Liberal','7 years, 4 months, 0 days','Victoria','1975-11-11','1983-03-11');
insert into pms(number, name, party, duration, state, start, finish) values (23,'Bob Hawke','Labor','8 years, 9 months, 10 days','Victoria','1983-03-11','1991-12-20');
insert into pms(number, name, party, duration, state, start, finish) values (24,'Paul Keating','Labor','4 years, 2 months, 20 days','New South Wales','1991-12-20','1996-03-11');
insert into pms(number, name, party, duration, state, start, finish) values (25,'John Howard','Liberal','11 years, 8 months, 23 days','New South Wales','1996-03-11','2007-12-03');
insert into pms(number, name, party, duration, state, start, finish) values (26,'Kevin Rudd','Labor','2 years, 6 months, 21 days',' Queensland','2007-12-03','2010-06-24');
insert into pms(number, name, party, duration, state, start, finish) values (27,'Julia Gillard','Labor','0 years, 9 months, 27 days',' Victoria','2010-06-24',NULL);

/* Sample query to test insertion worked. */

select * from pms
where state like "%queensland%"
order by id;
