create database if not exists web_final_db;

use web_final_db;

GRANT ALL ON web_final_db.* TO 'web_user'@'localhost' IDENTIFIED BY 'webwebweb';

drop table if exists user;
create table if not exists user(
	id int primary key auto_increment,
	user_name varchar(50) unique,
	email varchar(254) unique,
	passwd varchar(50)
);

drop table if exists admin_user;
create table if not exists admin_user(
	id int,
	constraint fk_user_admin foreign key (id) references user(id)
);

drop table if exists normal_user;
create table if not exists normal_user(
	id int,
	telephone varchar(15),
	st_address varchar(100),
	city varchar(50),
	state varchar(2),
	zip_code varchar(5),
	constraint fk_user_normal foreign key (id) references user(id)
);

drop table if exists shop_owner;
create table if not exists shop_owner(
	id int,
	phone varchar(15) not null,
	st_address varchar(100) not null,
	city varchar(50) not null,
	state varchar(2) not null,
	zip_code varchar(5) not null,
	constraint fk_user_owner foreign key (id) references user(id)
);

select * from user;

insert into user(user_name, email, passwd) values('admin', 'tongqiang.atp@gmail.com', 'administrator');
insert into admin_user values(1);
update user
set passwd = 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3'
where id = 1;

insert into user(user_name, email, passwd) values('customer', '1@1.com', 'nopassword');
insert into normal_user(id) value(2);
update user
set passwd = 'd186e8dac48a24d0115b568d0ab2c9e8b82e6adb'
where id = 2;

insert into user(user_name, email, passwd) values('owner', '2@2.com', 'nopassword');
insert into shop_owner(id, phone, st_address, city, state, zip_code)
value(3, '(201) 444-1111', '101 1st st', 'City', 'NJ', '07000');
update user
set passwd = 'd186e8dac48a24d0115b568d0ab2c9e8b82e6adb'
where id = 3;

insert into user(user_name, email, passwd) values('1', '1@1.1', '356a192b7913b04c54574d18c28d46e6395428ab');
insert into admin_user(id) values(6);

