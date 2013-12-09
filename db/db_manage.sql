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
	phone varchar(15),
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
	fname varchar(50) not null,
	lname varchar(50) not null,
	constraint fk_user_owner foreign key (id) references user(id)
);

drop table if exists shop_info;
create table if not exists shop_info(
	id int primary key auto_increment,
	shop_phone varchar(15),
	shop_name varchar(150),
	rating float,
	created_time timestamp,
	approve_status varchar(2),
	icon_url varchar(255),
	icon_dir varchar(255),
	description varchar(255),
	category varchar(100),
	city varchar(25),
	state varchar(2),
	zipcode varchar(5),
	straddr varchar(100)
);

drop table if exists own_shop;
create table if not exists own_shop(
	user_id int,
	shop_id int,
	constraint fk_user_ownshop foreign key(user_id) references shop_owner(id),
	constraint fk_ownshop_shopinfo foreign key(shop_id) references shop_info(id)
);


drop table if exists category;
create table if not exists category (
	id int auto_increment,
	cate_name varchar(255),
	description varchar(255),
	constraint pk_category primary key (id, cate_name)
);

drop table if exists dish;
create table if not exists dish (
	id int primary key auto_increment,
	cate_id int,
	dish_price float,
	dish_name varchar(255),
	constraint fk_dish_category foreign key(cate_id) references category(id)
);

drop table if exists rest_category;
create table if not exists rest_category (
	rest_id int,
	cate_id int,
	constraint fk_rest_cate foreign key(rest_id) references shop_info(id),
	constraint fk_cate_rest foreign key(cate_id) references category(id)
);

select * from user;
select * from normal_user;
select * from shop_owner;

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
insert into shop_owner(id, phone, st_address, city, state, zip_code, fname, lname)
value(3, '(201) 444-1111', '101 1st st', 'City', 'NJ', '07000', 'tom', 'smith');
update user
set passwd = 'd186e8dac48a24d0115b568d0ab2c9e8b82e6adb'
where id = 3;

insert into user(user_name, email, passwd) values('1', '1@1.1', '356a192b7913b04c54574d18c28d46e6395428ab');
insert into admin_user(id) values(6);







select * from shop_info;
truncate category;

select * from own_shop;

SET SQL_SAFE_UPDATES=0;
update shop_info set icon_url = 'just test' where shop_phone = '2015559999';

select * from category;
select * from dish;
select * from rest_category;

select cate_id, cate_name, description from rest_category, category
where category.id = rest_category.cate_id and rest_category.rest_id = 1;
select dish_name, dish_price from dish where cate_id = 14;
select dish_name, dish_price from dish where cate_id = 15;
select dish_name, dish_price from dish where cate_id = 16;



insert into category(cate_name, description) values ('another test', 'no description');
insert into dish(cate_id, dish_price, dish_name) values(8, '5.5', 'something5.5');
insert into dish(cate_id, dish_price, dish_name) values(8, '666.5', 'something5.5');
insert into rest_category values(1,8);

select cate_id from rest_category where rest_id = 1;
delete from rest_category where rest_id = 1;
delete from dish where cate_id = 3;
delete from category where id = 10;

select max(id) from category;
insert into dish(cate_id, dish_price, dish_name) values(11, 'test', '12.3');

SELECT shop_id FROM user, own_shop where user.user_name = 'owner' and user.id = own_shop.user_id;
select * from category, rest_category where category.id = rest_category.cate_id and rest_category.rest_id = 1;
select * from dish where cate_id = 57;

select * from dish where cate_id = 57;