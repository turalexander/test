CREATE TABLE orders (number BIGINT AUTO_INCREMENT, created_date datetime, PRIMARY KEY(number)) ENGINE = INNODB;
CREATE TABLE order_item (id BIGINT AUTO_INCREMENT, order_id BIGINT, product_name VARCHAR(255), product_price DECIMAL(18, 2), amount BIGINT, INDEX order_id_idx (order_id), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE order_item ADD CONSTRAINT order_item_order_id_orders_number FOREIGN KEY (order_id) REFERENCES orders(number) ON DELETE CASCADE;
