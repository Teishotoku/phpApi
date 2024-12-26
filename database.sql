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
  sms_client text not null,
  date_receipt date not null,
  payment text not null
);

INSERT INTO orders(order_id, date, client_first, client_last, client_patronomyc, product_id, waranty, phone, date_receipt) VALUES 
(1, '2024-10-15', 'Mike', 'Jedy', 'Nickolych', 1, false, 921482878, '2024-12-5'),
(2, '2024-10-25', 'Jerimy', 'Jedy', 'Nickolych', 2, true, 929871901, '2024-12-19'),
(3, '2024-10-12', 'Kate', 'Nebraske', 'Litso', 3, true, 998181490, '2024-11-29');

INSERT INTO product(product_id, product_name, product_firm, model, waranty, image) VALUES
(1, 'prodOne', 'Philips', 'EKD45', true, 'prodOne.jpg'),
(2, 'prodTwo', 'Bosh', 'E9F2A', false, 'prodTwo.jpg'),
(3, 'prodThree', 'Philips', 'L9j39', true, 'prodThree.jpg');

INSERT INTO employee(employee_id, employee_first, employee_last, employee_post) VALUES
(1, 'Mike', 'Newson', 'ADMIN'),
(2, 'Leiko', 'Ciagate', 'USER'),
(3, 'James', 'Repoke', 'ADMIN');

INSERT INTO ready(order_id, type_repair, cost_repair, date_execution, sms_client, date_receipt, payment) VALUES
(1, 'simple', '45', '2024-12-25', 'repair...', '2024-12-30', '4500'),
(2, 'medium', '75', '2024-10-25', 'repair...', '2024-10-30', '5700'),
(3, 'hard', '35', '2024-11-25', 'repair...', '2024-11-30', '7000');

