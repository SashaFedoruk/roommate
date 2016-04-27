use roommateDB;

CREATE TABLE if not exists `countries` (
  `country_id` int(11) NOT NULL primary key,
  `name` varchar(255) NOT NULL,
  `currency_code` varchar(5) NOT NULL,
  `currency` varchar(255) DEFAULT NULL  

) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE if not exists `cities` (
  `id` int(11) NOT NULL primary key, 
  `country_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `region` varchar(255) NOT NULL,
  `biggest_city` tinyint(1) DEFAULT '0',
  
  foreign key (country_id) references countries(country_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



create table if not exists `user` (
	`id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `login` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `auth_key` varchar(256) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
);

create table if not exists house_type(
	id int not null AUTO_INCREMENT primary key,
	name nvarchar(64)
);

create table if not exists house_state(
	id int not null AUTO_INCREMENT primary key,
	name nvarchar(64)
);


create table if not exists house(
	id int not null AUTO_INCREMENT primary key,
	title nvarchar(128),
	city_id int,
	`type_id` int,
	price float,
	num_rooms int,
	n_floor int,
	area float,
	`state_id` int,
	`desc` nvarchar(712),
	author_id int,
	image text,
	create_date DATETIME,

	
	foreign key (author_id) references `user`(id),
	foreign key (type_id) references house_type(id),
	foreign key (state_id) references house_state(id)
);

create table if not exists user_info (
	id int not null AUTO_INCREMENT primary key,
	user_id int not null,
	name nvarchar(64),
	last_name nvarchar(64),
    gender nvarchar(10),
	birth_date DATETIME,
	city_residence_id int,
	phone nvarchar(32),
	other_contacts nvarchar(128),
	availability_of_house tinyint(1),
	house_id int,
	nationality nvarchar(64),
	ideology nvarchar(64),
	cigarette_addiction nvarchar(10),
	alcohol_addiction nvarchar(10),
	`desc` nvarchar(712),
	image text,
	search_in tinyint(1),
	
	foreign key (user_id) references `user`(id),
	foreign key (house_id) references house(id)
);


create table if not exists questionaire_of_roommate(
	id int not null AUTO_INCREMENT primary key,
	user_id int, 
	city_id int,
	type_id int,
	age_min int,
	age_max int,
	gender nvarchar(10),
	nationality nvarchar(64),
	cigarette_addiction nvarchar(10),
	alcohol_addiction nvarchar(10),
	availability_of_house nvarchar(10),
	price_of_house_min int,
	price_of_house_max int,
	state_id int,
	
	foreign key (user_id) references `user`(id),
	foreign key (type_id) references house_type(id),
	foreign key (state_id) references house_state(id)
);

CREATE TABLE if not exists `messages` (              
        `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY NOT NULL, 
        `from_id` int(11) NULL,                                    
        `for_id` int(11) NOT NULL,                                
        `message` varchar(750) NOT NULL,                           
        `status` int(11) DEFAULT 0,                                                    
        `created_at` int(11) NOT NULL,                             
		
		foreign key (from_id) references `user`(id),
		foreign key (whom_id) references `user`(id)
);    











