create table product(
  product_id serial primary key,
  product_name varchar(30) not null,
  product_firm varchar(30) not null,
  model varchar(30) not null,
  waranty boolean not null,
  image text not null
);

create table orders(
  order_id serial primary key,
  date date not null,
  client_first varchar(30) not null,
  client_last varchar(30) not null,
  client_patronomyc varchar(30) not null,
  product_id int4 not null,
  waranty boolean not null,
  phone varchar(30) not null,
  date_receipt date not null
);

create table employee(
  employee_id serial primary key,
  employee_first varchar(30) not null,
  employee_last varchar(30) not null,
  employee_post varchar(30) not null
);

create table ready(
  order_id serial not null,
  type_repair varchar(30) not null,
  cost_repair varchar(30) not null,
  date_execution date not null,
  sms_client text not null
  date_receipt date not null,
  payment text not null
);

