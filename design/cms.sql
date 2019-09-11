create database if not exists logindb charset=utf8;

use logindb;

-- 用户表
create table if not exists monda_admin(
    id mediumint unsigned not null auto_increment,
    account varchar(191) not null comment '用户名',
    password varchar(191) not null comment '密码',
    email varchar(191) not null comment '邮箱',
    status tinyint not null default 1 comment '管理员状态 0 - 禁用 1 - 启用',
    created_at datetime,
    updated_at datetime,
    primary key pk_id(id),
    unique key uk_account(account),
    index idx_email(email)
)charset=utf8,engine=innodb;

insert into monda_admin(account,password,email,status) values('admin','14e1b600b1fd579f47433b88e8d85291','3266023724@qq.com',1);
