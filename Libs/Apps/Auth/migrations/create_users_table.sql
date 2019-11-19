create table sample_app_db.users
(
    id int not null primary key auto_increment,
    name varchar(255) not null unique,
    password varchar(255) not null
)