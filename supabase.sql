-- Database setup for Inder Caffeinate (Supabase / PostgreSQL)

-- Create menu_items table
CREATE TABLE IF NOT EXISTS menu_items (
    id SERIAL PRIMARY KEY,
    category VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price INT NOT NULL,
    badge VARCHAR(50) DEFAULT '',
    img VARCHAR(255) NOT NULL
);

-- Insert default menu items
INSERT INTO menu_items (category, name, description, price, badge, img) VALUES
('espresso', 'Classic Espresso', 'A ristretto-pull of our house Ethiopian blend — dense, sweet, and luminous.', 180, 'Signature', 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?w=600&auto=format&fit=crop&q=80'),
('espresso', 'Caramel Latte', 'Double espresso with velvety steamed milk and our housemade caramel syrup.', 240, 'Bestseller', 'https://images.unsplash.com/photo-1561882468-9110e03e0f78?w=600&auto=format&fit=crop&q=80'),
('espresso', 'Flat White', 'Micro-foam milk over a concentrated ristretto. The purist''s choice.', 220, '', 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?w=600&auto=format&fit=crop&q=80'),
('espresso', 'Rose Cortado', 'Equal parts espresso and rose-infused warm milk — delicate and fragrant.', 260, 'Popular', 'https://images.unsplash.com/photo-1504630083234-14187a9df0f5?w=600&auto=format&fit=crop&q=80'),
('cold', 'Cold Brew Classic', '18-hour steep of Colombian beans served over ice. Silky smooth with zero bitterness.', 270, 'Fan Fav', 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=600&auto=format&fit=crop&q=80'),
('cold', 'Nitro Brew', 'Cold brew infused with nitrogen — cascading velvet in a glass.', 310, 'New', 'https://images.unsplash.com/photo-1541167760496-1628856ab772?w=600&auto=format&fit=crop&q=80'),
('cold', 'Iced Matcha Latte', 'Ceremonial grade matcha whisked with oat milk over cold brew ice cubes.', 280, '', 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?w=600&auto=format&fit=crop&q=80'),
('food', 'Almond Croissant', 'Buttery layers with almond frangipane and a dusting of icing sugar.', 180, 'Baked Fresh', 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=600&auto=format&fit=crop&q=80'),
('food', 'Avocado Toast', 'Sourdough with smashed avocado, chilli flakes, and a poached egg.', 290, '', 'https://foodsharingvegan.com/wp-content/uploads/2023/01/Rhodes-Avocado-Toast-Plant-Based-on-a-Budget-1-2-500x500.jpg'),
('food', 'Banana Bread', 'Warm slice of our signature moist banana bread with walnut crumble.', 160, '', 'https://www.honeywhatscooking.com/wp-content/uploads/2024/08/best-vegan-banana-bread-with-walnuts.jpg'),
('seasonal', 'Pumpkin Spice Latte', 'Espresso blended with real pumpkin, warm spices, and oat milk cream.', 290, 'Seasonal', 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=600&auto=format&fit=crop&q=80'),
('seasonal', 'Lavender Fog', 'Earl grey with lavender syrup, steamed almond milk, and vanilla.', 270, 'Limited', 'https://images.unsplash.com/photo-1534040385115-33dcb3acba5b?w=600&auto=format&fit=crop&q=80');

-- Create contact_messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
    id SERIAL PRIMARY KEY,
    total_amount DECIMAL(10,2) NOT NULL,
    tax_amount DECIMAL(10,2) NOT NULL,
    grand_total DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create order_items table
CREATE TABLE IF NOT EXISTS order_items (
    id SERIAL PRIMARY KEY,
    order_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    price INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES menu_items(id)
);

-- Create ratings table
CREATE TABLE IF NOT EXISTS ratings (
    id SERIAL PRIMARY KEY,
    author_name VARCHAR(100) NOT NULL,
    stars INT NOT NULL CHECK (stars >= 1 AND stars <= 5),
    review_text TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'approved',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
