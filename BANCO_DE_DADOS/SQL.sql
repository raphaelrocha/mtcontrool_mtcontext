use mtcontrool;


DROP TABLE IF EXISTS TEST_CONTEXT_SEQ;
DROP TABLE IF EXISTS ELEMENT_INST;
DROP TABLE IF EXISTS ELEMENT_VAR;
DROP TABLE IF EXISTS TEST_CONTEXT;
DROP TABLE IF EXISTS ELEMENT_PLATFORM;
DROP TABLE IF EXISTS ELEMENT_DEVICE;
DROP TABLE IF EXISTS ELEMENT;
DROP TABLE IF EXISTS DEVICE;
DROP TABLE IF EXISTS BRAND;

drop table if exists test_context_seq;
drop table if exists element_inst;
drop table if exists element_var;
drop table if exists test_context;
drop table if exists element_platform;
drop table if exists element_device;
drop table if exists element;
drop table if exists device;
drop table if exists brand;


create table element(
id int auto_increment not null,
description varchar(50) not null,
primary key (id)
);

-- drop table device;

create table brand(
id int auto_increment not null,
brand_name varchar(50) not null,
primary key (id));

-- drop table cascade device;

create table device(
id int auto_increment not null,
id_brand int not null,
id_platform int not null,
description varchar(50) not null,
primary key (id),
foreign key (id_brand) references brand (id),
foreign key (id_platform) references platforms (id)
);

create table element_platform(
id_element int not null,
id_platform int not null,
foreign key (id_element) references element (id),
foreign key (id_platform) references platforms (id)
);

create table element_device(
id_element int not null,
id_device int not null,
foreign key (id_element) references element (id),
foreign key (id_device) references device (id)
);


create table test_context(
id int auto_increment not null,
id_user int not null,
id_app int not null,
id_platform int not null,
id_device int not null,
description varchar(50) not null,
primary key (id),
foreign key (id_user) references users (id),
foreign key (id_app) references app (id),
foreign key (id_platform) references platforms (id),
foreign key (id_device) references device (id)
);

create table element_inst(
id int auto_increment not null,
id_element int not null,
id_test_context int not null,
element_type varchar(10),
description varchar(50),
behavior varchar(300),
behavior_screen varchar(300),
start_param double,
end_param double,
primary key (id),
foreign key (id_element) references element (id) on delete cascade,
foreign key (id_test_context) references test_context (id) on delete cascade
-- unique (element_type, description,start_param,end_param)
);

create table test_context_seq(
id int auto_increment not null,
id_test_context int not null,
sequence_order int,
variation varchar(10000),
behavior varchar(10000),
behavior_screen varchar(300),
date_time timestamp,
primary key (id),
foreign key (id_test_context) references test_context (id) on delete cascade
);

/*create table element_var(
id int auto_increment not null,
id_element int not null,
description varchar(50) not null,
primary key (id),
foreign key (id_element) references element (id) on delete cascade
);*/

/*create table test_context_element(
id_test_context int not null,
id_element_inst int not null,
foreign key (id_test_context) references test_context (id),
foreign key (id_element_inst) references element_inst (id)
);*/

alter table element_platform add constraint un_element_platform 
unique (id_element, id_platform);

alter table element_platform add constraint del_element_cascade
foreign key (id_element) references element (id)
on delete cascade;

alter table element_platform add constraint del_element_plat_cascade
foreign key (id_platform) references platforms (id)
on delete cascade;

alter table element_device add constraint un_element_device
unique (id_element, id_device);

alter table element_device add constraint del_device_cascade
foreign key (id_element) references element (id)
on delete cascade;

alter table element_device add constraint del_element_dev_cascade
foreign key (id_device) references device (id)
on delete cascade;

/*alter table element_instance
add foreign key (id_element) references elements (id)
;*/

/*alter table test_context
-- add foreign key (id_user) references users (id)
-- add foreign key (id_app) references app (id)
-- add foreign key (id_plataform) references plataforms (id)
add foreign key (id_element) references elements (id)
;*/


insert into brand values(null,'motorola');
insert into brand values(null,'nokia');
insert into brand values(null,'microsoft');
insert into brand values(null,'asus');
insert into brand values(null,'apple');
insert into brand values(null,'samsung');

insert into device values(null,1,1,'moto g');
insert into device values(null,1,1,'moto x');
insert into device values(null,1,1,'moto e');
insert into device values(null,2,3,'lumia 630');
insert into device values(null,2,3,'lumia 720');
insert into device values(null,2,3,'lumia 730');
insert into device values(null,4,1,'zen phone 5');
insert into device values(null,4,1,'zen phone 6');
insert into device values(null,5,2,'iphone 3');
insert into device values(null,5,2,'iphone 4');
insert into device values(null,5,2,'iphone 4s');
insert into device values(null,5,2,'iphone 5');
insert into device values(null,5,2,'iphone 5s');
insert into device values(null,5,2,'iphone 6');
insert into device values(null,5,2,'iphone 6 plus');
insert into device values(null,6,1,'galaxy s');
insert into device values(null,6,1,'galaxy s2');
insert into device values(null,6,1,'galaxy s3');
insert into device values(null,6,1,'galaxy s4');
insert into device values(null,6,1,'galaxy s5');
insert into device values(null,6,1,'galaxy s6');

insert into element values(null,'connection');
insert into element values(null,'battery');
insert into element values(null,'screen');
insert into element values(null,'location');

insert into element_device values(1,1);
insert into element_device values(1,2);
insert into element_device values(1,3);
insert into element_device values(1,4);
insert into element_device values(1,5);
insert into element_device values(1,6);
insert into element_device values(2,2);
insert into element_device values(2,3);
insert into element_device values(3,7);
insert into element_device values(3,8);
insert into element_device values(4,1);
insert into element_device values(4,2);
insert into element_device values(4,3);
insert into element_device values(4,4);
insert into element_device values(4,5);

insert into element_platform values(1,1);
insert into element_platform values(1,2);
insert into element_platform values(1,3);
insert into element_platform values(2,1);
insert into element_platform values(2,2);
insert into element_platform values(2,3);
insert into element_platform values(3,1);
insert into element_platform values(3,2);
insert into element_platform values(3,3);
insert into element_platform values(4,1);
insert into element_platform values(4,2);
insert into element_platform values(4,3);

/*
insert into element_var values(null,1,'gprs');
insert into element_var values(null,1,'edge');
insert into element_var values(null,1,'3g');
insert into element_var values(null,1,'3,5g');
insert into element_var values(null,1,'4g');
insert into element_var values(null,2,'autonomia');
insert into element_var values(null,2,'temperatura');
insert into element_var values(null,2,'tempo de recarga');
insert into element_var values(null,3,'horizontal');
insert into element_var values(null,3,'vertical');
insert into element_var values(null,4,'satelite');
insert into element_var values(null,4,'rede celular');
insert into element_var values(null,4,'mista');
*/

