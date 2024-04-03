CREATE TABLE users(
    uid varchar(8) PRIMARY KEY,
    name varchar(200),
    phone bigint UNIQUE,
    pin_hash varchar(100),
    user_type varchar(2),
 	lat DECIMAL(12, 10),
    lon DECIMAL(13, 10),
    address varchar(400) DEFAULT NULL,
    city varchar(20) DEFAULT NULL,
    pincode int(6) DEFAULT NULL,
    bank_account varchar(200) DEFAULT NULL,
    bank_ifsc varchar(200) DEFAULT NULL,
    products int(100) DEFAULT '0',
    bio TEXT DEFAULT NULL    
);


CREATE TABLE products(
    pid varchar(5) PRIMARY KEY,
    product_name varchar(200),
    uid varchar(8),
    price int CHECK (price >= 20 AND price <= 5000),
    discount int CHECK (discount >= 0 AND discount <= 60),
    dprice decimal CHECK (dprice >= 20 AND dprice <= 5000),
    weight varchar(100),
    stock_quantity int(100),
 	description varchar(400),
    category varchar(200),
    tags varchar(200)
    
);

CREATE TABLE orders(
    oid int AUTO_INCREMENT PRIMARY KEY,
    cid varchar(8),
    fid varchar(8),
    txnid bigint,
    amount int CHECK (amount >= 20 AND amount <= 5000),
    status varchar(200),
    name varchar(200),
    email varchar(200),
    phone bigint(10),
    address1 varchar(400),
    address2 varchar(400),
    city varchar(20),
    state varchar(20),
    country varchar(20),
    zipcode int(6)
);

ALTER TABLE orders AUTO_INCREMENT = 1000;

CREATE TABLE orderItems(
    oid int,
    pid varchar(5),
    quantity int
);

INSERT INTO users (uid, name, phone, pin_hash, user_type, lat, lon, address, city, pincode, bank_account, bank_ifsc, products, bio)
VALUES
    ('a7f2e0c4', 'Gopal Verma', 9087654323, '$2y$10$lqrOYWgch8rjmRYWD0Ehmeoea1gakdoyArjrIOUvBz..o/y4vgp6q', 'f', 20.0161893186, 73.8972257258, 'Sambajinagar, Nashik', 'Nashik', 765456, '345678976554', 'PYTM0987654', 9, 'I am an Indian farmer dedicated to nurturing the land and cultivating crops that sustain our communities. With a deep connection to nature and traditions passed down through generations, I work tirelessly to ensure food security and promote agricultural sustainability. My passion for farming stems from a profound love for the land and a commitment to feeding our nation.'),
    ('d21bda66', 'Ramesh Gupta', 9087654322, '$2y$10$ZIC4XU98JAc545SgX/ATFeJZyBp.EuQBA5knaUPUY294NLriu4DyG', 'f', 17.6367220000, 74.1002170000, 'Rampur, Plot No. 385, Satara', 'Satara', 678455, '567687980865', 'SBIN0123456', 9, 'I am an Indian farmer dedicated to nurturing the land and cultivating crops that sustain our communities. With a deep connection to nature and traditions passed down through generations, I work tirelessly to ensure food security and promote agricultural sustainability. My passion for farming stems from a profound love for the land and a commitment to feeding our nation.'),
    ('effea3f0', 'Ramlal Sharma', 9087654321, '$2y$10$Dm.ktb49wQjfQXk1mi8knODz1EeUfug7E99yDeDfIPDE.yx9e697m', 'f', 18.5143270000, 73.9884530000, 'Shreenagar, Plot No. 35, Pune', 'Pune', 456765, '43215678534567', 'SBIN0123456', 9, 'I am an Indian farmer dedicated to nurturing the land and cultivating crops that sustain our communities. With a deep connection to nature and traditions passed down through generations, I work tirelessly to ensure food security and promote agricultural sustainability. My passion for farming stems from a profound love for the land and a commitment to feeding our nation.'),
    ('fc174d16', 'User1', 1234567890, '$2y$10$PLIzqcK/2Einqdd/2rnnlerxJ157fXgkMW.CwddVJQxgJHLp3iGWO', 'c', 19.0748000000, 72.8856000000, NULL, 'Mumbai', NULL, NULL, NULL, 0, NULL),
    ('fe32ef71', 'Atharva', 2143658709, '$2y$10$ZUKjC9uNlV3dC6OBYaUm9OSV.k/K0n6luPwuM08TvhVPFC32i.oLy', 'c', 19.0748000000, 72.8856000000, NULL, 'Mumbai', NULL, NULL, NULL, 0, NULL);

-- Fruits
INSERT INTO products (pid, product_name, user_id, price, discount_percent, discounted_price, weight, stock_quantity, description, category, tags)
VALUES
    ('17d36', 'Apples', 'a7f2e0c4', 200, 10, 180.00, '1kg', 20, 'Fresh red apples from farm', 'fruits', 'red, apples, seb'),
    ('18e45', 'Bananas', 'a7f2e0c4', 150, 5, 142.50, '1dozen', 30, 'Ripe bananas for healthy snacking', 'fruits', 'yellow, bananas, kela'),
    ('19f54', 'Oranges', 'd21bda66', 250, 15, 212.50, '2kg', 15, 'Juicy oranges packed with vitamin C', 'fruits', 'orange, citrus, santara'),
    ('20g63', 'Grapes', 'd21bda66', 180, 8, 165.60, '500g', 25, 'Fresh green grapes perfect for salads', 'fruits', 'green, grapes, angur'),
    ('21h72', 'Strawberries', 'effea3f0', 300, 10, 270.00, '500g', 10, 'Sweet and succulent strawberries', 'fruits', 'red, strawberries'),
    ('22i81', 'Mangoes', 'effea3f0', 220, 0, 220.00, '1kg', 18, 'Seasonal ripe mangoes for mango lovers', 'fruits', 'yellow, mangoes, aam');

-- Vegetables
INSERT INTO products (pid, product_name, user_id, price, discount_percent, discounted_price, weight, stock_quantity, description, category, tags)
VALUES
    ('23j90', 'Tomatoes', 'a7f2e0c4', 100, 0, 100.00, '1kg', 40, 'Fresh red tomatoes for cooking', 'vegetables', 'red, tomatoes, tamatar'),
    ('24k09', 'Potatoes', 'a7f2e0c4', 80, 0, 80.00, '1kg', 50, 'Quality potatoes for various recipes', 'vegetables', 'potatoes, aloo'),
    ('25l18', 'Carrots', 'd21bda66', 120, 0, 120.00, '1kg', 30, 'Fresh and crunchy carrots for salads', 'vegetables', 'carrots, gajar'),
    ('26m27', 'Spinach', 'd21bda66', 150, 0, 150.00, '500g', 20, 'Nutritious spinach leaves for healthy meals', 'vegetables', 'spinach, palak'),
    ('27n36', 'Onions', 'effea3f0', 60, 0, 60.00, '1kg', 45, 'Quality onions for everyday cooking', 'vegetables', 'onions, pyaaz'),
    ('28o45', 'Broccoli', 'effea3f0', 200, 10, 180.00, '500g', 15, 'Fresh broccoli rich in vitamins', 'vegetables', 'broccoli');

-- Grains
INSERT INTO products (pid, product_name, user_id, price, discount_percent, discounted_price, weight, stock_quantity, description, category, tags)
VALUES
    ('29p54', 'Rice', 'a7f2e0c4', 300, 0, 300.00, '2kg', 20, 'High-quality basmati rice for cooking', 'grains', 'rice, chawal'),
    ('30q63', 'Wheat Flour', 'a7f2e0c4', 150, 0, 150.00, '2kg', 30, 'Premium quality wheat flour for baking', 'grains', 'wheat flour, atta'),
    ('31r72', 'Oats', 'd21bda66', 80, 0, 80.00, '1kg', 25, 'Healthy oats for a nutritious breakfast', 'grains', 'oats'),
    ('32s81', 'Quinoa', 'd21bda66', 250, 0, 250.00, '500g', 15, 'Organic quinoa for a balanced diet', 'grains', 'quinoa'),
    ('33t90', 'Barley', 'effea3f0', 200, 0, 200.00, '500g', 20, 'Nutrient-rich barley grains for soups', 'grains', 'barley'),
    ('34u09', 'Cornmeal', 'effea3f0', 120, 0, 120.00, '1kg', 18, 'Fine cornmeal for baking and cooking', 'grains', 'cornmeal');

-- Dairy
INSERT INTO products (pid, product_name, user_id, price, discount_percent, discounted_price, weight, stock_quantity, description, category, tags)
VALUES
    ('35v18', 'Milk', 'a7f2e0c4', 50, 0, 50.00, '1L', 40, 'Fresh cow milk for daily consumption', 'dairy', 'milk, doodh'),
    ('36w27', 'Cheese', 'a7f2e0c4', 200, 0, 200.00, '500g', 25, 'Premium quality cheese for snacks', 'dairy', 'cheese'),
    ('37x36', 'Yogurt', 'd21bda66', 80, 0, 80.00, '1kg', 30, 'Creamy yogurt for a refreshing treat', 'dairy', 'yogurt, dahi'),
    ('38y45', 'Butter', 'd21bda66', 120, 0, 120.00, '250g', 20, 'Rich and creamy butter for cooking', 'dairy', 'butter'),
--    ('39z54', 'Eggs', 'ae32f427', 70, 0, 70.00, '1dozen', 35, 'Farm-fresh eggs for all your baking needs', 'dairy', 'eggs, ande'),
    ('40aa63', 'Cream', 'effea3f0', 150, 0, 150.00, '250ml', 15, 'Thick cream for desserts and sauces', 'dairy', 'cream');

-- Flowers (continued)
INSERT INTO products (pid, product_name, user_id, price, discount_percent, discounted_price, weight, stock_quantity, description, category, tags)
VALUES
    ('42cc81', 'Lilies', 'a7f2e0c4', 150, 0, 150.00, '1 bunch', 15, 'Elegant lilies to brighten up any space', 'flowers', 'lilies'),
    ('43dd90', 'Tulips', 'a7f2e0c4', 120, 0, 120.00, '1 dozen', 25, 'Colorful tulips for cheerful arrangements', 'flowers', 'tulips'),
    ('44ee09', 'Daisies', 'd21bda66', 80, 0, 80.00, '1 bunch', 30, 'Classic daisies to add a touch of simplicity', 'flowers', 'daisies'),
    ('45ff18', 'Sunflowers', 'd21bda66', 200, 0, 200.00, '1 dozen', 10, 'Bright sunflowers to spread happiness', 'flowers', 'sunflowers'),
    ('46gg27', 'Orchids', 'effea3f0', 250, 0, 250.00, '1 bunch', 12, 'Exotic orchids for a luxurious touch', 'flowers', 'orchids'),
    ('47hh36', 'Carnations', 'effea3f0', 120, 0, 120.00, '1 dozen', 20, 'Lovely carnations for any occasion', 'flowers', 'carnations');

-- Spices
INSERT INTO products (pid, product_name, user_id, price, discount_percent, discounted_price, weight, stock_quantity, description, category, tags)
VALUES
    ('48ii45', 'Cinnamon', 'a7f2e0c4', 50, 0, 50.00, '100g', 40, 'Aromatic cinnamon sticks for flavoring', 'spices', 'cinnamon'),
    ('49jj54', 'Turmeric', 'a7f2e0c4', 40, 0, 40.00, '200g', 35, 'Golden turmeric powder for health benefits', 'spices', 'turmeric, haldi'),
    ('50kk63', 'Cumin', 'd21bda66', 30, 0, 30.00, '150g', 50, 'Fragrant cumin seeds for seasoning', 'spices', 'cumin, jeera'),
    ('51ll72', 'Paprika', 'd21bda66', 60, 0, 60.00, '150g', 30, 'Vibrant paprika powder for color and flavor', 'spices', 'paprika'),
    ('52mm81', 'Ginger', 'effea3f0', 70, 0, 70.00, '250g', 25, 'Fresh ginger root for cooking and teas', 'spices', 'ginger, adrak'),
    ('53nn90', 'Cardamom', 'effea3f0', 100, 0, 100.00, '100g', 20, 'Fragrant green cardamom pods for desserts', 'spices', 'cardamom');

-- edible_oils
INSERT INTO products (pid, product_name, user_id, price, discount_percent, discounted_price, weight, stock_quantity, description, category, tags)
VALUES
    ('54oo09', 'Olive Oil', 'a7f2e0c4', 250, 0, 250.00, '1L', 20, 'Extra virgin olive oil for healthy cooking', 'edible_oils', 'olive oil'),
    ('55pp18', 'Coconut Oil', 'a7f2e0c4', 120, 0, 120.00, '500ml', 30, 'Pure coconut oil for hair and skin care', 'edible_oils', 'coconut oil'),
    ('56qq27', 'Sesame Oil', 'd21bda66', 150, 0, 150.00, '500ml', 25, 'Toasted sesame oil for Asian cuisines', 'edible_oils', 'sesame oil'),
    ('57rr36', 'Sunflower Oil', 'd21bda66', 100, 0, 100.00, '2L', 40, 'Refined sunflower oil for frying and baking', 'edible_oils', 'sunflower oil'),
    ('58ss45', 'Canola Oil', 'effea3f0', 80, 0, 80.00, '1L', 35, 'Heart-healthy canola oil for everyday cooking', 'edible_oils', 'canola oil'),
    ('59tt54', 'Peanut Oil', 'effea3f0', 200, 0, 200.00, '1L', 15, 'Pure peanut oil for deep frying and stir-frying', 'edible_oils', 'peanut oil');

-- dry_fruitss
INSERT INTO products (pid, product_name, user_id, price, discount_percent, discounted_price, weight, stock_quantity, description, category, tags)
VALUES
    ('60uu63', 'Almonds', 'a7f2e0c4', 300, 0, 300.00, '500g', 20, 'Nutrient-rich almonds for snacking', 'dry_fruits', 'almonds, badam'),
    ('61vv72', 'Cashews', 'a7f2e0c4', 250, 0, 250.00, '250g', 25, 'Buttery cashew nuts for energy', 'dry_fruits', 'cashews, kaju'),
    ('62ww81', 'Pistachios', 'd21bda66', 350, 0, 350.00, '500g', 18, 'Crunchy pistachios loaded with nutrients', 'dry_fruits', 'pistachios, pista'),
    ('63xx90', 'Raisins', 'd21bda66', 120, 0, 120.00, '1kg', 30, 'Sweet and juicy raisins for desserts', 'dry_fruits', 'raisins, kishmish'),
    ('64yy09', 'Walnuts', 'effea3f0', 280, 0, 280.00, '500g', 22, 'Healthy walnuts for brain-boosting benefits', 'dry_fruits', 'walnuts, akhrot'),
    ('65zz18', 'Dates', 'effea3f0', 150, 0, 150.00, '1kg', 15, 'Sweet and chewy dates for natural sweetness', 'dry_fruits', 'dates, khajur');

-- Bakery (Indian)
INSERT INTO products (pid, product_name, user_id, price, discount_percent, discounted_price, weight, stock_quantity, description, category, tags)
VALUES
    ('66aaa27', 'Indian Bread (Roti)', 'a7f2e0c4', 20, 0, 20.00, '10 pieces', 30, 'Soft and fluffy Indian bread for everyday meals', 'bakery', 'roti, chapati'),
    ('67bbb36', 'Cream Roll', 'a7f2e0c4', 30, 0, 30.00, '2 pieces', 25, 'Delicious cream-filled rolls for dessert', 'bakery', 'cream roll'),
    ('68ccc45', 'Muffins', 'd21bda66', 40, 0, 40.00, '6 pieces', 20, 'Variety of muffins for a delightful snack', 'bakery', 'muffins'),
    ('69ddd54', 'Pav', 'd21bda66', 15, 0, 15.00, '6 pieces', 35, 'Soft and fluffy pav bread for pav bhaji or vada pav', 'bakery', 'pav'),
    ('70eee63', 'Chocolate Cookies', 'effea3f0', 50, 0, 50.00, '250g', 28, 'Crunchy chocolate cookies for a sweet indulgence', 'bakery', 'chocolate cookies'),
    ('71fff72', 'Papad', 'effea3f0', 25, 0, 25.00, '100g', 40, 'Thin and crispy papads for a crunchy snack', 'bakery', 'papad');



-- All


INSERT INTO products (pid, product_name, uid, price, discount, dprice, weight, stock_quantity, description, category, tags)
VALUES
    ('17d36', 'Apples', 'a7f2e0c4', 200, 10, 180.00, '1kg', 20, 'Fresh red apples from farm', 'fruits', 'red, apples, seb'),
    ('18e45', 'Bananas', 'a7f2e0c4', 150, 5, 142.50, '1dozen', 30, 'Ripe bananas for healthy snacking', 'fruits', 'yellow, bananas, kela'),
    ('19f54', 'Oranges', 'd21bda66', 250, 15, 212.50, '2kg', 15, 'Juicy oranges packed with vitamin C', 'fruits', 'orange, citrus, santara'),
    ('20g63', 'Grapes', 'd21bda66', 180, 8, 165.60, '500g', 25, 'Fresh green grapes perfect for salads', 'fruits', 'green, grapes, angur'),
    ('21h72', 'Strawberries', 'effea3f0', 300, 10, 270.00, '500g', 10, 'Sweet and succulent strawberries', 'fruits', 'red, strawberries'),
    ('22i81', 'Mangoes', 'effea3f0', 220, 0, 220.00, '1kg', 18, 'Seasonal ripe mangoes for mango lovers', 'fruits', 'yellow, mangoes, aam'),
    ('23j90', 'Tomatoes', 'a7f2e0c4', 100, 0, 100.00, '1kg', 40, 'Fresh red tomatoes for cooking', 'vegetables', 'red, tomatoes, tamatar'),
    ('24k09', 'Potatoes', 'a7f2e0c4', 80, 0, 80.00, '1kg', 50, 'Quality potatoes for various recipes', 'vegetables', 'potatoes, aloo'),
    ('25l18', 'Carrots', 'd21bda66', 120, 0, 120.00, '1kg', 30, 'Fresh and crunchy carrots for salads', 'vegetables', 'carrots, gajar'),
    ('26m27', 'Spinach', 'd21bda66', 150, 0, 150.00, '500g', 20, 'Nutritious spinach leaves for healthy meals', 'vegetables', 'spinach, palak'),
    ('27n36', 'Onions', 'effea3f0', 60, 0, 60.00, '1kg', 45, 'Quality onions for everyday cooking', 'vegetables', 'onions, pyaaz'),
    ('28o45', 'Broccoli', 'effea3f0', 200, 10, 180.00, '500g', 15, 'Fresh broccoli rich in vitamins', 'vegetables', 'broccoli'),
    ('29p54', 'Rice', 'a7f2e0c4', 300, 0, 300.00, '2kg', 20, 'High-quality basmati rice for cooking', 'grains', 'rice, chawal'),
    ('30q63', 'Wheat Flour', 'a7f2e0c4', 150, 0, 150.00, '2kg', 30, 'Premium quality wheat flour for baking', 'grains', 'wheat flour, atta'),
    ('31r72', 'Oats', 'd21bda66', 80, 0, 80.00, '1kg', 25, 'Healthy oats for a nutritious breakfast', 'grains', 'oats'),
    ('32s81', 'Quinoa', 'd21bda66', 250, 0, 250.00, '500g', 15, 'Organic quinoa for a balanced diet', 'grains', 'quinoa'),
    ('33t90', 'Barley', 'effea3f0', 200, 0, 200.00, '500g', 20, 'Nutrient-rich barley grains for soups', 'grains', 'barley'),
    ('34u09', 'Cornmeal', 'effea3f0', 120, 0, 120.00, '1kg', 18, 'Fine cornmeal for baking and cooking', 'grains', 'cornmeal'),
    ('35v18', 'Milk', 'a7f2e0c4', 50, 0, 50.00, '1L', 40, 'Fresh cow milk for daily consumption', 'dairy', 'milk, doodh'),
    ('36w27', 'Cheese', 'a7f2e0c4', 200, 0, 200.00, '500g', 25, 'Premium quality cheese for snacks', 'dairy', 'cheese'),
    ('37x36', 'Yogurt', 'd21bda66', 80, 0, 80.00, '1kg', 30, 'Creamy yogurt for a refreshing treat', 'dairy', 'yogurt, dahi'),
    ('38y45', 'Butter', 'd21bda66', 120, 0, 120.00, '250g', 20, 'Rich and creamy butter for cooking', 'dairy', 'butter'),
--    ('39z54', 'Eggs', 'ae32f427', 70, 0, 70.00, '1dozen', 35, 'Farm-fresh eggs for all your baking needs', 'dairy', 'eggs, ande'),
    ('40aa6', 'Cream', 'effea3f0', 150, 0, 150.00, '250ml', 15, 'Thick cream for desserts and sauces', 'dairy', 'cream'),
    ('42cc8', 'Lilies', 'a7f2e0c4', 150, 0, 150.00, '1 bunch', 15, 'Elegant lilies to brighten up any space', 'flowers', 'lilies'),
    ('43dd9', 'Tulips', 'a7f2e0c4', 120, 0, 120.00, '1 dozen', 25, 'Colorful tulips for cheerful arrangements', 'flowers', 'tulips'),
    ('44ee0', 'Daisies', 'd21bda66', 80, 0, 80.00, '1 bunch', 30, 'Classic daisies to add a touch of simplicity', 'flowers', 'daisies'),
    ('45ff1', 'Sunflowers', 'd21bda66', 200, 0, 200.00, '1 dozen', 10, 'Bright sunflowers to spread happiness', 'flowers', 'sunflowers'),
    ('46gg2', 'Orchids', 'effea3f0', 250, 0, 250.00, '1 bunch', 12, 'Exotic orchids for a luxurious touch', 'flowers', 'orchids'),
    ('47hh3', 'Carnations', 'effea3f0', 120, 0, 120.00, '1 dozen', 20, 'Lovely carnations for any occasion', 'flowers', 'carnations'),
    ('48ii4', 'Cinnamon', 'a7f2e0c4', 50, 0, 50.00, '100g', 40, 'Aromatic cinnamon sticks for flavoring', 'spices', 'cinnamon'),
    ('49jj5', 'Turmeric', 'a7f2e0c4', 40, 0, 40.00, '200g', 35, 'Golden turmeric powder for health benefits', 'spices', 'turmeric, haldi'),
    ('50kk6', 'Cumin', 'd21bda66', 30, 0, 30.00, '150g', 50, 'Fragrant cumin seeds for seasoning', 'spices', 'cumin, jeera'),
    ('51ll7', 'Paprika', 'd21bda66', 60, 0, 60.00, '150g', 30, 'Vibrant paprika powder for color and flavor', 'spices', 'paprika'),
    ('52mm8', 'Ginger', 'effea3f0', 70, 0, 70.00, '250g', 25, 'Fresh ginger root for cooking and teas', 'spices', 'ginger, adrak'),
    ('53nn9', 'Cardamom', 'effea3f0', 100, 0, 100.00, '100g', 20, 'Fragrant green cardamom pods for desserts', 'spices', 'cardamom'),
    ('54oo0', 'Olive Oil', 'a7f2e0c4', 250, 0, 250.00, '1L', 20, 'Extra virgin olive oil for healthy cooking', 'edible_oils', 'olive oil'),
    ('55pp1', 'Coconut Oil', 'a7f2e0c4', 120, 0, 120.00, '500ml', 30, 'Pure coconut oil for hair and skin care', 'edible_oils', 'coconut oil'),
    ('56qq2', 'Sesame Oil', 'd21bda66', 150, 0, 150.00, '500ml', 25, 'Toasted sesame oil for Asian cuisines', 'edible_oils', 'sesame oil'),
    ('57rr3', 'Sunflower Oil', 'd21bda66', 100, 0, 100.00, '2L', 40, 'Refined sunflower oil for frying and baking', 'edible_oils', 'sunflower oil'),
    ('58ss4', 'Canola Oil', 'effea3f0', 80, 0, 80.00, '1L', 35, 'Heart-healthy canola oil for everyday cooking', 'edible_oils', 'canola oil'),
    ('59tt5', 'Peanut Oil', 'effea3f0', 200, 0, 200.00, '1L', 15, 'Pure peanut oil for deep frying and stir-frying', 'edible_oils', 'peanut oil'),
    ('60uu6', 'Almonds', 'a7f2e0c4', 300, 0, 300.00, '500g', 20, 'Nutrient-rich almonds for snacking', 'dry_fruits', 'almonds, badam'),
    ('61vv7', 'Cashews', 'a7f2e0c4', 250, 0, 250.00, '250g', 25, 'Buttery cashew nuts for energy', 'dry_fruits', 'cashews, kaju'),
    ('62ww8', 'Pistachios', 'd21bda66', 350, 0, 350.00, '500g', 18, 'Crunchy pistachios loaded with nutrients', 'dry_fruits', 'pistachios, pista'),
    ('63xx9', 'Raisins', 'd21bda66', 120, 0, 120.00, '1kg', 30, 'Sweet and juicy raisins for desserts', 'dry_fruits', 'raisins, kishmish'),
    ('64yy0', 'Walnuts', 'effea3f0', 280, 0, 280.00, '500g', 22, 'Healthy walnuts for brain-boosting benefits', 'dry_fruits', 'walnuts, akhrot'),
    ('65zz1', 'Dates', 'effea3f0', 150, 0, 150.00, '1kg', 15, 'Sweet and chewy dates for natural sweetness', 'dry_fruits', 'dates, khajur'),
    ('66aaa', 'Indian Bread (Roti)', 'a7f2e0c4', 20, 0, 20.00, '10 pieces', 30, 'Soft and fluffy Indian bread for everyday meals', 'bakery', 'roti, chapati'),
    ('67bbb', 'Cream Roll', 'a7f2e0c4', 30, 0, 30.00, '2 pieces', 25, 'Delicious cream-filled rolls for dessert', 'bakery', 'cream roll'),
    ('68ccc', 'Muffins', 'd21bda66', 40, 0, 40.00, '6 pieces', 20, 'Variety of muffins for a delightful snack', 'bakery', 'muffins'),
    ('69ddd', 'Pav', 'd21bda66', 20, 0, 20.00, '6 pieces', 35, 'Soft and fluffy pav bread for pav bhaji or vada pav', 'bakery', 'pav'),
    ('70eee', 'Chocolate Cookies', 'effea3f0', 50, 0, 50.00, '250g', 28, 'Crunchy chocolate cookies for a sweet indulgence', 'bakery', 'chocolate cookies'),
    ('71fff', 'Papad', 'effea3f0', 25, 0, 25.00, '100g', 40, 'Thin and crispy papads for a crunchy snack', 'bakery', 'papad');

