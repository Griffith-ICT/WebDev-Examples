drop table if exists item;
create table item (    
    id integer not null primary key autoincrement,    
    summary varchar(80) not null,    
    details text default ''
); 
insert into item values (null, "Canon PowerShot S110",  "Excellent pocket camera.");
insert into item values (null, "Canon EOS 700D", "Excellent entry-level digital SLR camera");
insert into item values (null, "Canon EOS 7D",  "Excellent if aging mid-range digital SLR camera.");
insert into item values (null, "Canon EOS 6D", "Excellent modern full-frame semi-professional digital SLR camera.");
insert into item values (null, "Fujifilm X-Pro1", "Outstanding compact mirrorless system camera");
