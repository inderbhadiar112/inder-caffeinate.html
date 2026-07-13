<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inder Caffeinate - Admin Panel</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --espresso: #1A0A00;
      --caramel: #C87941;
      --milk: #FDF8F3;
      --fog: #E8DDD3;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'DM Sans', sans-serif; background: var(--milk); color: var(--espresso); }
    
    .container { max-width: 1000px; margin: 40px auto; padding: 20px; }
    h1, h2, h3 { font-family: 'Playfair Display', serif; }
    
    /* Login Screen */
    #login-screen { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 80vh; }
    #login-screen input { padding: 12px; margin: 10px 0; border: 1px solid var(--fog); border-radius: 8px; width: 300px; }
    
    /* Dashboard */
    #dashboard { display: none; }
    .tabs { display: flex; gap: 10px; margin-bottom: 20px; border-bottom: 2px solid var(--fog); padding-bottom: 10px; }
    .tab-btn { background: none; border: none; font-size: 1rem; font-weight: 600; cursor: pointer; padding: 8px 16px; border-radius: 50px; }
    .tab-btn.active { background: var(--caramel); color: white; }
    
    .panel { display: none; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .panel.active { display: block; }
    
    input, textarea, select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 6px; }
    button { background: var(--espresso); color: #c0c0c0; border: none; padding: 10px 20px; border-radius: 50px; cursor: pointer; font-weight: 600; }
    button:hover { background: var(--caramel); }
    button.small-btn { padding: 6px 12px; font-size: 0.85rem; margin-right: 5px; }
    button.danger-btn { background: #d9534f; }
    button.danger-btn:hover { background: #c9302c; }
    
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 12px; border-bottom: 1px solid var(--fog); text-align: left; }
    th { background: var(--fog); font-weight: 600; }
    
    .toast { position: fixed; bottom: 20px; right: 20px; background: var(--caramel); color: white; padding: 12px 24px; border-radius: 8px; display: none; z-index: 9999; }

    /* Modal for Editing */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; }
    .modal-overlay.open { display: flex; }
    .modal { background: white; padding: 30px; border-radius: 12px; width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto; }
  </style>
</head>
<body>

<div class="container">
  
  <div id="login-screen">
    <h1>Admin Access</h1>
    <p style="margin-bottom: 20px; color: #666;">Enter password to continue</p>
    <input type="password" id="admin-pass" placeholder="Password">
    <button onclick="login()">Login</button>
  </div>

  <div id="dashboard">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
      <h1>Inder Caffeinate Admin</h1>
      <button onclick="logout()">Logout</button>
    </div>
    
    <div class="tabs">
      <button class="tab-btn active" onclick="showPanel('messages')">Messages</button>
      <button class="tab-btn" onclick="showPanel('menu')">Manage Menu</button>
      <button class="tab-btn" onclick="showPanel('ratings')">Ratings</button>
    </div>
    
    <!-- Messages Panel -->
    <div id="panel-messages" class="panel active">
      <h2>Contact Messages</h2>
      <button onclick="loadMessages()" style="margin-top:10px; margin-bottom:10px;">Refresh Messages</button>
      <div style="overflow-x:auto;">
        <table>
          <thead>
            <tr><th>Date</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th></tr>
          </thead>
          <tbody id="messages-tbody"></tbody>
        </table>
      </div>
    </div>
    
    <!-- Manage Menu Panel -->
    <div id="panel-menu" class="panel">
      
      <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2>Existing Menu Items</h2>
        <button onclick="document.getElementById('addModal').classList.add('open')">+ Add New Item</button>
      </div>

      <div style="overflow-x:auto;">
        <table>
          <thead>
            <tr><th>ID</th><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Badge</th><th>Actions</th></tr>
          </thead>
          <tbody id="menu-tbody"></tbody>
        </table>
      </div>
    </div>

    <!-- Ratings Panel -->
    <div id="panel-ratings" class="panel">
      <h2>Customer Ratings</h2>
      <button onclick="loadRatings()" style="margin-top:10px; margin-bottom:10px;">Refresh Ratings</button>
      <div style="overflow-x:auto;">
        <table>
          <thead>
            <tr><th>Date</th><th>Author</th><th>Stars</th><th>Review</th></tr>
          </thead>
          <tbody id="ratings-tbody"></tbody>
        </table>
      </div>
    </div>
    
  </div>
</div>

<!-- Add Item Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
      <h2>Add Menu Item</h2>
      <button style="background:transparent; color:black; padding:0;" onclick="document.getElementById('addModal').classList.remove('open')">✕</button>
    </div>
    <form id="addItemForm" onsubmit="addItem(event)">
      <label>Category</label>
      <select id="itemCat" required>
        <option value="espresso">Espresso Drinks</option>
        <option value="cold">Cold Brews</option>
        <option value="food">Food & Pastries</option>
        <option value="seasonal">Seasonal Specials</option>
      </select>
      
      <label>Name</label>
      <input type="text" id="itemName" required>
      
      <label>Description</label>
      <textarea id="itemDesc" required rows="3"></textarea>
      
      <label>Price (₹)</label>
      <input type="number" id="itemPrice" required>
      
      <label>Badge (e.g. Signature, New)</label>
      <input type="text" id="itemBadge">
      
      <label>Image URL</label>
      <input type="url" id="itemImg" required placeholder="https://images.unsplash.com/...">
      
      <button type="submit" style="width:100%">Save Item</button>
    </form>
  </div>
</div>

<!-- Edit Item Modal -->
<div class="modal-overlay" id="editModal">
  <div class="modal">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
      <h2>Edit Menu Item</h2>
      <button style="background:transparent; color:black; padding:0;" onclick="document.getElementById('editModal').classList.remove('open')">✕</button>
    </div>
    <form id="editItemForm" onsubmit="updateItem(event)">
      <input type="hidden" id="editItemId">
      
      <label>Category</label>
      <select id="editItemCat" required>
        <option value="espresso">Espresso Drinks</option>
        <option value="cold">Cold Brews</option>
        <option value="food">Food & Pastries</option>
        <option value="seasonal">Seasonal Specials</option>
      </select>
      
      <label>Name</label>
      <input type="text" id="editItemName" required>
      
      <label>Description</label>
      <textarea id="editItemDesc" required rows="3"></textarea>
      
      <label>Price (₹)</label>
      <input type="number" id="editItemPrice" required>
      
      <label>Badge</label>
      <input type="text" id="editItemBadge">
      
      <label>Image URL</label>
      <input type="url" id="editItemImg" required>
      
      <button type="submit" style="width:100%">Update Item</button>
    </form>
  </div>
</div>

<div id="toast" class="toast">Action successful!</div>

<script>
  let adminPassword = sessionStorage.getItem('admin_pass') || '';
  let allMenuItems = [];

  if (adminPassword) {
    document.getElementById('login-screen').style.display = 'none';
    document.getElementById('dashboard').style.display = 'block';
    loadMessages();
  }

  function login() {
    adminPassword = document.getElementById('admin-pass').value;
    if (adminPassword === 'admin123') {
      sessionStorage.setItem('admin_pass', adminPassword);
      document.getElementById('login-screen').style.display = 'none';
      document.getElementById('dashboard').style.display = 'block';
      loadMessages();
    } else {
      alert("Incorrect password");
    }
  }

  function logout() {
    sessionStorage.removeItem('admin_pass');
    location.reload();
  }

  function showToast(msg) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.style.display = 'block';
    setTimeout(() => t.style.display = 'none', 3000);
  }

  function showPanel(panelName) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    
    document.getElementById('panel-' + panelName).classList.add('active');
    event.target.classList.add('active');

    if(panelName === 'messages') loadMessages();
    if(panelName === 'menu') loadMenu();
    if(panelName === 'ratings') loadRatings();
  }

  async function loadMessages() {
    try {
      const res = await fetch(`api.php?action=get_messages&password=${adminPassword}`);
      const data = await res.json();
      if(data.status === 'success') {
        const tbody = document.getElementById('messages-tbody');
        tbody.innerHTML = data.data.map(m => `
          <tr>
            <td>${new Date(m.created_at).toLocaleDateString()}</td>
            <td>${m.first_name} ${m.last_name}</td>
            <td>${m.email}</td>
            <td>${m.subject}</td>
            <td>${m.message}</td>
          </tr>
        `).join('');
      }
    } catch (e) {
      console.error(e);
    }
  }

  async function loadRatings() {
    try {
      const res = await fetch(`api.php?action=get_ratings`);
      const data = await res.json();
      if(data.status === 'success') {
        const tbody = document.getElementById('ratings-tbody');
        tbody.innerHTML = data.data.map(r => `
          <tr>
            <td>${new Date(r.created_at).toLocaleDateString()}</td>
            <td>${r.author_name}</td>
            <td>${'★'.repeat(r.stars)}${'☆'.repeat(5-r.stars)}</td>
            <td>${r.review_text}</td>
          </tr>
        `).join('');
      }
    } catch (e) {
      console.error(e);
    }
  }

  async function loadMenu() {
    try {
      const res = await fetch(`api.php?action=get_menu`);
      const data = await res.json();
      if(data.status === 'success') {
        allMenuItems = data.data;
        const tbody = document.getElementById('menu-tbody');
        tbody.innerHTML = allMenuItems.map(m => `
          <tr>
            <td>${m.id}</td>
            <td><img src="${m.img}" alt="img" style="width:40px; height:40px; border-radius:5px; object-fit:cover;"></td>
            <td><strong>${m.name}</strong></td>
            <td>${m.category}</td>
            <td>₹${m.price}</td>
            <td>${m.badge || '-'}</td>
            <td>
              <button class="small-btn" onclick="openEditModal(${m.id})">Edit</button>
              <button class="small-btn danger-btn" onclick="deleteItem(${m.id})">Delete</button>
            </td>
          </tr>
        `).join('');
      }
    } catch (e) {
      console.error(e);
    }
  }

  async function addItem(e) {
    e.preventDefault();
    const payload = {
      action: 'add_item',
      password: adminPassword,
      category: document.getElementById('itemCat').value,
      name: document.getElementById('itemName').value,
      description: document.getElementById('itemDesc').value,
      price: document.getElementById('itemPrice').value,
      badge: document.getElementById('itemBadge').value,
      img: document.getElementById('itemImg').value,
    };

    try {
      const res = await fetch('api.php?action=add_item', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (data.status === 'success') {
        showToast('Item added successfully!');
        document.getElementById('addItemForm').reset();
        document.getElementById('addModal').classList.remove('open');
        loadMenu();
      } else {
        alert(data.message);
      }
    } catch(err) {
      alert('Network Error');
    }
  }

  function openEditModal(id) {
    const item = allMenuItems.find(i => i.id === id);
    if(item) {
      document.getElementById('editItemId').value = item.id;
      document.getElementById('editItemCat').value = item.category;
      document.getElementById('editItemName').value = item.name;
      document.getElementById('editItemDesc').value = item.description;
      document.getElementById('editItemPrice').value = item.price;
      document.getElementById('editItemBadge').value = item.badge;
      document.getElementById('editItemImg').value = item.img;
      document.getElementById('editModal').classList.add('open');
    }
  }

  async function updateItem(e) {
    e.preventDefault();
    const payload = {
      action: 'update_item',
      password: adminPassword,
      id: document.getElementById('editItemId').value,
      category: document.getElementById('editItemCat').value,
      name: document.getElementById('editItemName').value,
      description: document.getElementById('editItemDesc').value,
      price: document.getElementById('editItemPrice').value,
      badge: document.getElementById('editItemBadge').value,
      img: document.getElementById('editItemImg').value,
    };

    try {
      const res = await fetch('api.php?action=update_item', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (data.status === 'success') {
        showToast('Item updated successfully!');
        document.getElementById('editModal').classList.remove('open');
        loadMenu();
      } else {
        alert(data.message);
      }
    } catch(err) {
      alert('Network Error');
    }
  }

  async function deleteItem(id) {
    if(!confirm('Are you sure you want to delete this item?')) return;
    
    try {
      const res = await fetch('api.php?action=delete_item', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ action: 'delete_item', password: adminPassword, id: id })
      });
      const data = await res.json();
      if (data.status === 'success') {
        showToast('Item deleted!');
        loadMenu();
      } else {
        alert(data.message);
      }
    } catch(err) {
      alert('Network Error');
    }
  }
</script>

</body>
</html>
