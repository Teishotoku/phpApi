create table user(
  user_id serial primary key,
);
create table product(
  product_id serial primary key,
);
create table orders(
  order_id serial primary key,
);
create table employee(
  employee_id serial primary key,
);
create table ready(
  order_id serial not null,
);

